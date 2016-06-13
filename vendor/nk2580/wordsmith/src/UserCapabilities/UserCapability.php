<?php

/*
 * WORDSMITH CAPABILITY CLASS
 * 
 * this class is the base object for a custom action to be added into wordpress.
 * it is a best prectise initiative that all actions to implement custom wordpress logic be enclosed in a single class which exnteds this class.
 */

namespace nk2580\wordsmith\UserCapabilities;

class UserCapability {

    public $role_name;
    public $caps;

    public function __construct() {
        add_action( 'admin_init', array($this,'add_theme_caps'));
    }
    function add_theme_caps() {
        $role = get_role( $this->role_name );
        if(is_array($this->caps)){
            foreach($this->caps as $cap){
                $role->add_cap( $cap );
            }
        }
        else{
            $role->add_cap( $this->caps );
        }
    }

}
