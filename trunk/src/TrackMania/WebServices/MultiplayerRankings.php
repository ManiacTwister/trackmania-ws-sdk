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
 * Access to public global multiplayer rankings data
 */
class MultiplayerRankings extends HTTPClient
{

	/**
	 * @param string $path A valid path, eg. "World|France"
	 * @param string $environment A valid environment, eg. "Stadium"
	 * @param int $offset Offset starting from 0
	 * @param int $length Length of the response
	 * @return object 
	 * @throws \TrackMania\WebServices\Exception
	 */
	function getPlayerRanking($path = 'World', $environment = 'Merge', $offset = 0,
		$length = 10)
	{
		return $this->execute('GET',
			'/tmf/rankings/multiplayer/players/%s/%s/?offset=%s&length=%s',
			array($path, $environment, $offset, $length));
	}

	/**
	 * @param string $path A valid path, eg. "World|France"
	 * @param int $offset Offset starting from 0
	 * @param int $length Length of the response
	 * @return object 
	 * @throws \TrackMania\WebServices\Exception
	 */
	function getZoneRanking($path = 'World', $offset = 0, $length = 10)
	{
		return $this->execute('GET',
			'/tmf/rankings/multiplayer/zones/%s/?offset=%s&length=%s',
			array($path, $offset, $length));
	}

}

?>