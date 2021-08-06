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

$core->addBehavior('adminPostHeaders', ['autosaveBehaviors', 'jsLoad']);

$core->addBehavior('adminBeforeUserOptionsUpdate', ['autosaveBehaviors', 'adminBeforeUserOptionsUpdate']);
$core->addBehavior('adminPreferencesForm', ['autosaveBehaviors', 'adminPreferencesForm']);

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
            dcPage::jsJson('autosave', [
                'delay' => $delay * 1000,
                'msg'   => [
                    'waiting' => __('Autosave: waiting for first save...'),
                    'saved'   => __('Autosave: last save at %s')
                ]
            ]) .
            dcPage::jsLoad(urldecode(dcPage::getPF('autosave/js/jquery.autosave.js')), $core->getVersion('autosave')) . "\n" .
            dcPage::jsLoad(urldecode(dcPage::getPF('autosave/js/autosave.js')), $core->getVersion('autosave')) . "\n";
        }
    }

    public static function adminBeforeUserOptionsUpdate($cur, $userID)
    {
        global $core;

        // Get and store user's prefs for plugin options
        $core->auth->user_prefs->addWorkspace('interface');

        try {
            $autosave_delay = (integer) $_POST['autosave_delay'];
            if ($autosave_delay < 1) {
                $autosave_delay = 30; // seconds
            }
            $core->auth->user_prefs->interface->put('autosave', !empty($_POST['autosave_active']), 'boolean');
            $core->auth->user_prefs->interface->put('autosave_delay', $autosave_delay);
        } catch (Exception $e) {
            $core->error->add($e->getMessage());
        }
    }

    public static function adminPreferencesForm($core)
    {
        // Add fieldset for plugin options
        $core->auth->user_prefs->addWorkspace('interface');

        echo
        '<div class="fieldset"><h5 id="autosave">' . __('Autosave') . '</h5>' .

        '<p><label for="autosave_active" class="classic">' .
        form::checkbox('autosave_active', 1, $core->auth->user_prefs->interface->autosave) . ' ' .
        __('Autosave entry during edition') . '</label></p>' .

        '<p><label for="autosave_delay">' . __('Save every (in seconds, default: 30):') . ' ' .
        form::number('autosave_delay', 0, 9999, (integer) $core->auth->user_prefs->interface->autosave_delay) . '</label></p>' .

            '</div>';
    }
}
