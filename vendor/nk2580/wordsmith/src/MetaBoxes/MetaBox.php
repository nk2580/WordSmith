<?php

/*
 * WORDSMITH META BOX CLASS
 *
 * this class is the base object for a custom meta box to be added into wordpress.
 *
 */

namespace nk2580\wordsmith\MetaBoxes;

class MetaBox {

    protected $name;
    protected $post_type;
    protected $title;
    protected $context = 'side';
    protected $priority = 'default';
    protected $fields = [
        ['label' => "Exmple Field", 'meta-key' => "example_meta", 'control' => "nk2580\wordsmith\Inputs\Fields\TextField"],
    ];

    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct() {
        $this->init();
    }

    public function init() {
        add_action('add_meta_boxes', array($this, 'add_boxes'));
        add_action('save_post', array($this, 'save_box_content'));
    }

    /**
     * Adds the meta box container.
     */
    public function add_boxes() {
        foreach ($this->post_type as $screen) {
            add_meta_box($this->name, $this->title, array($this, 'load_box_content'), $screen, $this->context, $this->priority);
        }
    }

    /**
     * Save the meta when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save($post_id) {
        foreach ($this->fields as $field) {
            if (isset($field['options'])) {
                $control = new $field['control']($field['meta-key'], $field['options'], $field['label'], $_POST[$field['meta-key']]);
            } else {
                $control = new $field['control']($field['meta-key'], $field['label'], $_POST[$field['meta-key']]);
            }
            if ($control->isFieldValid()) {
                update_post_meta($post_id, $field['meta-key'], $control->sanitize());
            }
            else{
                return $field['meta-key'];
            }
        }
    }

    /**
     * vefiy we can save the data.
     */
    public function verify_save($post_id) {

        if (!isset($_POST[$this->name . '_box_nonce']))
            return $post_id;

        $nonce = $_POST[$this->name . '_box_nonce'];

        if (!wp_verify_nonce($nonce, $this->name . '_box'))
            return $post_id;

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post_id;

        if ('page' == $_POST['post_type']) {

            if (!current_user_can('edit_page', $post_id))
                return $post_id;
        } else {

            if (!current_user_can('edit_post', $post_id))
                return $post_id;
        }
    }

    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function content($post) {
        foreach ($this->fields as $field) {
            $value = get_post_meta($post->ID, $field['meta-key'], true);
            if (isset($field['options'])) {
                $control = new $field['control']($field['meta-key'], $field['options'], $field['label'], $value);
            } else {
                $control = new $field['control']($field['meta-key'], $field['label'], $value);
            }
            $control->printField();
        }
    }

    /*
     * Add The Box Nonce To The Meta Box
     */

    private function add_nonce() {
        // Add an nonce field so we can check for it later.
        wp_nonce_field($this->name . '_box', $this->name . '_box_nonce');
    }

    /*
     * load the content of the box
     */

    public function load_box_content($post) {
        $this->add_nonce();
        $this->content($post);
    }

    /*
     * load the content of the box
     */

    public function save_box_content($post_id) {
        $this->verify_save($post_id);
        $this->save($post_id);
    }

}