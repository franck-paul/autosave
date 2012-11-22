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
	/* Description*/		"Autosave post during edition",
	/* Author */			"Alain Vagner",
	/* Version */			'0.1',
	/* Permissions */		'usage,contentadmin',
	/* Priority */			50
);
?>