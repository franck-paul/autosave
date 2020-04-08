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

if (!defined('DC_RC_PATH')) {return;}

$this->registerModule(
    "Autosave",                      // Name
    "Autosave entry during edition", // Description
    "Alain Vagner, Franck Paul",     // Author
    '0.7',                           // Version
    [
        'requires'    => [['core', '2.16']],
        'permissions' => 'usage,contentadmin',
        'type'        => 'plugin',
        'priority'    => 50,
        'details'     => 'https://open-time.net/?q=autosave',       // Details URL
        'support'     => 'https://github.com/franck-paul/autosave', // Support URL
        'settings'    => [                                          // Settings
            'pref' => '#user-options.autosave'
        ]
    ]
);
