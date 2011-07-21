<?php

class Station_Sweden_P4sthlm extends Lib_Station_Abstract
{
	public function play($volume)
	{
		$this->_run('mplayer -playlist http://sverigesradio.se/topsy/direkt/701-mp3.asx');
	}
	
	public function name()
	{
		return 'P4 Stockholm';
	}
}