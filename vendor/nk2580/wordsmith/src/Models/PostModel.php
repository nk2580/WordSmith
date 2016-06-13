<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace nk2580\wordsmith\Models;

/**
 * Description of PostModel
 *
 * @author accounts
 */
class PostModel extends Model {

    public $ID;
    static $postType;

    /**
     * get an array of all model items
     * 
     * @return \Pushworth\Models\this Array
     */
    public static function all() {
        $models = false;
        $posts = get_posts(array('post_type' => static::$postType, 'post_status' => 'publish'));
        foreach ($posts as $p) {
            $model = new static;
            $model->ID = $p->ID;
            $model->fetchData();
            $models[] = $model;
        }
        return $models;
    }

    /**
     * finds a postmodel by its wordpress ID
     * 
     * @param int $ID
     * @return \Pushworth\Models\this
     */
    public static function find($ID) {
        $model = false;
        $models = static::all();
        foreach ($models as $m) {
            if ($m->ID == $ID) {
                $model = $m;
                break;
            }
        }
        return $model;
    }

    /**
     * Get a model by one of its fields
     * 
     * @param type $key
     * @param type $value
     * @return type
     */
    public static function findBy($key, $value) {
        $model = false;
        $models = static::all();
        foreach ($models as $m) {
            if ($m->$key == $value) {
                $model = $m;
                break;
            }
        }
        return $model;
    }

    /**
     * Save a model to wordpress
     */
    public function save() {
        $post = array(
            'ID' => $this->ID, // Are you updating an existing post?
            'post_status' => 'publish', // Default 'draft'.
            'post_type' => static::$postType // Default 'post'.
        );
        $post_id = wp_update_post($post, true);
        if (!is_wp_error($post_id)) {
            $this->storeData();
        } else {
            echo $post_id->get_error_message();
        }
    }

    /**
     * Delete a model from wordpress;
     */
    public function delete() {
        wp_delete_post($this->ID, true);
    }

    /**
     * fetch all meta data to fill a model from the DB 
     */
    private function fetchData() {
        $atts = get_object_vars($this);
        foreach ($atts as $key => $val) {
            $this->$key = get_post_meta($this->ID, '__conduit_' . $key, true);
        }
    }
    
    private function storeData(){
            $atts = get_object_vars($this);
            foreach ($atts as $key => $val) {
                update_post_meta($this->ID, '__conduit_' . $key, $val);
            }
    }

}
