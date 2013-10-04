<?php
# -- BEGIN LICENSE BLOCK ----------------------------------
# This file is part of autosave, a plugin for Dotclear 2.
#
# Copyright (c) biou, Franck Paul and contributors
# carnet.franck.paul@gmail.com
#
# Licensed under the GPL version 2.0 license.
# A copy of this license is available in LICENSE file or at
# http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
# -- END LICENSE BLOCK ------------------------------------

if (!defined('DC_RC_PATH')) { return; }

$this->registerModule(
	/* Name */			"Autosave",
	/* Description*/		"Autosave entry during edition",
	/* Author */			"Alain Vagner, Franck Paul",
	/* Version */			'0.5',
	array(
		/* Permissions */	'permissions' =>	'usage,contentadmin',
		/* Type */			'type' =>			'plugin',
		/* Priority */		'priority' => 		50
	)
);
