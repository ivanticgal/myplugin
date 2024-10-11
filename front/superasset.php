<?php
include "../../../inc/includes.php";

// Check if plugin is activated...
$plugin = new Plugin();
if (!$plugin->isInstalled('myplugin') || !$plugin->isActivated('myplugin')) {
    Html::displayNotFoundError();
}

//check for ACLs
if (PluginMypluginSuperasset::canView()) {
    //View is granted: display the list.

    //Add page header
    Html::header(
        __('My plugin', 'myplugin'),
        $_SERVER['PHP_SELF'],
        'plugins',
        PluginMypluginSuperasset::class,
        'superasset'
    );

    Search::show(PluginMypluginSuperasset::class);

    Html::footer();
} else {
    //View is not granted.
    Html::displayRightError();
}
