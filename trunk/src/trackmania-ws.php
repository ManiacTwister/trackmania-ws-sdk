<?php
/**
 * TrackMania Web Services SDK for PHP 0.5
 *
 * @copyright   Copyright (c) 2009-2011 NADEO (http://www.nadeo.com)
 * @license     http://www.gnu.org/licenses/lgpl.html LGPL License 3
 * @author      $Author$:
 * @date        $Date$:
 */

/**
 * Test class so you can make dummy calls on the API
 * 
 * @package TrackMania
 */
class TrackMania_Foobar extends TrackMania_WebServices
{
	/**
	 * Gets a dummy object from the API. 
	 * Returned data is:
	 * <code>
	 * Array
	 *(
	 *    [] => GET
	 *    [] => Object
	 *	(
	 *	    [anInt] => 1337
	 *	    [aString] => quarante-deux
	 *	    [anObject] => Object
	 *		(
	 *		    [someBlabla] => Array
	 *			(
	 *			    [] => Hello world
	 *			    [] => 1337
	 *			)
	 *		    [foo] => bar
	 *		)
	 *	    [anArray] => Array
	 *		(
	 *		    [] => un
	 *		    [] => deux
	 *		    [] => trois
	 *		    [] => 4
	 *		)
	 *	)
	 *)
	 * </code>
	 * 
	 * @return array
	 * @throws TrackMania_Exception
	 */
	function get()
	{
		return $this->execute('GET', '/foobar/');
	}

	/**
	 * Allows you to post any data on the API. The data you posted will be returned
	 * in the response:
	 * <code>
	 * Array
	 *(
	 *    [] => POST
	 *    [] => *the data you posted*
	 *)
	 * </code>
	 * 
	 * @param mixed $data Any data
	 * @return array
	 * @throws TrackMania_Exception
	 */
	function post($data)
	{
		return $this->execute('POST', '/foobar/', array($data));
	}

	/**
	 * Same as the post() method, but with a PUT request
	 * 
	 * @param mixed $data
	 * @return array 
	 * @throws TrackMania_Exception
	 */
	function put($data)
	{
		return $this->execute('PUT', '/foobar/', array($data));
	}

	/**
	 * Sends a dummy DELETE request to the server
	 * 
	 * @return string "DELETE" will be returned in case of success
	 * @throws TrackMania_Exception
	 */
	function delete()
	{
		return $this->execute('DELETE', '/foobar/');
	}

}

/**
 * Access to public Manialinks data
 * 
 * @package TrackMania
 */
class TrackMania_Manialinks extends TrackMania_WebServices
{

	/**
	 * Retrieves information about a Short Manialink code. Response structure is:
	 * <code>
	 * Object
	 *(
	 *    [code] => example_manialink
	 *    [url] => http://example.com/
	 *    [login] => player_login
	 *    [coppersCost] => 0
	 *)
	 * </code>
	 * 
	 * @param string $code Short Manialink code
	 * @return object
	 * @throws TrackMania_Exception 
	 */
	function get($code)
	{
		return $this->execute('GET', '/tmf/manialinks/%s/', array($code));
	}

}

/**
 * Access to public global multiplayer rankings data
 * 
 * @package TrackMania
 */
class TrackMania_MultiplayerRankings extends TrackMania_WebServices
{

	/**
	 * @param string $path A valid path, eg. "World|France"
	 * @param string $environment A valid environment, eg. "Stadium"
	 * @param int $offset Offset starting from 0
	 * @param int $length Length of the response
	 * @return object 
	 * @throws TrackMania_Exception
	 */
	function getPlayerRanking($path = 'World', $environment = 'Merge', $offset = 0, $length = 10)
	{
		return $this->execute('GET', '/tmf/rankings/multiplayer/players/%s/%s/?offset=%s&length=%s', array($path, $environment, $offset, $length));
	}

	/**
	 * @param string $path A valid path, eg. "World|France"
	 * @param int $offset Offset starting from 0
	 * @param int $length Length of the response
	 * @return object 
	 * @throws TrackMania_Exception
	 */
	function getZoneRanking($path = 'World', $offset = 0, $length = 10)
	{
		return $this->execute('GET', '/tmf/rankings/multiplayer/zones/%s/?offset=%s&length=%s', array($path, $offset, $length));
	}

}

