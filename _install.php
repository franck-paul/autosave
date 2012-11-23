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

$new_version = $core->plugins->moduleInfo('autosave','version');
$old_version = $core->getVersion('autosave');

if (version_compare($old_version,$new_version,'>=')) return;

try
{
	// Default user settings
	$core->auth->user_prefs->addWorkspace('interface');
	if (!$core->auth->user_prefs->interface->prefExists('autosave')) {
		$core->auth->user_prefs->interface->put('autosave',true,'boolean');
	}

	$core->setVersion('autosave',$new_version);
	
	return true;
}
catch (Exception $e)
{
	$core->error->add($e->getMessage());
}
return false;
?>