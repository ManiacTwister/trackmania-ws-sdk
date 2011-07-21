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
 * Access to public players data
 */
class Players extends HTTPClient
{

	/**
	 * @param string $login Login of a TMF player
	 * @return object
	 * @throws \TrackMania\WebServices\Exception 
	 */
	function get($login)
	{
		return $this->execute('GET', '/tmf/players/%s/', array($login));
	}

	/**
	 * @param string $login Login of a TMF player
	 * @return string HTML formatted nickname
	 * @throws \TrackMania\WebServices\Exception 
	 */
	function getNicknameHTML($login)
	{
		return $this->execute('GET', '/tmf/players/%s/nickname/html/', array($login));
	}

	/**
	 * @param string $login Login of a TMF player
	 * @return array Array of tag objects 
	 * @throws \TrackMania\WebServices\Exception 
	 */
	function getTags($login)
	{
		return $this->execute('GET', '/tmf/players/%s/tags/', array($login));
	}

	/**
	 * @param string $login Login of a TMF player
	 * @return object
	 * @throws \TrackMania\WebServices\Exception  
	 */
	function getMultiplayerRanking($login)
	{
		return $this->execute('GET', '/tmf/players/%s/rankings/multiplayer/',
			array($login));
	}

	/**
	 * @param string $login Login of a TMF player
	 * @param type $environment
	 * @return object
	 * @throws \TrackMania\WebServices\Exception  
	 */
	function getMultiplayerRankingForEnvironment($login, $environment)
	{
		return $this->execute('GET', '/tmf/players/%s/rankings/multiplayer/%s/',
			array($login, $environment));
	}

	/**
	 * @param string $login Login of a TMF player
	 * @return string
	 * @throws \TrackMania\WebServices\Exception  
	 */
	function getSoloRanking($login)
	{
		return $this->execute('GET', '/tmf/players/%s/rankings/solo/', array($login));
	}

}

?>