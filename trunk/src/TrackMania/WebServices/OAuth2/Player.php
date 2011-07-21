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

namespace TrackMania\WebServices\OAuth2;

/**
 * The base class for using OAuth2.
 */
class Player extends Client
{

	/**
	 * This is the first method to call when you have an authorization code. 
	 * It will retrieve an access token if possible and then call the service to
	 * retrieve a basic object about the authentified player. 
	 * 
	 * Return struct is:
	 * <code>
	 * Object 
	 * ( 
	 *    [id] => int
	 *    [login] => string
	 *    [nickname] => string
	 *    [united] => int, 0 for a nations account or 1 for a united one
	 *    [path] => string, eg. "World|France|Ile-de-France|Paris"
	 *    [idZone] => int
	 * )
	 * </code>
	 * 
	 * You do not need any special scope to call this service, as long as you 
	 * have an access token.
	 * 
	 * If an access token is not found, it will return false
	 * 
	 * @return object A player object or false if no access token is found
	 */
	function getPlayer()
	{
		$player = $this->getVariable('player');
		if(!$player)
		{
			if($this->getAccessToken())
			{
				$player = $this->executeOAuth2('GET', '/player/');
				$this->setVariable('player', $player);
			}
		}
		return $player;
	}

	/**
	 * Returns the buddies of the player as an array of player 
	 * objects. See self::player() for the struct.
	 * 
	 * Scope needed: buddies
	 * 
	 * @return array[object]
	 */
	function getBuddies()
	{
		return $this->execute('GET', '/player/buddies/');
	}

	/**
	 * Returns the email of the player, if there's one in its
	 * account information.
	 * 
	 * Scope needed: email
	 * 
	 * @return string
	 */
	function getEmail()
	{
		return $this->execute('GET', '/player/email/');
	}

	/**
	 * Whether the player is online.
	 * 
	 * Scope needed: online_status
	 * 
	 * @return bool
	 */
	function isOnline()
	{
		return $this->execute('GET', '/player/online/');
	}

}

?>