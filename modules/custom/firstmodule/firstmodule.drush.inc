<?php 

function firstmodule_drush_command(){
	$items = array();
	$items['hello-world'] = [
		'description' => 'My first drush command',
		'arguments' => [
		  'name' => 'Hello-world',
		],
		'aliases' => ['hr'],
	];

return $items;

}

function drush_firstmodule_hello_world(){
	echo "helloWorld";
}