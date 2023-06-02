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
$this->registerModule(
    'Autosave',
    'Autosave entry during edition',
    'Alain Vagner, Franck Paul',
    '2.0.1',
    [
        'requires'    => [['core', '2.26']],
        'permissions' => dcCore::app()->auth->makePermissions([
            dcAuth::PERMISSION_USAGE,
            dcAuth::PERMISSION_CONTENT_ADMIN,
        ]),
        'type'     => 'plugin',
        'priority' => 50,
        'settings' => [
            'pref' => '#user-options.autosave',
        ],

        'details'    => 'https://open-time.net/?q=autosave',
        'support'    => 'https://github.com/franck-paul/autosave',
        'repository' => 'https://raw.githubusercontent.com/franck-paul/autosave/master/dcstore.xml',
    ]
);
