<?php
/**
 * TrackMania Web Services SDK for PHP
 *
 * @copyright   Copyright (c) 2009-2011 NADEO (http://www.nadeo.com)
 * @license     http://www.gnu.org/licenses/lgpl.html LGPL License 3
 * @author      $Author$:
 * @version     $Revision$:
 * @date        $Date$:
 */

namespace TrackMania\WebServices;

/**
 * Access to public zones data.
 * You can either work with zones using their IDs of their full paths.
 */
class Zones extends HTTPClient
{

	/**
	 * @param int $id A zone id
	 * @return object
	 * @throws \TrackMania\WebServices\Exception 
	 */
	function get($id)
	{
		return $this->execute('GET', '/tmf/zones/id/%s/', array($id));
	}

	/**
	 *
	 * @param string $path A valid path, eg. "World|France"
	 * @return object
	 * @throws \TrackMania\WebServices\Exception 
	 */
	function getByPath($path)
	{
		return $this->execute('GET', '/tmf/zones/path/%s/', array($path));
	}

	/**
	 *
	 * @param int $offset Offset starting from 0
	 * @param int $length Length of the response
	 * @param string $sort Sort by: 'id', 'name'
	 * @param int $order Order by 1 or -1
	 * @return array Array of zones
	 * @throws \TrackMania\WebServices\Exception 
	 */
	function getAll($offset = 0, $length = 10, $sort = '', $order = '')
	{
		return $this->execute('GET',
			'/tmf/zones/all/?offset=%s&length=%s&sort=%s&order=%s',
			array($offset, $length, $sort, $order));
	}

	/**
	 *
	 * @param int $id A zone id
	 * @param int $offset Offset starting from 0
	 * @param int $length Length of the response
	 * @param string $sort Sort by: 'id', 'name'
	 * @param int $order Order by 1 or -1
	 * @return array Array of zones
	 * @throws \TrackMania\WebServices\Exception 
	 */
	function getChildren($id, $offset = 0, $length = 10, $sort = '', $order = '')
	{
		return $this->execute('GET',
			'/tmf/zones/id/%s/children/?offset=%s&length=%s&sort=%s&order=%s',
			array($id, $offset, $length, $sort, $order));
	}

	/**
	 *
	 * @param string $path A valid path, eg. "World|France"
	 * @param int $offset Offset starting from 0
	 * @param int $length Length of the response
	 * @param string $sort Sort by: 'id', 'name'
	 * @param int $order Order by 1 or -1
	 * @return array Array of zones
	 * @throws \TrackMania\WebServices\Exception 
	 */
	function getChildrenByPath($path, $offset = 0, $length = 10, $sort = '',
		$order = '')
	{
		return $this->execute('GET',
			'/tmf/zones/path/%s/children/?offset=%s&length=%s&sort=%s&order=%s',
			array($path, $offset, $length, $sort, $order));
	}

	/**
	 *
	 * @param string $path A valid path, eg. "World|France"
	 * @return int
	 * @throws \TrackMania\WebServices\Exception  
	 */
	function getId($path)
	{
		return $this->execute('GET', '/tmf/zones/path/%s/id/', array($path));
	}

}

?>