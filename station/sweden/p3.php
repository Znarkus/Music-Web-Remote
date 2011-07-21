<?php

class Station_Sweden_P3 extends Lib_Station_Abstract
{
	public function play($volume = null)
	{
		$command = 'mplayer -playlist http://sverigesradio.se/topsy/direkt/164-mp3.asx';
		
		if ($volume) {
			$this->_run("{$command} -volume %s", array($volume));
		} else {
			$this->_run($command);
		}
	}
}