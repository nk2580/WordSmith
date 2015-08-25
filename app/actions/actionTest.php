<?php
namespace wordsmith\app\actions;

class actionTest extends action{
	
	public $hook = "admin_footer";
	public $callback = "printTest";
	public $priority ;
	public $accepted_args;
	
	function printTest(){
		echo "Hello World";
	}
	
}
$actionTest = new actionTest();