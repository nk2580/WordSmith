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
class GalleryField extends Input {

    public function printField() {
        echo '<div class="image-upload">';
        if (!$this->readonly) {
            echo "<input type='hidden' name='" . $this->name . '" id="' . $this->name . '" value="'.$this->value.'" />';
            if(!empty($this->value)){
                echo "<img id='" . $this->name . "' src='".$this->value."' class='image-preview' />";
            }
            echo "<a data-toggle='image' data-target='#" . $this->name . "'>Select image</a>";
        } else {
            echo "<img src='".$this->value."' class='image-preview' />";
        }
        echo '</div>';
        echo '<br/>';
    }

    private function add_script() {
        
    }

}

?>