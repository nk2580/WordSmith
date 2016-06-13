<?php
/*
 * WORDSMITH POST TYPE CLASS
 * 
 * this class is the base object for a post type to be added into wordpress.
 * 
 */
namespace nk2580\wordsmith\PostTypes;

class PostType{
	
	protected $name;
	protected $post_type;
	protected $args;
	protected $labels;
	
	public function __construct() {
		add_action( 'init', array( $this, 'create' ));
	}

	function create() {
		$this->args['labels'] = $this->labels;
		register_post_type( $this->name, $this->args );
	}

}