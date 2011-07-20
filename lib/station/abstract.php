<?php

abstract class Lib_Station_Abstract
{
	private $_group;
	private $_station;
	private $_pidManager;
	
	abstract public function play();
	
	public function __construct($group, $station)
	{
		$this->_group = $group;
		$this->_station = $station;
		$this->_pidManager = new Lib_Station_Pid($group, $station);
	}
	
	public function name()
	{
		return ucfirst($this->_station);
	}
	
	public function id()
	{
		return $this->_station;
	}
	
	public function group()
	{
		return $this->_group;
	}
	
	public function playing()
	{
		return $this->_pidManager->playing();
	}
	
	public function stop()
	{
		$pid = $this->_pidManager->load();
		exec("kill {$pid}");
		$this->_pidManager->delete();
	}
	
	protected function _run($command)
	{
		exec("{$command} > /dev/null 2>&1 & echo \$!", $return);
		$this->_pidManager->save($return[0]);
	}
}