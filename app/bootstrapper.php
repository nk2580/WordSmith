<?php
/*
 * 
 * APP BOOTSTRAPPER
 * 
 * this file includes the all created application 
 * 
 * 
 */
foreach (glob(get_template_directory()."/app/*/*.php") as $filename) {
    require_once $filename;
}