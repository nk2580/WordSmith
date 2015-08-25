<?php
/*
 * 
 * FRAMEWORK BOOTSTRAPPER
 * 
 * this file includes the FRAMEWORK CLASSES
 * 
 * ONLY USE THIS PACKAGE IF YOU ARE NOT USING COMPOSER 
 * 
 * 
 */
foreach (glob(dirname(__FILE__)."/src/*/*.php") as $filename) {
    require_once $filename;
}