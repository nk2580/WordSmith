<?php

/*
 * WORDSMITH ACTION CLASS
 * 
 * this class is the base object for a custom action to be added into wordpress.
 * it is a best prectise initiative that all actions to implement custom wordpress logic be enclosed in a single class which exnteds this class.
 */

namespace nk2580\wordsmith\Actions;

class Action {

	protected $hook;
	protected $callback;
	protected $priority = 10;
	protected $accepted_args = 1;

	public function __construct() {
		$this->callAction( $this->hook, $this->callback, $this->priority, $this->accepted_args );
	}

	private function callAction( $hook, $callback, $priority = null, $args = null ) {
		add_action( $hook, array( $this, $callback ), $priority, $args );
	}

}
