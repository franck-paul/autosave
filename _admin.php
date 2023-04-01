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

// dead but useful code, in order to have translations
__('Autosave') . __('Autosave entry during edition');

class autosaveBehaviors
{
    public static function jsLoad()
    {
        // Get and store user's prefs for plugin options
        if (dcCore::app()->auth->user_prefs->interface->autosave) {
            $delay = (int) dcCore::app()->auth->user_prefs->interface->autosave_delay;
            if (!$delay) {
                $delay = 30;
            }

            return
            dcPage::jsJson('autosave', [
                'delay' => $delay * 1000,
                'msg'   => [
                    'waiting' => __('Autosave: waiting for first save...'),
                    'saved'   => __('Autosave: last save at %s'),
                ],
            ]) .
            dcPage::jsModuleLoad('autosave/js/jquery.autosave.js', dcCore::app()->getVersion('autosave')) . "\n" .
            dcPage::jsModuleLoad('autosave/js/autosave.js', dcCore::app()->getVersion('autosave')) . "\n";
        }
    }

    public static function adminBeforeUserOptionsUpdate()
    {
        // Get and store user's prefs for plugin options
        try {
            $autosave_delay = (int) $_POST['autosave_delay'];
            if ($autosave_delay < 1) {
                $autosave_delay = 30; // seconds
            }
            dcCore::app()->auth->user_prefs->interface->put('autosave', !empty($_POST['autosave_active']), 'boolean');
            dcCore::app()->auth->user_prefs->interface->put('autosave_delay', $autosave_delay);
        } catch (Exception $e) {
            dcCore::app()->error->add($e->getMessage());
        }
    }

    public static function adminPreferencesForm()
    {
        // Add fieldset for plugin options

        echo
        '<div class="fieldset"><h5 id="autosave">' . __('Autosave') . '</h5>' .

        '<p><label for="autosave_active" class="classic">' .
        form::checkbox('autosave_active', 1, dcCore::app()->auth->user_prefs->interface->autosave) . ' ' .
        __('Autosave entry during edition') . '</label></p>' .

        '<p><label for="autosave_delay">' . __('Save every (in seconds, default: 30):') . ' ' .
        form::number('autosave_delay', 0, 9999, dcCore::app()->auth->user_prefs->interface->autosave_delay) . '</label></p>' .

            '</div>';
    }
}

dcCore::app()->addBehaviors([
    'adminPostHeaders'             => [autosaveBehaviors::class, 'jsLoad'],

    'adminBeforeUserOptionsUpdate' => [autosaveBehaviors::class, 'adminBeforeUserOptionsUpdate'],
    'adminPreferencesFormV2'       => [autosaveBehaviors::class, 'adminPreferencesForm'],
]);
