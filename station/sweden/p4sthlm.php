<?php

class Station_Sweden_P4sthlm extends Lib_Station_Abstract
{
	public function play($volume)
	{
		$command = 'mplayer -playlist http://sverigesradio.se/topsy/direkt/701-mp3.asx';
		
		if ($volume) {
			$this->_run("{$command} -volume %s", array($volume));
		} else {
			$this->_run($command);
		}
	}
	
	public function name()
	{
		return 'P4 Stockholm';
	}
}