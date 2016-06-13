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
class CheckBoxField extends Input {

    public function printField() {
        $class = $this->getClassString();
        if ($this->value == 1) {
            echo '<label for="' . $this->name . '"><input checked="checked" type="checkbox" name="' . $this->name . '" class="' . $class . '" id="' . $this->name . '" value="1" >'.$this->label.'</label>';
        } else {
            echo '<label for="' . $this->name . '"><input type="checkbox" name="' . $this->name . '" class="' . $class . '" id="' . $this->name . '" value="1" >'.$this->label.'</label>';
        }
        echo '<br/>';
    }

    public function isFieldValid() {
        return true;
    }

    public function sanitize() {
        return ($this->value);
    }

}
