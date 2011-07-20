<?php

class Station_Sweden_P2 extends Lib_Station_Abstract
{
	public function play()
	{
		$this->_run('mplayer -playlist http://sverigesradio.se/topsy/direkt/2562-mp3.asx');
	}
}