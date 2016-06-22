<?php

/*
 * WORDSMITH ACTION CLASS
 * 
 * this class is the base object for a custom action to be added into wordpress.
 * it is a best prectise initiative that all actions to implement custom wordpress logic be enclosed in a single class which exnteds this class.
 */

namespace nk2580\wordsmith\Shortcodes;

class Shortcode {
    
	protected $code;
	protected $callback;

	public function __construct() {
		$this->callAction( $this->code, $this->callback );
	}

	private function callAction( $code, $callback ) {
		add_action( $code, array( $this, $callback ) );
	}

}
