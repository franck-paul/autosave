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
if (!defined('DC_RC_PATH')) { return; }

$this->registerModule(
	/* Name */			"Autosave",
	/* Description*/		"Autosave entry during edition",
	/* Author */			"Alain Vagner, Franck Paul",
	/* Version */			'0.4.2',
	/* Permissions */		'usage,contentadmin',
	/* Priority */			50
);
?>