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
class TextField extends Input {

    public function printField() {
        $class = $this->getClassString();
        if (!$this->readonly) {
            echo "<label for=\"" . $this->name . "\" >" . $this->label . " <input type=\"text\" name=\"" . $this->name . "\" class=\"" . $class . "\" id=\"" . $this->name . "\" value=\"" . $this->value . "\" /></label>";
        } else {
            echo "<label for=\"" . $this->name . "\" >" . $this->label . " <input type=\"text\" readonly name=\"" . $this->name . "\" class=\"" . $class . "\" id=\"" . $this->name . "\" value=\"" . $this->value . "\" /></label>";
        }
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
