<?php

if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
	define('ENV', 'ajax');
} else if (isset($_SERVER['argv'])) {
	define('ENV', 'console');
} else {
	define('ENV', 'default');
}

require('lib/errorhandling.php');

if (ENV === 'console') {
	chdir(dirname(__FILE__));
}

mb_internal_encoding('utf-8');
mb_regex_encoding('utf-8');

if (ENV === 'default') {
	header('Content-type: text/html; charset=utf-8');
} else if (ENV === 'ajax') {
	header('Content-type: application/json');
}

session_start();

require('lib/autoloader.php');