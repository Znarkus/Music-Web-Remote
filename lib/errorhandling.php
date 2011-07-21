<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);

error_reporting(E_ALL | E_STRICT);

set_error_handler(function($errno, $errstr, $errfile, $errline){
	if (!(error_reporting() & $errno)) {
	    return;
	}
	
	$backtrace = array_slice(debug_backtrace(), 1);
	
	if (ENV !== 'console') {
		while (ob_get_clean()) {};
	}
	
	if (ENV !== 'default') {
		if (ENV !== 'console') {
			header('Content-type: text/plain');
		}
		
		echo "\n{$errstr}\n" . str_repeat('=', mb_strlen($errstr, 'utf-8')) . "\n\n";
		echo dirname($errfile) . DIRECTORY_SEPARATOR . basename($errfile) . " on line {$errline}\n\n";
		print_r($backtrace);
		exit;
		
	} else {
		header('Content-type: text/html');
		echo "<h1>{$errstr}</h1>";
		echo "<p>" . dirname($errfile) . DIRECTORY_SEPARATOR . "<b>" . basename($errfile) . "</b> on line <b>{$errline}</b></p>";
		echo "<pre>";
		print_r($backtrace);
		echo "</pre>";
		exit;
	}
	
	return true;
});
