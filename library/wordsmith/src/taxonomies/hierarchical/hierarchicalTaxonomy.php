<?php

/*
 * WORDSMITH HEIRACHICAL TAXONOMY CLASS
 * 
 * this class is the base object for a custom action to be added into wordpress.
 * it is a best prectise initiative that all actions to implement custom wordpress logic be enclosed in a single class which exnteds this class.
 */

namespace wordsmith\taxonomies\hierarchical;

use wordsmith\taxonomies\taxonomy as taxonomy;

class hierarchicalTaxonomy extends taxonomy {

	protected $name;
	protected $post_type;
	protected $args;
	protected $labels;

	function create() {
		$this->args['labels'] = $this->labels;
		$this->args['hierarchical'] = true;
		register_taxonomy( $this->name, $this->post_type, $this->args );
	}

}
