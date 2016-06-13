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
class ImageUploadField extends Input {


    public function printField() {
        echo '<div class="image-upload">';
        echo '<br/>';
        echo '</div>';
    }

    private function add_scripts() {
        
    }

}

?>