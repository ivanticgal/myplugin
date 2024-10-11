<?php
//...

define('PLUGIN_MYPLUGIN_VERSION', '0.0.1');
define('PLUGIN_MYPLUGIN_MIN_GLPI', '10.0.0');
define('PLUGIN_MYPLUGIN_MAX_GLPI', '11.0.0');

/**
 * Init the hooks of the plugins - Needed
 *
 * @return void
 */
function plugin_init_myplugin()
{
    global $PLUGIN_HOOKS;

    $PLUGIN_HOOKS['csrf_compliant']['myplugin'] = true;

    $plugin = new Plugin();
    if ($plugin->isActivated('myplugin')) {

        $PLUGIN_HOOKS['menu_toadd']['myplugin'] = [
            // insert into 'plugin menu'
            'plugins' => PluginMypluginSuperasset::class
        ];
    }
    
    Plugin::registerClass(
        PluginMypluginConfig::class,
        [
            'addtabon' => [
                'Config',
            ]
        ]
    );
}

/**
 * Get the name and the version of the plugin - Needed
 *
 * @return array
 */
function plugin_version_myplugin()
{
    return [
      'name' => 'MyPlugin',
      'version' => PLUGIN_MYPLUGIN_VERSION,
      'author' => '<a href="">Author</a>',
      'homepage' => '',
      'license' => 'GPLv3+',
      'minGlpiVersion' => PLUGIN_MYPLUGIN_MIN_GLPI,
      'requirements' => [
        'glpi' => [
            'min' => PLUGIN_MYPLUGIN_MIN_GLPI,
            'max' => PLUGIN_MYPLUGIN_MAX_GLPI,
        ],
      ],
    ];
}