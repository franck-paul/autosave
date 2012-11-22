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

class autosaveBehaviors
{
	public static function jsLoad()
	{
		return
		'<script type="text/javascript" src="index.php?pf=autosave/jquery.autosave.js"></script>'."\n".
		'<script type="text/javascript" src="index.php?pf=autosave/autosave.js"></script>'."\n";
	}
}
?>