/**
 * Access to public players data
 * 
 * @package TrackMania
 */
class TrackMania_Players extends TrackMania_WebServices
{

	/**
	 * @param string $login Login of a TMF player
	 * @return object
	 * @throws TrackMania_Exception 
	 */
	function get($login)
	{
		return $this->execute('GET', '/tmf/players/%s/', array($login));
	}

	/**
	 * @param string $login Login of a TMF player
	 * @return string HTML formatted nickname
	 * @throws TrackMania_Exception 
	 */
	function getNicknameHTML($login)
	{
		return $this->execute('GET', '/tmf/players/%s/nickname/html/', array($login));
	}

	/**
	 * @param string $login Login of a TMF player
	 * @return array Array of tag objects 
	 * @throws TrackMania_Exception 
	 */
	function getTags($login)
	{
		return $this->execute('GET', '/tmf/players/%s/tags/', array($login));
	}

	/**
	 * @deprecated
	 */
	function isOnline($login)
	{
		return null;
	}

	/**
	 * @param string $login Login of a TMF player
	 * @return object
	 * @throws TrackMania_Exception  
	 */
	function getMultiplayerRanking($login)
	{
		return $this->execute('GET', '/tmf/players/%s/rankings/multiplayer/', array($login));
	}

	/**
	 * @param string $login Login of a TMF player
	 * @param type $environment
	 * @return object
	 * @throws TrackMania_Exception  
	 */
	function getMultiplayerRankingForEnvironment($login, $environment)
	{
		return $this->execute('GET', '/tmf/players/%s/rankings/multiplayer/%s/', array($login, $environment));
	}

	/**
	 * @param string $login Login of a TMF player
	 * @return string
	 * @throws TrackMania_Exception  
	 */
	function getSoloRanking($login)
	{
		return $this->execute('GET', '/tmf/players/%s/rankings/solo/', array($login));
	}

}

/**
 * Access to registrations data
 * 
 * @package TrackMania
 */
class TrackMania_Registrations extends TrackMania_WebServices
{

	/**
	 * Number of TMF registered accounts
	 * @return int 
	 * @throws TrackMania_Exception 
	 */
	function getPlayersCount()
	{
		return $this->execute('GET', '/tmf/registrations/');
	}

}

/**
 * Access to public online dedicated servers data
 * 
 * @package TrackMania
 */
class TrackMania_Servers extends TrackMania_WebServices
{

	/**
	 * @param string $login An online dedicated server login
	 * @return object
	 * @throws TrackMania_Exception 
	 */
	function get($login)
	{
		return $this->execute('GET', '/tmf/servers/%s/', array($login));
	}

}

/**
 * Access to public global solo rankings data
 * 
 * @package TrackMania
 */
class TrackMania_SoloRankings extends TrackMania_WebServices
{

	/**
	 * @param int $offset Offset starting from 0
	 * @param int $length Length of the response
	 * @return object 
	 * @throws TrackMania_Exception
	 */
	function getPlayerWorldRanking($offset = 0, $length = 10)
	{
		return $this->execute('GET', '/tmf/rankings/solo/players/?offset=%s&length=%s', array($offset, $length));
	}

	/**
	 * @param string $path A valid path, eg. "World|France"
	 * @param int $offset Offset starting from 0
	 * @param int $length Length of the response
	 * @return object 
	 * @throws TrackMania_Exception
	 */
	function getPlayerRanking($path, $offset = 0, $length = 10)
	{
		return $this->execute('GET', '/tmf/rankings/solo/players/%s/?offset=%s&length=%s', array($path, $offset, $length));
	}

	/**
	 * @param string $challengeUID A challenge UID, eg. "BeySZdnfuSh4nHY5xztiXLmlrXe" (A01-Race)
	 * @param int $offset Offset starting from 0
	 * @param int $length Length of the response
	 * @return object 
	 * @throws TrackMania_Exception
	 */
	function getPlayerWorldRankingForChallenge($challengeUID, $offset = 0, $length = 10)
	{
		return $this->execute('GET', '/tmf/rankings/solo/challenges/%s/players/?offset=%s&length=%s', array($challengeUID, $offset, $length));
	}

