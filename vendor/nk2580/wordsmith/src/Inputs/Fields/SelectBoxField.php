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
class SelectBoxField extends Input {

    protected $options;
    
    public function __construct($name, $options, $label = '', $value = '', $class = '', $readonly = false) {
        parent::__construct($name, $label, $value, $class, $readonly);
        $this->options = $options;
    }

    public function printField() {
        $class = $this->getClassString();
        echo '<label for="' . $this->name . '" >'.$this->label.' ';
        echo '<select class="' . $class . '" name="' . $this->name . '"  id="' . $this->name . '">';
        foreach ($this->options as $label => $value) {
            if ($this->value == $value) {
                echo '<option selected="selected" value="'.$value.'">'.$label.'</option>';
            } else {
                echo '<option value="'.$value.'">'.$label.'</option>';
            }
        }
        echo '</select></label>';
        echo '<br/>';
    }

    public function isFieldValid() {
            return true;
    }

    public function sanitize() {
        return $this->value;
    }

}
