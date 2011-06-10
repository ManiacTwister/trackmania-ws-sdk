<?php
/**
 * TrackMania Web Services SDK for PHP - Examples
 *
 * @copyright   Copyright (c) 2009-2011 NADEO (http://www.nadeo.com)
 * @license     http://www.gnu.org/licenses/lgpl.html LGPL License 3
 * @author      $Author$:
 * @date        $Date$:
 */
require_once dirname(__FILE__).'/../src/trackmania-ws.php';

try
{
	$foobar = new TrackMania_Foobar();
	print_r($foobar->get());
	echo "\n";
	print_r($foobar->delete());
	echo "\n";
}
catch(Exception $e)
{
	printf('HTTP Response: %d %s', $e->getHTTPStatusCode(),
		$e->getHTTPStatusMessage());
	echo "\n";
	printf('API Response: %s (%d)', $e->getMessage(), $e->getCode());
	echo "\n";
}
echo "\n";
?>