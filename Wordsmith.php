<?php

/*
  Plugin Name:  WordSmith Framework
  Plugin URI:   http://nk2580.github.io/WordSmith/
  Description:  Powerful Apps With Minimal Effort.
  Version:      1.0.1
  Author:       Nik kyriakidis
 */

namespace nk2580\wordsmith;

class Framework {

    /**
     * include all files required for the framework
     */
    public static function Boot() {
        //inlcude the composer package and it's dependancies
        require_once 'vendor/autoload.php';
    }

}

//INIT THE FRAMEWORK
Framework::Boot();