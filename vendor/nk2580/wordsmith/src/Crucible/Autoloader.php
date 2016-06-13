<?php

/*
 * CRUCIBLE ENVIRONMENT AUTOLOADER
 * 
 * This file is designed to be used with the WordSmith Crucible framework.
 * 
 */

namespace nk2580\wordsmith\Crucible;

class Autoloader {

    public function __construct() {
        
        //DEFINE DEPENDANT CRUCIBLE CONSTANTS
        define("CRUCIBLE_PUBLIC_ASSETS_DIR", CRUCIBLE_ASSET_DIR.'/public');
        define("CRUCIBLE_ADMIN_ASSETS_DIR", CRUCIBLE_ASSET_DIR.'/admin');
        define("CRUCIBLE_PUBLIC_CONTROLLERS_DIR", CRUCIBLE_CONTROLLER_DIR.'/public');
        define("CRUCIBLE_ADMIN_CONTROLLERS_DIR", CRUCIBLE_CONTROLLER_DIR.'/admin');
        
        //load the extensions folder first
        $this->recursiveIncluder(CRUCIBLE_EXTENSIONS_DIR);
        //Load the App folder 
        $this->recursiveIncluder(CRUCIBLE_APP_DIR);
        //load the Controllers folder
        $this->recursiveIncluder(CRUCIBLE_CONTROLLER_DIR);
    }

    private function recursiveIncluder($dir) {
        $ffs = scandir($dir);
        $i = 0;
        foreach ($ffs as $ff) {
            if ($ff != '.' && $ff != '..') {
                if (strlen($ff) >= 5) {
                    if (substr($ff, -4) == '.php') {
                        require_once $dir . '/' . $ff;
                    }
                }
                if (is_dir($dir . '/' . $ff))
                    $this->recursiveIncluder($dir . '/' . $ff);
            }
        }
    }

}
