<?php

class Lib_Station_Factory
{
	/**
	* @return Lib_Station_Abstract
	*/
	public static function create($group, $station)
	{
		$class_name = 'Station_' . ucfirst($group) . '_' . ucfirst($station);
		return new $class_name($group, $station);
	}
}