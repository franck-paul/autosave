<?php

/**
 * @brief autosave, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugins
 *
 * @author Alain Vagner, Franck Paul and contributors
 *
 * @copyright Alain Vagner, Franck Paul contact@open-time.net
 * @copyright GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
$this->registerModule(
    'Autosave',
    'Autosave entry during edition',
    'Alain Vagner, Franck Paul',
    '5.2',
    [
        'date'        => '2026-03-02T10:37:26+0100',
        'requires'    => [['core', '2.36']],
        'permissions' => 'My',
        'type'        => 'plugin',
        'priority'    => 50,
        'settings'    => [
            'pref' => '#user-options.autosave',
        ],

        'details'    => 'https://open-time.net/?q=autosave',
        'support'    => 'https://github.com/franck-paul/autosave',
        'repository' => 'https://raw.githubusercontent.com/franck-paul/autosave/main/dcstore.xml',
        'license'    => 'gpl2',
    ]
);
