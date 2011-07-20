<?php

class Lib_Station_Pid
{
	private $_group;
	private $_station;
	
	public function __construct($group, $station)
	{
		$this->_group = $group;
		$this->_station = $station;
	}
	
	public function load()
	{
		return file_get_contents(self::_filename($this->_group, $this->_station));
	}
	
	public function save($pid)
	{
		file_put_contents(self::_filename($this->_group, $this->_station), $pid);
	}
	
	public function delete()
	{
		unlink(self::_filename($this->_group, $this->_station));
	}
	
	public function playing()
	{
		return is_file(self::_filename($this->_group, $this->_station));
	}
	
	public static function playing_stations()
	{
		$stations = array();
		
		foreach (glob(self::_filename('*', '*')) as $filename) {
			preg_match('/^running\.([a-z0-9]+)\.([a-z0-9]+)\.pid$/i', basename($filename), $m);
			$stations[$m[1]][] = $m[2];
		}
		
		return $stations;
	}
	
	private static function _dir()
	{
		return 'data/';
	}
	
	private static function _filename($group, $station)
	{
		return self::_dir() . "running.{$group}.{$station}.pid";
	}
}