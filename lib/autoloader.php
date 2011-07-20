<?php

function auto_load($class_name)
{
	if (is_file($filename = str_replace('_', '/', strtolower($class_name)) . '.php')) {
		require($filename);
		return true;
	} else {
		return false;
	}
}

spl_autoload_register('auto_load');