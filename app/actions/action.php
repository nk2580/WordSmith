<?php
/*
 * WORDSMITH ACTION CLASS
 * 
 * this class is the base object for a custom action to be added into wordpress.
 * it is a best prectise initiative that all actions to implement custom wordpress logic be enclosed in a single class which exnteds this class.
 */
namespace wordsmith\app\actions;

class action {

	public $hook;
	public $callback;
	public $priority = 10;
	public $accepted_args = 1;
	
	public function __construct() {
		$this->call_add_action($this->hook,$this->callback,$this->priority, $this->accepted_args);
	}
	
	private function call_add_action($hook,$callback,$priority, $args){
		add_action( $hook, array( $this, $callback ), $priority = null, $args = null );
	}

}
