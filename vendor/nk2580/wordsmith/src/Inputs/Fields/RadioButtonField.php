<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace nk2580\wordsmith\Inputs\Fields;

use nk2580\wordsmith\Inputs\Input as Input;

/**
 * Description of TextField
 *
 * @author accounts
 */
class RadioButtonField extends Input {

    protected $options;

    public function __construct($name, $options, $label = '', $value = '', $class = '', $readonly = false) {
        parent::__construct($name, $label, $value, $class, $readonly);
        $this->options = $options;
    }

    public function printField() {
        $class = $this->getClassString();
        foreach ($this->options as $label => $value) {
            if ($this->value == $value) {
echo '<label for="'.$this->name.$value.'"><input type="radio" checked="checked" name="'.$this->name.'" class="'.$class.'" id="'.$this->name.$value.'" value="'.$value.'"/> '.$label.'</label>';
            } else {
echo '<label for="'.$this->name.$value.'"><input type="radio"  name="'.$this->name.'" class="'.$class.'" id="'.$this->name.$value.'" value="'.$value.'"/> '.$label.'</label>';
            }
            echo '<br/>';
        }
    }

    public function isFieldValid() {
        return true;
    }

    public function sanitize() {
        return ($this->value);
    }

}

?>