<?php
include "../../../inc/includes.php";

// Check if plugin is activated...
$plugin = new Plugin();
if (!$plugin->isInstalled('myplugin') || !$plugin->isActivated('myplugin')) {
    Html::displayNotFoundError();
}

$superasset = new PluginMypluginSuperasset();

if (isset($_POST['add'])) {
    $superasset->check(-1, CREATE, $_POST);
    $newid = $superasset->add($_POST);
    Html::redirect("{$CFG_GLPI['root_doc']}/plugins/myplugin/front/superasset.form.php?id=$newid");
} else if (isset($_POST['update'])) {
    $superasset->check($_POST['id'], UPDATE);
    $superasset->update($_POST);
    Html::back();
} else if (isset($_POST['delete'])) {
    $superasset->check($_POST['id'], DELETE);
    $superasset->delete($_POST);
    $superasset->redirectToList();
} else if (isset($_POST['purge'])) {
    $superasset->check($_POST['id'], PURGE);
    $superasset->delete($_POST, 1);
    Html::redirect("{$CFG_GLPI['root_doc']}/plugins/myplugin/front/superasset.php");
} else {
    // fill id, if missing
    isset($_GET['id'])
        ? $ID = intval($_GET['id'])
        : $ID = 0;

    // display form
    Html::header(
        __('My plugin', 'myplugin'),
        $_SERVER['PHP_SELF'],
        'plugins',
        PluginMypluginSuperasset::class,
        'superasset'
    );
    $superasset->display(['id' => $ID]);
    Html::footer();
}