	/**
	 * @param string $path A valid path, eg. "World|France"
	 * @param int $offset Offset starting from 0
	 * @param int $length Length of the response
	 * @return object 
	 * @throws TrackMania_Exception
	 */
	function getPlayerRankingForChallenge($challengeUID, $path, $offset = 0, $length = 10)
	{
		return $this->execute('GET', '/tmf/rankings/solo/challenges/%s/players/%s/?offset=%s&length=%s', array($challengeUID, $path, $offset, $length));
	}

}

/**
 * Access to public zones data.
 * You can either work with zones using their IDs of their full paths.
 * 
 * @package TrackMania
 */
class TrackMania_Zones extends TrackMania_WebServices
{

	/**
	 * @param int $id A zone id
	 * @return object
	 * @throws TrackMania_Exception 
	 */
	function get($id)
	{
		return $this->execute('GET', '/tmf/zones/id/%s/', array($id));
	}

	/**
	 *
	 * @param string $path A valid path, eg. "World|France"
	 * @return object
	 * @throws TrackMania_Exception 
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
	 * @throws TrackMania_Exception 
	 */
	function getAll($offset = 0, $length = 10, $sort = '', $order = '')
	{
		return $this->execute('GET', '/tmf/zones/all/?offset=%s&length=%s&sort=%s&order=%s', array($offset, $length, $sort, $order));
	}

	/**
	 *
	 * @param int $id A zone id
	 * @param int $offset Offset starting from 0
	 * @param int $length Length of the response
	 * @param string $sort Sort by: 'id', 'name'
	 * @param int $order Order by 1 or -1
	 * @return array Array of zones
	 * @throws TrackMania_Exception 
	 */
	function getChildren($id, $offset = 0, $length = 10, $sort = '', $order = '')
	{
		return $this->execute('GET', '/tmf/zones/id/%s/children/?offset=%s&length=%s&sort=%s&order=%s', array($id, $offset, $length, $sort, $order));
	}

	/**
	 *
	 * @param string $path A valid path, eg. "World|France"
	 * @param int $offset Offset starting from 0
	 * @param int $length Length of the response
	 * @param string $sort Sort by: 'id', 'name'
	 * @param int $order Order by 1 or -1
	 * @return array Array of zones
	 * @throws TrackMania_Exception 
	 */
	function getChildrenByPath($path, $offset = 0, $length = 10, $sort = '', $order = '')
	{
		return $this->execute('GET', '/tmf/zones/path/%s/children/?offset=%s&length=%s&sort=%s&order=%s', array($path, $offset, $length, $sort, $order));
	}

	/**
	 *
	 * @param string $path A valid path, eg. "World|France"
	 * @return int
	 * @throws TrackMania_Exception  
	 */
	function getId($path)
	{
		return $this->execute('GET', '/tmf/zones/path/%s/id/', array($path));
	}

}

/**
 * Easy posting of notifications on ManiaHome
 * 
 * @package ManiaHome
 */
