<?php
/**
 * @brief autosave, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugins
 *
 * @author Franck Paul and contributors
 *
 * @copyright Franck Paul carnet.franck.paul@gmail.com
 * @copyright GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
declare(strict_types=1);

namespace Dotclear\Plugin\autosave;

use dcCore;
use dcPage;
use dcWorkspace;
use Dotclear\Helper\Html\Form\Checkbox;
use Dotclear\Helper\Html\Form\Fieldset;
use Dotclear\Helper\Html\Form\Label;
use Dotclear\Helper\Html\Form\Legend;
use Dotclear\Helper\Html\Form\Number;
use Dotclear\Helper\Html\Form\Para;
use Exception;

class BackendBehaviors
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
            dcPage::jsModuleLoad(My::id() . '/js/jquery.autosave.js', dcCore::app()->getVersion(My::id())) . "\n" .
            dcPage::jsModuleLoad(My::id() . '/js/autosave.js', dcCore::app()->getVersion(My::id())) . "\n";
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
            dcCore::app()->auth->user_prefs->interface->put('autosave', !empty($_POST['autosave_active']), dcWorkspace::WS_BOOL);
            dcCore::app()->auth->user_prefs->interface->put('autosave_delay', $autosave_delay, dcWorkspace::WS_INT);
        } catch (Exception $e) {
            dcCore::app()->error->add($e->getMessage());
        }
    }

    public static function adminPreferencesForm()
    {
        // Add fieldset for plugin options

        echo (new Fieldset('autosave'))
            ->legend((new Legend(__('Autosave'))))
            ->fields([
                (new Para())->items([
                    (new Checkbox('autosave_active', (bool) dcCore::app()->auth->user_prefs->interface->autosave))
                        ->value(1)
                        ->label((new Label(__('Autosave entry during edition'), Label::INSIDE_TEXT_AFTER))),
                ]),
                (new Para())->items([
                    (new Number('autosave_delay', 0, 9_999, (int) dcCore::app()->auth->user_prefs->interface->autosave_delay))
                        ->default(30)
                        ->label((new Label(__('Save every (in seconds, default: 30):'), Label::INSIDE_TEXT_BEFORE))),
                ]),
            ])
        ->render();
    }
}
