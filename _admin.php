<?php
# -- BEGIN LICENSE BLOCK ----------------------------------
#
# This file is part of Dotclear 2.
#
# Copyright (c) 2003-2012 Olivier Meunier and contributors
# Licensed under the GPL version 2.0 license.
# See LICENSE file or
# http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
#
# -- END LICENSE BLOCK ------------------------------------
if (!defined('DC_CONTEXT_ADMIN')) { return; }

$core->addBehavior('adminPostHeaders',array('autosaveBehaviors','jsLoad'));

$core->addBehavior('adminBeforeUserOptionsUpdate',array('autosaveBehaviors','adminBeforeUserOptionsUpdate'));
if (version_compare(DC_VERSION,'2.4.4','<=')) {
	$core->addBehavior('adminBeforeUserUpdate',array('autosaveBehaviors','adminBeforeUserOptionsUpdate'));
}
$core->addBehavior('adminPreferencesForm',array('autosaveBehaviors','adminPreferencesForm'));

class autosaveBehaviors
{
	public static function jsLoad()
	{
		global $core;

		// Get and store user's prefs for plugin options
		$core->auth->user_prefs->addWorkspace('interface');
		if ($core->auth->user_prefs->interface->autosave) {
			$delay = (integer) $core->auth->user_prefs->interface->autosave_delay;
			if (!$delay) {
				$delay = 30;
			}
			return
				'<script type="text/javascript" src="index.php?pf=autosave/jquery.autosave.js"></script>'."\n".
				'<script type="text/javascript">'."\n".
				"//<![CDATA[\n".
				dcPage::jsVar('autosave_msg_waiting',__('Autosave: waiting for first save...')).
				dcPage::jsVar('autosave_msg_saved',__('Autosave: last save at %s')).
				dcPage::jsVar('autosave_delay',$delay * 1000).
				"\n//]]>\n".
				"</script>\n".
				'<script type="text/javascript" src="index.php?pf=autosave/autosave.js"></script>'."\n";
		}
	}

	public static function adminBeforeUserOptionsUpdate($cur,$userID)
	{
		global $core;

		// Get and store user's prefs for plugin options
		$core->auth->user_prefs->addWorkspace('interface');
		try {
			$autosave_delay = (integer) $_POST['autosave_delay'];
			if ($autosave_delay < 1) {
				$autosave_delay = 30;	// seconds
			}
			$core->auth->user_prefs->interface->put('autosave',!empty($_POST['autosave']),'boolean');
			$core->auth->user_prefs->interface->put('autosave_delay',$autosave_delay);
		}
		catch (Exception $e)
		{
			$core->error->add($e->getMessage());
		}
	}
	
	public static function adminPreferencesForm($core)
	{
		// Add fieldset for plugin options
		$core->auth->user_prefs->addWorkspace('interface');

		echo
		'<div class="fieldset"><h5>'.__('Autosave').'</h5>'.
		
		'<p><label for="autosave" class="classic">'.
		form::checkbox('autosave',1,$core->auth->user_prefs->interface->autosave).' '.
		__('Autosave entry during edition').'</label></p>'.

		'<p><label for="autosave_delay">'.__('Save every (in seconds, default: 30):').
		form::field('autosave_delay',5,4,(integer) $core->auth->user_prefs->interface->autosave_delay).'</label></p>'.

		'</div>';
	}
}
?>