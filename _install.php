<?php
/**
 * @brief autosave, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugins
 *
 * @author Alain Vagner, Franck Paul and contributors
 *
 * @copyright Alain Vagner, Franck Paul carnet.franck.paul@gmail.com
 * @copyright GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
if (!defined('DC_CONTEXT_ADMIN')) {
    return;
}

$new_version = dcCore::app()->plugins->moduleInfo('autosave', 'version');
$old_version = dcCore::app()->getVersion('autosave');

if (version_compare((string) $old_version, $new_version, '>=')) {
    return;
}

try {
    // Default user settings
    dcCore::app()->auth->user_prefs->addWorkspace('interface');
    if (!dcCore::app()->auth->user_prefs->interface->prefExists('autosave')) {
        dcCore::app()->auth->user_prefs->interface->put('autosave', true, 'boolean');
    }

    dcCore::app()->setVersion('autosave', $new_version);

    return true;
} catch (Exception $e) {
    dcCore::app()->error->add($e->getMessage());
}

return false;
