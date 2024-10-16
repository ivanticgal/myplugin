<?php
// forbid direct calls of this file
if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

class PluginMypluginSuperasset extends CommonDBTM
{
    // right management, we'll change this later
    static $rightname = 'computer';

    //..
    //..
    /**
     * Define menu name
     */
    public static function getMenuName($nb = 0)
    {
        // call class label
        return self::getTypeName($nb);
    }

    /**
     * Define menu icon
     */
    public static function getIcon()
    {
        return 'ti ti-tag';
    }

    /**
     * Define additionnal links used in breacrumbs and sub-menu
     */
    public static function getMenuContent()
    {
        $title = self::getMenuName(2);
        $search = self::getSearchURL(false);
        $form = self::getFormURL(false);

        // define base menu
        $menu = [
            'title' => __("My plugin", 'myplugin'),
            'page' => $search,
            'icon' => 'ti ti-files',

            // define sub-options
            // we may have multiple pages under the "Plugin > My type" menu
            'options' => [
                'superasset' => [
                    'title' => $title,
                    'page' => $search,
                    'icon' => self::getIcon(),

                    //define standard icons in sub-menu
                    'links' => [
                        'search' => $search,
                        'add' => $form,
                    ],
                ],
            ],
        ];

        return $menu;
    }
    //..
    public function defineTabs($options = array())
    {
        $ong = array();
        $this->addDefaultFormTab($ong);
        $this->addStandardTab(__('Document'), $ong, $options);
        return $ong;
    }

    public function getTabNameForItem(CommonGLPI $item, $withtemplate = 0)
    {
        switch ($item::getType()) {
            case 'PluginMypluginSuperasset':
                return 'Superasset';
                break;
        }
        return '';
    }

    public static function displayTabContentForItem(CommonGLPI $item, $tabnum = 1, $withtemplate = 0)
    {
        switch ($item::getType()) {
            case 'PluginMypluginSuperasset':
                // Code here or call function to display
                break;
        }
        return true;
    }

    public static function install(Migration $migration)
    {
      global $DB;
  
       $default_charset = DBConnection::getDefaultCharset();
          $default_collation = DBConnection::getDefaultCollation();
          $default_key_sign = DBConnection::getDefaultPrimaryKeySignOption();
  
          //Create table only if it does not exists yet!
          $table = self::getTable();
          if (!$DB->tableExists($table)) {
              //table creation query
              $query = "CREATE TABLE `$table` (
                      `id`         	INT {$default_key_sign} NOT NULL AUTO_INCREMENT,
                      `is_deleted` 	TINYINT(1) NOT NULL DEFAULT '0',
                      `name`      	VARCHAR(255) NOT NULL,
                      PRIMARY KEY  (`id`)
              ) ENGINE=InnoDB
                  DEFAULT CHARSET={$default_charset}
                  COLLATE={$default_collation}";
              $DB->queryOrDie($query, $DB->error());
          }
  
          //execute the whole migration
          $migration->executeMigration();
      }
}
