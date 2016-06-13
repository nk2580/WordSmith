<?php

/*
 * WORDSMITH MENU CLASS
 * 
 * this class is the base object for a post type to be added into wordpress.
 * 
 */

namespace nk2580\wordsmith\Menus;

class Menu {

    protected $menu;

    public function __construct() {
        add_action('after_setup_theme', array($this, 'add_menus'));
    }

    public function add_menus() {
        foreach ($this->menu as $slug => $description) {
            register_nav_menu($slug, $description);
        }
    }

}
