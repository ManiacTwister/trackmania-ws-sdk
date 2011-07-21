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
 * Access to public global solo rankings data
 */
class SoloRankings extends HTTPClient
{

	/**
	 * @param int $offset Offset starting from 0
	 * @param int $length Length of the response
	 * @return object 
	 * @throws \TrackMania\WebServices\Exception
	 */
	function getPlayerWorldRanking($offset = 0, $length = 10)
	{
		return $this->execute('GET',
			'/tmf/rankings/solo/players/?offset=%s&length=%s', array($offset, $length));
	}

	/**
	 * @param string $path A valid path, eg. "World|France"
	 * @param int $offset Offset starting from 0
	 * @param int $length Length of the response
	 * @return object 
	 * @throws \TrackMania\WebServices\Exception
	 */
	function getPlayerRanking($path, $offset = 0, $length = 10)
	{
		return $this->execute('GET',
			'/tmf/rankings/solo/players/%s/?offset=%s&length=%s',
			array($path, $offset, $length));
	}

	/**
	 * @param string $challengeUID A challenge UID, eg. "BeySZdnfuSh4nHY5xztiXLmlrXe" (A01-Race)
	 * @param int $offset Offset starting from 0
	 * @param int $length Length of the response
	 * @return object 
	 * @throws \TrackMania\WebServices\Exception
	 */
	function getPlayerWorldRankingForChallenge($challengeUID, $offset = 0,
		$length = 10)
	{
		return $this->execute('GET',
			'/tmf/rankings/solo/challenges/%s/players/?offset=%s&length=%s',
			array($challengeUID, $offset, $length));
	}

	/**
	 * @param string $path A valid path, eg. "World|France"
	 * @param int $offset Offset starting from 0
	 * @param int $length Length of the response
	 * @return object 
	 * @throws \TrackMania\WebServices\Exception
	 */
	function getPlayerRankingForChallenge($challengeUID, $path, $offset = 0,
		$length = 10)
	{
		return $this->execute('GET',
			'/tmf/rankings/solo/challenges/%s/players/%s/?offset=%s&length=%s',
			array($challengeUID, $path, $offset, $length));
	}

}

?>