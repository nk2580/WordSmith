<?php

/*
 * WORDSMITH INPUT GENERIC CLASS
 * 
 * the input class to be used within the framework
 */

namespace nk2580\wordsmith\Inputs;

class Input {

    protected $name;
    protected $class = "";
    protected $readonly;
    protected $value;
    protected $label;

    public function __construct($name, $label = '', $value = '', $class = '', $readonly = false) {
        $this->name = $name;
        $this->class = $class;
        $this->value = $value;
        $this->label = $label;
        $this->readonly = $readonly;
    }

    public function printField() {
        echo "Implementing the Input class directly is foribbben. please use an input field or type";
    }

    public function isFieldValid() {
        return true;
    }

    public function sanitize() {
        return $this->value;
    }
    
    protected function getClassString() {
        $string = "";
        if (is_array($this->class)) {
            foreach ($this->class as $class) {
                $string .= $class . " ";
            }
            return $string;
        } else if (empty($this->class)) {
            return $string;
        } else {
            return $this->class;
        }
    }
}