class ManiaHome extends TrackMania_WebServices
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
	 * @param string $manialink Your short Manialink (eg. "manialink:home")
	 * @param string $manialinkName Display name of your Manialink with special characters (eg. "$f00Manialink:Home")
	 * @param string $manialinkImage URL of the image of your Manialink (for the Bookmark page on ManiaHome)
	 * @return string XML Manialink code of the button
	 */
	public static function bookmarkButton($manialink, $manialinkName=null, $manialinkImage=null)
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
	 * Sends a notification to everyone who bookmarked your Manialink
	 * 
	 * See http://fish.stabb.de/styles/ For icon styles and substyles
	 * 
	 * @param string $message Notification message
	 * @param string $link Link of the notification
	 * @param string $iconStyle Icon style
	 * @param string $iconStyle Icon substyle
	 * @return void
	 * @throws TrackMania_Exception
	 */
	public function sendNotificationFromManialink($message, $link=null, $iconStyle = null, $iconSubStyle = null)
	{
		$data = array(
			'senderName' => $this->manialink,
			'message' => $message,
			'receiverName' => null,
			'link' => $link,
			'iconStyle' => $iconStyle,
			'iconSubStyle' => $iconSubStyle,
		);
		return $this->execute('POST', '/maniahome/notification/', array($data));
	}

	/**
	 * Sends a public notification to the specified player. His buddies will see
	 * that notification (unless he changed his privacy settings)
	 * 
	 * See http://fish.stabb.de/styles/ For icon styles and substyles
	 * 
	 * @param string $playerLogin Login of the recipient
	 * @param string $message Notification message
	 * @param string $link Link of the notification
	 * @param string $iconStyle Icon style
	 * @param string $iconStyle Icon substyle
	 * @return void
	 * @throws TrackMania_Exception
	 */
	public function sendPublicNotificationToPlayer($playerLogin, $message, $link=null, $iconStyle = null, $iconSubStyle = null)
	{
		$data = array(
			'senderName' => $this->manialink,
			'message' => $message,
			'link' => $link,
			'iconStyle' => $iconStyle,
			'iconSubStyle' => $iconSubStyle,
			'type' => $type,
		);
		return $this->execute('POST', '/maniahome/notification/%s/', array($playerLogin, $data));
	}

	/**
	 * Sends a private notification to the specified player. Only this player will
	 * see the notification.
	 * 
	 * See http://fish.stabb.de/styles/ For icon styles and substyles
	 * 
	 * @param string $playerLogin Login of the recipient
	 * @param string $message Notification message
	 * @param string $link Link of the notification
	 * @return void
	 * @throws TrackMania_Exception
	 */
	public function sendPrivateNotificationToPlayer($playerLogin, $message, $link=null)
	{
		$data = array(
			'senderName' => $this->manialink,
			'message' => $message,
			'link' => $link,
		);
		return $this->execute('POST', '/maniahome/notification/%s/private/', array($playerLogin, $data));
	}

}

/**
 * REST client used to execute HTTP requests on the TrackMania Web Services API. Service classes of the SDK extends this base class.
 * 
 * @package TrackMania
 */
abstract class TrackMania_WebServices
{
	const VERSION = '0.5';
	
	/**
	 * URL of the Web Services API
	 * 
	 * @var string
	 */
	protected $APIURL = 'https://ws.trackmania.com';
	/**
	 * HTTP username used to authenticate the client via HTTP Basic Authentication
	 * 
	 * @var string
	 */
	protected $username;
	/**
	 * HTTP password used to authenticate the client via HTTP Basic Authentication
	 * 
	 * @var string
	 */
	protected $password;

	/**
	 * Default constructor. Children classes should, if they need to override it,
	 * keep the same first two parameters (the API credentials) to keep the usage of the SDK simple.
	 * 
	 * You can manage your API credentials at http://developers.trackmania.com
	 * 
	 * @param string $username API username
	 * @param string $password API password
	 */
	function __construct($username = null, $password = null)
	{
		if(!function_exists('curl_init'))
		{
			trigger_error('You must activate the CURL PHP extension.');
		}
		if(!function_exists('json_encode'))
		{
			trigger_error('You must activate the JSON PHP extension.');
		}

		$this->username = $username;
		$this->password = $password;
	}

