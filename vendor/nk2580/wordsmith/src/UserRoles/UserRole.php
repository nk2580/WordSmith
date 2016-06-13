<?php

/*
 * WORDSMITH USER ROLE CLASS
 * 
 * this class is the base object for a custom action to be added into wordpress.
 * it is a best prectise initiative that all actions to implement custom wordpress logic be enclosed in a single class which exnteds this class.
 */

namespace nk2580\wordsmith\UserRoles;

class UserRole {

    protected $role_name;
    protected $display_name;
    protected $capabilities = [];

    public function __construct() {
        add_action( 'init', array( $this, 'callAddRole' ) );
    }

    public function callAddRole() {
        add_role( $this->role_name, $this->display_name, $this->capabilities );
    }

}
