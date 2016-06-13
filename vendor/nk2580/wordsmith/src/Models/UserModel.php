<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace nk2580\wordsmith\Models;

/**
 * Description of UserModel
 *
 * @author accounts
 */
class UserModel extends Model {

    public $ID;
    static $UserRole;

    /**
     * get all model items in an array
     * 
     * @return \Pushworth\Models\this
     */
    public static function all() {
        $models = false;
        $users = get_users(array('role' => static::$UserRole));
        foreach ($users as $u) {
            $model = new static;
            $model->ID = $u->ID;
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
            'role' => static::$UserRole // Default 'post'.
        );
        $post_id = wp_insert_user($post);
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
            $this->$key = get_user_meta($this->ID, '__conduit_' . $key, true);
        }
    }

    /**
     * save the data to the DB
     */
    private function storeData() {
        $atts = get_object_vars($this);
        foreach ($atts as $key => $val) {
            update_user_meta($this->ID, '__conduit_' . $key, $val);
        }
    }

    /**
     * get the last login for a given user id
     * 
     * @return type
     */
    public function getLastLogin() {
        $last_login = get_user_meta($this->ID, 'last_login', true);
        //picking up wordpress date time format
        $date_format = get_option('date_format') . ' ' . get_option('time_format');
        //converting the login time to wordpress format
        $the_last_login = mysql2date($date_format, $last_login, false);
        //finally return the value
        return $the_last_login;
    }

}
