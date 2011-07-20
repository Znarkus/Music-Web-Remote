<?php

class Station_Sweden_P1 extends Lib_Station_Abstract
{
	public function play()
	{
		$this->_run('mplayer -playlist http://sverigesradio.se/topsy/direkt/132-mp3.asx');
	}
}