<?php

/*
 * WORDSMITH INPUT GENERIC CLASS
 * 
 * the input class to be used within the framework
 * 
 * The repeater has an array of fields within it which it uses as the base of its repetiton system,
 * it essentially acts as a container which coupled with some javascript repeats the contained fields if required.
 * 
 */

namespace nk2580\wordsmith\Inputs;

class Repeater extends Input {

    protected $name;
    protected $class;
    protected $label;
    
    protected $fields = [
        
    ];

    public function __construct($name, $class, $readonly) {
        $this->name = $name;
        $this->class = $class;
        $this->readonly = $readonly;
        $this->printField();
    }

    protected function printField() {
        echo "Implementing the Input class directly is foribbben. please use an input field or type";
    }

    protected function getClassString() {
        $string = "";
        if (is_array($this->class)) {
            foreach ($this->class as $class) {
                $string .= $class . " ";
            }
            return $string;
        } else {
            return $this->class;
        }
    }

}
