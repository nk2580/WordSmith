<?php
namespace app\actions;

use \wordsmith\actions\action as action;

class actionTest extends action{
	
	public $hook = "admin_enqueue_scripts";
	public $callback = "printTest";
	public $priority ;
	public $accepted_args;
	
	function printTest(){
		
	}
	
}
$actionTest = new actionTest();