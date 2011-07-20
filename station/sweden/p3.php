<?php

class Station_Sweden_P3 extends Lib_Station_Abstract
{
	public function play()
	{
		$this->_run('mplayer -playlist http://sverigesradio.se/topsy/direkt/164-mp3.asx');
	}
}