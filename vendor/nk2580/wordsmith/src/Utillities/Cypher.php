<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace nk2580\wordsmith\Utillities;

/**
 * Description of Cypher
 *
 * @author accounts
 */
class Cypher extends \Illuminate\Encryption\Encrypter {

    public function __construct($key) {
        parent::__construct($key);
    }

}
