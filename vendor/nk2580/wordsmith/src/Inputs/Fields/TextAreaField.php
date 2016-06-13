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
class TextAreaField extends Input {

    public function printField() {
        $class = $this->getClassString();
        echo '<label for="' . $this->name . '" >' . $this->label . ' ';
        echo '<textarea class="' . $class . '" name="' . $this->name . '"  id="' . $this->name . '">';
        echo $this->value;
        echo '</textarea></label>';
        echo '<br/>';
    }

    public function isFieldValid() {
        if (strlen($this->value) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function sanitize() {
        return sanitize_text_field($this->value);
    }
    
}
