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

use Dotclear\App;
use Dotclear\Core\Backend\Page;
use Dotclear\Helper\Html\Form\Checkbox;
use Dotclear\Helper\Html\Form\Fieldset;
use Dotclear\Helper\Html\Form\Label;
use Dotclear\Helper\Html\Form\Legend;
use Dotclear\Helper\Html\Form\Number;
use Dotclear\Helper\Html\Form\Para;
use Exception;

class BackendBehaviors
{
    public static function jsLoad(): string
    {
        // Get and store user's prefs for plugin options
        if (App::auth()->prefs()->interface->autosave) {
            $delay = (int) App::auth()->prefs()->interface->autosave_delay;
            if ($delay === 0) {
                $delay = 30;
            }

            return
            Page::jsJson('autosave', [
                'delay' => $delay * 1000,
                'msg'   => [
                    'waiting' => __('Autosave: waiting for first save...'),
                    'saved'   => __('Autosave: last save at %s'),
                ],
            ]) .
            My::jsLoad('jquery.autosave.js') . "\n" .
            My::jsLoad('autosave.js') . "\n";
        }

        return '';
    }

    public static function adminBeforeUserOptionsUpdate(): string
    {
        // Get and store user's prefs for plugin options
        try {
            $autosave_delay = (int) $_POST['autosave_delay'];
            if ($autosave_delay < 1) {
                $autosave_delay = 30; // seconds
            }

            App::auth()->prefs()->interface->put('autosave', !empty($_POST['autosave_active']), App::userWorkspace()::WS_BOOL);
            App::auth()->prefs()->interface->put('autosave_delay', $autosave_delay, App::userWorkspace()::WS_INT);
        } catch (Exception $exception) {
            App::error()->add($exception->getMessage());
        }

        return '';
    }

    public static function adminPreferencesForm(): string
    {
        // Add fieldset for plugin options

        echo (new Fieldset('autosave'))
            ->legend((new Legend(__('Autosave'))))
            ->fields([
                (new Para())->items([
                    (new Checkbox('autosave_active', (bool) App::auth()->prefs()->interface->autosave))
                        ->value(1)
                        ->label((new Label(__('Autosave entry during edition'), Label::INSIDE_TEXT_AFTER))),
                ]),
                (new Para())->items([
                    (new Number('autosave_delay', 0, 9_999, (int) App::auth()->prefs()->interface->autosave_delay))
                        ->default(30)
                        ->label((new Label(__('Save every (in seconds, default: 30):'), Label::INSIDE_TEXT_BEFORE))),
                ]),
            ])
        ->render();

        return '';
    }
}
