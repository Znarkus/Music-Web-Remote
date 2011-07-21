<?php

class Lib_Radio
{
	const COMMAND_PLAY = 'play';
	const COMMAND_STOP = 'stop';
	
	public function __construct()
	{
		
	}
	
	public function command($parameters)
	{
		$station = Lib_Station_Factory::create($parameters['group'], $parameters['station']);
		
		switch ($parameters['command']) {
			case self::COMMAND_PLAY:
				$station->play(isset($parameters['volume']) ? $parameters['volume'] : null);
			break;
			
			case self::COMMAND_STOP:
				$station->stop();
			break;
			
			default:
				throw new InvalidArgumentException("Invalid command {$parameters['command']}");
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