<?php

/*
 * WordSmith Instance
 * 
 * This file is designed to be used with the WordSmith Crucible framework.
 * 
 */

namespace nk2580\wordsmith\Environment;

use Philo\Blade\Blade as Blade;

class Instance {

    protected static $_instances = array();
    private $dir;
    private $uri;
    public $APP_DIR;
    public $EXTENSIONS_DIR;
    public $CONTROLLER_DIR;
    public $VIEW_DIR;
    public $CACHE_DIR;
    public $BOWER_URI;
    public $ASSET_DIR;

    public function __construct($dir, $uri) {
        self::$_instances[] = $this;
        $this->dir = $dir;
        $this->uri = $uri;
        $config = include $this->dir . "/wordsmith.php";
        $this->APP_DIR = $this->dir . $config["APP_DIR"];
        $this->CONTROLLER_DIR = $this->dir . $config["CONTROLLER_DIR"];
        $this->EXTENSIONS_DIR = $this->dir . $config["EXTENSIONS_DIR"];
        $this->VIEW_DIR = $this->dir . $config["VIEW_DIR"];
        $this->CACHE_DIR = $this->dir . $config["CACHE_DIR"];
        $this->BOWER_URI = $this->uri . $config["BOWER_URI"];
        $this->ASSET_DIR = $this->uri . $config["ASSET_DIR"];
        $this->boot();
    }

    public function boot() {
        self::loadDir($this->EXTENSIONS_DIR);
        self::loadDir($this->APP_DIR);
        self::loadDir($this->CONTROLLER_DIR);
    }

    private static function loadDir($dir) {
        $ffs = scandir($dir);
        $i = 0;
        foreach ($ffs as $ff) {
            if ($ff != '.' && $ff != '..') {
                if (strlen($ff) >= 5) {
                    if (substr($ff, -4) == '.php') {
                        include $dir . '/' . $ff;
                    }
                }
                if (is_dir($dir . '/' . $ff))
                    self::loadDir($dir . '/' . $ff);
            }
        }
    }

    public function View() {
        $blade = new Blade($this->VIEW_DIR, $this->CACHE_DIR);
        return $blade;
    }

}
