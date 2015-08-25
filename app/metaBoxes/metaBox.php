<?php
/*
 * WORDSMITH META BOX CLASS
 * 
 * this class is the base object for a custom meta box to be added into wordpress.
 * 
 */

namespace wordsmith\app\metaBoxes;

class metaBox {

	private $post_type;
	private $title;
	private $context;
	private $priority;

	/**
	 * Hook into the appropriate actions when the class is constructed.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_boxes' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}

	/**
	 * Adds the meta box container.
	 */
	public function add_boxes() {
		if ( is_array( $this->post_type ) ) {
			foreach ( $this->post_type as $screen ) {
				add_box( $this->title, $screen, $this->context, $this->priority );
			}
		} else {
			add_box( $this->title, $this->post_type, $this->context, $this->priority );
		}
	}

	private function add_box( $title, $screen, $context, $priority ) {
		add_meta_box( __CLASS__, $title, array( $this, 'content' ), $screen, $context, $priority );
	}

	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save( $post_id ) {

		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( !isset( $_POST['myplugin_inner_custom_box_nonce'] ) )
			return $post_id;

		$nonce = $_POST['myplugin_inner_custom_box_nonce'];

		// Verify that the nonce is valid.
		if ( !wp_verify_nonce( $nonce, 'myplugin_inner_custom_box' ) )
			return $post_id;

		// If this is an autosave, our form has not been submitted,
		//     so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] ) {

			if ( !current_user_can( 'edit_page', $post_id ) )
				return $post_id;
		} else {

			if ( !current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}

		/* OK, its safe for us to save the data now. */

		// Sanitize the user input.
		$mydata = sanitize_text_field( $_POST['myplugin_new_field'] );

		// Update the meta field.
		update_post_meta( $post_id, '_my_meta_value_key', $mydata );
	}

	/**
	 * Render Meta Box content.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function content( $post ) {

		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$value = get_post_meta( $post->ID, '_my_meta_value_key', true );

		// Display the form, using the current value.
		echo '<label for="myplugin_new_field">';
		_e( 'Description for this field', 'myplugin_textdomain' );
		echo '</label> ';
		echo '<input type="text" id="myplugin_new_field" name="myplugin_new_field"';
		echo ' value="' . esc_attr( $value ) . '" size="25" />';
	}

}
