<?php

/*
 * WORDSMITH ACTION CLASS
 * 
 * this class is the base object for a custom action to be added into wordpress.
 * it is a best prectise initiative that all actions to implement custom wordpress logic be enclosed in a single class which exnteds this class.
 */

namespace nk2580\wordsmith\Endpoints;

class Endpoint {

    public $vars = [];
    public $endpoints = [];
    public $callback;
    public $position = 'top';

    /**
     * Hook WordPress
     * @return void
     */
    public function __construct() {
        add_filter('query_vars', array($this, 'add_query_vars'), 0);
        add_action('parse_request', array($this, $this->callback), 0);
        add_action('init', array($this, 'add_endpoints'), 0);
    }

    /**
     *  Add public query vars
     * 	@param array $vars List of current public query vars
     * 	@return array $vars 
     */
    public function add_query_vars($vars) {
        $allVars = array_merge($vars, $this->vars);
        return $allVars;
    }

    /**
     *  Add API Endpoint
     * 	This is where the magic happens - brush up on your regex skillz
     * 	@return void
     */
    public function add_endpoints() {
        foreach ($this->endpoints as $regex => $query) {
            add_rewrite_rule( $regex, $query ,$this->position);
        }
    }

}
