<?php

class Station_Sweden_P1 extends Lib_Station_Abstract
{
	public function play($volume)
	{
		$command = 'mplayer -playlist http://sverigesradio.se/topsy/direkt/132-mp3.asx';
		
		if ($volume) {
			$this->_run("{$command} -volume %s", array($volume));
		} else {
			$this->_run($command);
		}
	}
}