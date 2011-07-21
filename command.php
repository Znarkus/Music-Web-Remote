<?php

require('top.php');

if (ENV === 'console') {
	if (count($_SERVER['argv']) !== 4) {
		echo "\nUsage:\t{$_SERVER['argv'][0]} command group station [volume]\n\n";
		exit;
	}
	
	$command = $_SERVER['argv'][1];
	$group_name = $_SERVER['argv'][2];
	$station_name = $_SERVER['argv'][3];
	$volume = isset($_SERVER['argv'][4]) ? $_SERVER['argv'][4] : null;
} else {
	$command = $_GET['c'];
	$group_name = basename($_GET['g']);
	$station_name = basename($_GET['s']);
	$volume = isset($_GET['v']) ? $_GET['v'] : null;
}

$radio = new Lib_Radio();

if ($command === Lib_Radio::COMMAND_PLAY) {
	foreach ($radio->stations_playing() as $g => $stations) {
		foreach ($stations as $s) {
			Lib_Station_Factory::create($g, $s)->stop();
		}
	}
}

$radio->command(array(
	'command' => $command,
	'group' => $group_name,
	'station' => $station_name,
	'volume' => $volume
));

if (ENV === 'default') {
	header('Location: ./');
}

exit;