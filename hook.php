<?php
//...
function plugin_myplugin_install() {
	$migration = new Migration(PLUGIN_MYPLUGIN_VERSION);

	// Parse inc directory
	foreach (glob(dirname(__FILE__).'/inc/*') as $filepath) {
		// Load *.class.php files and get the class name
		if (preg_match("/inc.(.+)\.class.php/", $filepath, $matches)) {
			$classname = 'PluginMyplugin' . ucfirst($matches[1]);
			include_once($filepath);
			// If the install method exists, load it
			if (method_exists($classname, 'install')) {
				$classname::install($migration);
			}
		}
	}

	return true;
}

function plugin_myplugin_uninstall() {
	$migration = new Migration(PLUGIN_MYPLUGIN_VERSION);

	// Parse inc directory
	foreach (glob(dirname(__FILE__).'/inc/*') as $filepath) {
		// Load *.class.php files and get the class name
		if (preg_match("/inc.(.+)\.class.php/", $filepath, $matches)) {
			$classname = 'PluginMyplugin' . ucfirst($matches[1]);
			include_once($filepath);
			// If the uninstall method exists, load it
			if (method_exists($classname, 'uninstall')) {
				$classname::uninstall($migration);
			}
		}
	}

	return true;
}