	/**
	 * Executes a HTTP request on the API.
	 * 
	 * The usage of the $ressource and $params parameters is similar to the use 
	 * of the sprintf() function. You can PUT sprintf() placeholders in the 
	 * $ressource, and the first elements of the $params array will be 
	 * urlencode'd and sprintf()'ed in the ressource. The last element of the 
	 * $params array will be serialized and used for request body if using 
	 * POST or PUT methods.
	 * 
	 * Examples:
	 * <code>
	 * $obj->execute('GET', '/stuff/%s/', array('foobar')); // => /stuff/foobar/
	 * $obj->execute('GET', '/stuff/%s/', array('foo bar')); // => /stuff/foo%20bar/
	 * $obj->execute('GET', '/stuff/%s/%d/', array('foobar', 1)); // => /stuff/foobar/1/
	 * $obj->execute('POST', '/stuff/', array($someDataToPost)); // => /stuff/
	 * $obj->execute('POST', '/stuff/%s/', array('foobar', $someDataToPost)); // => /stuff/foobar/
	 * </code>
	 * 
	 * @param string $method The HTTP method to use. Only GET, POST, PUT and DELETE are supported for now.
	 * @param string $ressource The ressource (path after the URL + query string)
	 * @param array $params The parameters
	 * @return mixed The unserialized API response
	 * @throws TrackMania_Exception
	 */
	protected function execute($method, $ressource, array $params = array())
	{
		$url = $this->APIURL.$ressource;

		// If we need a request body, it's the last element of the params array
		// Otherwise it's null
		if($method == 'POST' || $method == 'PUT')
		{
			$data = array_pop($params);
			$data = json_encode($data);
		}
		else
		{
			$data = null;
		}

		// The rest of the params array is urlencode'd and sprintf'ed
		// into the ressource itself
		if($params)
		{
			$params = array_map('urlencode', $params);
			array_unshift($params, $url);
			$url = call_user_func_array('sprintf', $params);
		}

		// Let's prepare the CURL request options and HTTP header
		$options = array();
		$header = array();

		// We keep things simple by sticking with JSON
		$header[] = 'Accept: application/json';
		$header[] = 'Content-type: application/json';

		switch($method)
		{
			case 'GET':
				// Nothing to do
				break;

			case 'POST':
				$options[CURLOPT_POST] = true;
				$options[CURLOPT_POSTFIELDS] = $data;
				break;

			case 'PUT':
				$fh = fopen('php://temp', 'rw');
				fwrite($fh, $data);
				rewind($fh);
				$options[CURLOPT_PUT] = true;
				$options[CURLOPT_INFILE] = $fh;
				$options[CURLOPT_INFILESIZE] = strlen($data);
				break;

			case 'DELETE':
				$options[CURLOPT_POST] = true;
				$options[CURLOPT_POSTFIELDS] = '';
				$options[CURLOPT_CUSTOMREQUEST] = 'DELETE';
				break;

			default:
				throw new InvalidArgumentException('Unsupported HTTP method: '.$method);
		}

		$options[CURLOPT_URL] = $url;
		$options[CURLOPT_HTTPHEADER] = $header;
		$options[CURLOPT_HTTPAUTH] = CURLAUTH_BASIC;
		$options[CURLOPT_USERPWD] = $this->username.':'.$this->password;
		$options[CURLOPT_TIMEOUT] = 10;
		$options[CURLOPT_RETURNTRANSFER] = true;
		$options[CURLOPT_USERAGENT] = 'TrackMania Web Services SDK for PHP '.self::VERSION;

		// This normally should not be done
		// But the certificates of our api are self-signed for now
		$options[CURLOPT_SSL_VERIFYHOST] = 0;
		$options[CURLOPT_SSL_VERIFYPEER] = 0;

		try
		{
			$ch = curl_init();
			curl_setopt_array($ch, $options);
			$responseBody = curl_exec($ch);
			$responseInfo = curl_getinfo($ch);
			curl_close($ch);
		}
		catch(Exception $e)
		{
			if($ch)
			{
				curl_close($ch);
			}
			throw $e;
		}

		if($responseInfo['http_code'] == 200)
		{
			if($responseBody)
			{
				$responseBody = json_decode($responseBody);
				if(function_exists('json_last_error'))
				{
					switch(json_last_error())
					{
						case JSON_ERROR_DEPTH:
							throw new TrackMania_Exception('Maximum stack depth exceeded');

						case JSON_ERROR_CTRL_CHAR:
							throw new TrackMania_Exception('Unexpected control character found');

						case JSON_ERROR_SYNTAX:
							throw new TrackMania_Exception('Syntax error, malformed JSON');
					}
				}
			}
			return $responseBody;
		}
		else
		{
			if($responseBody)
			{
				$responseBody = json_decode($responseBody);
				if(function_exists('json_last_error') && json_last_error() == JSON_ERROR_NONE)
				{
					if(is_object($responseBody) && property_exists($responseBody, 'message'))
					{
						$message = $responseBody->message;
					}
				}
			}
			if(!isset($message))
			{
				switch($responseInfo['http_code'])
				{
					case 400: $message = 'Bad request';
						break;
					case 401: $message = 'Unauthorized';
						break;
					case 403: $message = 'Forbidden';
						break;
					case 404: $message = 'Not found';
						break;
					case 500: $message = 'Internal server error';
						break;
					default: $message = 'API error. Check the HTTP error code for more information.';
				}
			}
			throw new TrackMania_Exception($message, $responseInfo['http_code']);
		}
	}

}

/**
 * Exception thrown by the services when something goes wrong
 * 
 * @package TrackMania
 */
class TrackMania_Exception extends Exception
{
	// TODO Add two properties so you can specify in the exception code+message for both the header and the response body
}

?>