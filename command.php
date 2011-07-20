<?php

require('top.php');

if (ENV === 'console') {
	if (count($_SERVER['argv']) !== 4) {
		echo "\nUsage:\t{$_SERVER['argv'][0]} [command] [group] [station]\n\n";
		exit;
	}
	
	$command = $_SERVER['argv'][1];
	$group_name = $_SERVER['argv'][2];
	$station_name = $_SERVER['argv'][3];
} else {
	$command = $_GET['c'];
	$group_name = basename($_GET['g']);
	$station_name = basename($_GET['s']);
}

$radio = new Lib_Radio();

if ($command === Lib_Radio::COMMAND_PLAY) {
	foreach ($radio->stations_playing() as $g => $stations) {
		foreach ($stations as $s) {
			Lib_Station_Factory::create($g, $s)->stop();
		}
	}
}

$radio->command($command, $group_name, $station_name);

if (ENV === 'default') {
	header('Location: ./');
}

exit;