<?php

$dir = dirname(__FILE__);

set_include_path(
	$dir . '/includes' . PATH_SEPARATOR . 
	get_include_path()
);

$templatePath = $dir . '/templates';
$statusPath = $dir . '/status.log';

require_once 'helpers.php';
require_once 'secret.php';
require_once 'template.php';
require_once 'command.php';
require_once 'commands.php';
require_once 'glue.php';

$urls = array(
	'/' => 'home',
	'/status' => 'status',
	'/status/edit' => 'edit_status'
);

glue::stick($urls);
