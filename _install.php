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

if (!defined('DC_CONTEXT_ADMIN')) {return;}

$new_version = $core->plugins->moduleInfo('autosave', 'version');
$old_version = $core->getVersion('autosave');

if (version_compare($old_version, $new_version, '>=')) {
    return;
}

try
{
    // Default user settings
    $core->auth->user_prefs->addWorkspace('interface');
    if (!$core->auth->user_prefs->interface->prefExists('autosave')) {
        $core->auth->user_prefs->interface->put('autosave', true, 'boolean');
    }

    $core->setVersion('autosave', $new_version);

    return true;
} catch (Exception $e) {
    $core->error->add($e->getMessage());
}
return false;
