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
 * Test class so you can make dummy calls on the API
 */
class Foobar extends HTTPClient
{

	/**
	 * Gets a dummy object from the API. 
	 * Returned data is:
	 * <code>
	 * Array
	 * (
	 *    [] => GET
	 *    [] => Object
	 * 	(
	 * 	    [anInt] => 1337
	 * 	    [aString] => quarante-deux
	 * 	    [anObject] => Object
	 * 		(
	 * 		    [someBlabla] => Array
	 * 			(
	 * 			    [] => Hello world
	 * 			    [] => 1337
	 * 			)
	 * 		    [foo] => bar
	 * 		)
	 * 	    [anArray] => Array
	 * 		(
	 * 		    [] => un
	 * 		    [] => deux
	 * 		    [] => trois
	 * 		    [] => 4
	 * 		)
	 * 	)
	 * )
	 * </code>
	 * 
	 * @return array
	 * @throws \TrackMania\WebServices\Exception
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
	 * (
	 *    [] => POST
	 *    [] => *the data you posted*
	 * )
	 * </code>
	 * 
	 * @param mixed $data Any data
	 * @return array
	 * @throws \TrackMania\WebServices\Exception
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
	 * @throws \TrackMania\WebServices\Exception
	 */
	function put($data)
	{
		return $this->execute('PUT', '/foobar/', array($data));
	}

	/**
	 * Sends a dummy DELETE request to the server
	 * 
	 * @return string "DELETE" will be returned in case of success
	 * @throws \TrackMania\WebServices\Exception
	 */
	function delete()
	{
		return $this->execute('DELETE', '/foobar/');
	}

}

?>