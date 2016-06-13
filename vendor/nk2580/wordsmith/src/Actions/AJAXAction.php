<?php

/*
 * WORDSMITH ACTION CLASS
 * 
 * this class is the base object for a custom action to be added into wordpress.
 * it is a best prectise initiative that all actions to implement custom wordpress logic be enclosed in a single class which exnteds this class.
 */

namespace nk2580\wordsmith\Actions;

class AJAXAction {

    protected $nopriv = true;
    protected $action;
    protected $callback;

    public function __construct() {
        $this->callAction('wp_ajax_' . $this->action, $this->callback, $this->priority, $this->accepted_args);
        if ($this->nopriv) {
            $this->callAction('wp_ajax_norpiv_' . $this->action, $this->callback, $this->priority, $this->accepted_args);
        }
    }

    private function callAction($hook, $callback, $priority = null, $args = null) {
        add_action($hook, array($this, $callback), $priority, $args);
    }

}
