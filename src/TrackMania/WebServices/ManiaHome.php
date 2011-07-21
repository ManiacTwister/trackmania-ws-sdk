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
 * Easy posting of notifications on ManiaHome
 * 
 * @see http://forum.maniaplanet.com/viewtopic.php?f=42&t=1005
 */
class ManiaHome extends HTTPClient
{

	/**
	 * Short Manialink used to send notifications
	 * @var string
	 */
	protected $manialink;

	/**
	 * Shorthand for displaying the bookmark button.
	 * It returns the XML code to display the bookmark button in your Manialink.
	 * 
	 * @see http://forum.maniaplanet.com/viewtopic.php?f=42&t=1037
	 * @param string $manialink Your short Manialink (eg. "manialink:home")
	 * @param string $manialinkName Display name of your Manialink with special characters (eg. "$f00Manialink:Home")
	 * @param string $manialinkImage URL of the image of your Manialink (for the Bookmark page on ManiaHome)
	 * @return string XML Manialink code of the button
	 */
	public static function bookmarkButton($manialink, $manialinkName=null,
		$manialinkImage=null)
	{
		$params['url'] = $manialink;
		if($manialinkName)
		{
			$params['name'] = $manialinkName;
		}
		if($manialinkImage)
		{
			$params['picture'] = $manialinkImage;
		}
		$url = 'http://maniahome.trackmania.com/add/?'.http_build_query($params);
		$xml = '<include url="'.htmlspecialchars($url, ENT_COMPAT, 'UTF-8', false).'"/>';
		return $xml;
	}

	/**
	 * @param string $username API username allowed to post notification for this Manialink
	 * @param string $password API password
	 * @param string $manialink Short Manialink code
	 */
	function __construct($username, $password, $manialink)
	{
		parent::__construct($username, $password);
		$this->manialink = $manialink;
	}

	/**
	 * Sends a notification to everyone who bookmarked your Manialink.
	 * See http://fish.stabb.de/styles/ For icon styles and substyles.
	 * It does not throw exceptions!
	 * 
	 * @param string $message Notification message
	 * @param string $link Link of the notification
	 * @param string $iconStyle Icon style
	 * @param string $iconStyle Icon substyle
	 * @return bool Success
	 */
	public function sendNotificationFromManialink($message, $link=null,
		$iconStyle = null, $iconSubStyle = null)
	{
		$data = array(
			'senderName' => $this->manialink,
			'message' => $message,
			'receiverName' => null,
			'link' => $link,
			'iconStyle' => $iconStyle,
			'iconSubStyle' => $iconSubStyle,
		);
		return $this->execute('POST', '/maniahome/notification/', array($data)) !== false;
	}

	/**
	 * Sends a public notification to the specified player. His buddies will see
	 * that notification (unless he changed his privacy settings).
	 * See http://fish.stabb.de/styles/ For icon styles and substyles.
	 * It does not throw exceptions!
	 * 
	 * @param string $playerLogin Login of the recipient
	 * @param string $message Notification message
	 * @param string $link Link of the notification
	 * @param string $iconStyle Icon style
	 * @param string $iconStyle Icon substyle
	 * @return bool Success
	 */
	public function sendPublicNotificationToPlayer($playerLogin, $message,
		$link=null, $iconStyle = null, $iconSubStyle = null)
	{
		$data = array(
			'senderName' => $this->manialink,
			'receiverName' => $playerLogin,
			'message' => $message,
			'link' => $link,
			'iconStyle' => $iconStyle,
			'iconSubStyle' => $iconSubStyle,
		);
		return $this->execute('POST', '/maniahome/notification/%s/',
			array($playerLogin, $data)) !== false;
	}

	/**
	 * Sends a private notification to the specified player. Only this player will
	 * see the notification.
	 * See http://fish.stabb.de/styles/ For icon styles and substyles
	 * It does not throw exceptions!
	 * 
	 * @param string $playerLogin Login of the recipient
	 * @param string $message Notification message
	 * @param string $link Link of the notification
	 * @return bool Success
	 */
	public function sendPrivateNotificationToPlayer($playerLogin, $message,
		$link=null)
	{
		$data = array(
			'senderName' => $this->manialink,
			'receiverName' => $playerLogin,
			'message' => $message,
			'link' => $link,
		);
		return $this->execute('POST', '/maniahome/notification/%s/private/',
			array($playerLogin, $data)) !== false;
	}

}

?>