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
use dcNsProcess;

class Backend extends dcNsProcess
{
    public static function init(): bool
    {
        static::$init = My::checkContext(My::BACKEND);

        // dead but useful code, in order to have translations
        __('Autosave') . __('Autosave entry during edition');

        return static::$init;
    }

    public static function process(): bool
    {
        if (!static::$init) {
            return false;
        }

        dcCore::app()->addBehaviors([
            'adminPostHeaders' => [BackendBehaviors::class, 'jsLoad'],

            'adminBeforeUserOptionsUpdate' => [BackendBehaviors::class, 'adminBeforeUserOptionsUpdate'],
            'adminPreferencesFormV2'       => [BackendBehaviors::class, 'adminPreferencesForm'],
        ]);

        return true;
    }
}
