<?php

class Lib_Radio
{
	const COMMAND_PLAY = 'play';
	const COMMAND_STOP = 'stop';
	
	public function __construct()
	{
		
	}
	
	public function command($command, $group_name, $station_name)
	{
		$station = Lib_Station_Factory::create($group_name, $station_name);
		
		switch ($command) {
			case self::COMMAND_PLAY:
				$station->play();
			break;
			
			case self::COMMAND_STOP:
				$station->stop();
			break;
			
			default:
				throw new InvalidArgumentException("Invalid command {$command}");
		}
	}
	
	public function stations()
	{
		$stations = array();
		
		foreach (glob('station/*/*.php') as $filename) {
			preg_match('@^station/([a-z0-9]+)/([a-z0-9]+)\.php$@i', $filename, $m);
			$stations[$m[1]][] = $m[2];
		}
		
		return $stations;
	}
	
	public function stations_playing()
	{
		return Lib_Station_Pid::playing_stations();
	}
}