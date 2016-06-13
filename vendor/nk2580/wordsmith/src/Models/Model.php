<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace nk2580\wordsmith\Models;

class Model {

    public function __construct() {
        
    }

    //setting dynamically for each ancesstors classes attributs
    public function __set($name, $value) {
        $atts = get_object_vars($this);
        foreach ($atts as $att => $val) {
            if ($name == $att) {
                $this->$name = $value;
            }
        }
    }

    //getting dynamically for each ancesstors classes attributs
    public function __get($name) {
        $atts = get_object_vars($this);
        foreach ($atts as $att => $val) {
            if ($name == $att) {
                return $this->$name;
                break;
            }
        }
    }

    public function fill($inputs) {
        if (is_object($inputs)) {
            $inputs = json_decode(json_encode($inputs), TRUE);
        }
        foreach ($inputs as $key => $val) {
            if (is_array($val)) {
                $this->$key = $val['AQ_ID'];
            } else {
                $this->$key = $val;
            }
        }
    }

}
