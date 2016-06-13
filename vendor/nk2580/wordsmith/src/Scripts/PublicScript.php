<?php

/*
 * WORDSMITH SCRIPT CLASS
 * 
 * this class is the base object for a custom action to be added into wordpress.
 * it is a best prectise initiative that all actions to implement custom wordpress logic be enclosed in a single class which exnteds this class.
 */

namespace nk2580\wordsmith\Scripts;

class PublicScript extends \nk2580\wordsmith\Actions\Action  {

	protected $hook = "wp_enqueue_scripts";

}
