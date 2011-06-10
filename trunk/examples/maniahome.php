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

echo "Enter your Manialink:\n";
$manialink = trim(fgets(STDIN));

echo "Enter your API username (allowed to post notification for this Manialink! ".
"You can configure that in ManiaHome > Options > Manager > Your Manialinks):\n";
$username = trim(fgets(STDIN));

echo "Enter your API password:\n";
$password = trim(fgets(STDIN));

$maniahome = new ManiaHome($username, $password, $manialink);

try
{
	echo "Choose an option:\n";
	echo "1 - Post a public notification to a player\n";
	echo "2 - Post a *private* notification to a player\n";
	echo "3 - Post a notification to everyone who bookmarked your Manialink\n";

	switch((int) trim(fgets(STDIN)))
	{
		case 1:
			echo "Enter a login:\n";
			$login = trim(fgets(STDIN));
			echo "Enter a message:\n";
			$message = trim(fgets(STDIN));
			if(!$maniahome->sendPublicNotificationToPlayer($login, $message))
			{
				throw $maniahome->lastException;
			}
			break;

		case 2:
			echo "Enter a login:\n";
			$login = trim(fgets(STDIN));
			echo "Enter a message:\n";
			$message = trim(fgets(STDIN));
			if(!$maniahome->sendPrivateNotificationToPlayer($login, $message))
			{
				throw $maniahome->lastException;
			}
			break;

		case 3:
			echo "Enter a message:\n";
			$message = trim(fgets(STDIN));
			if(!$maniahome->sendNotificationFromManialink($message))
			{
				throw $maniahome->lastException;
			}
			break;

		default:
			echo "INVALID OPTION\n";
	}
	echo "Success!\n";
}
catch(TrackMania_Exception $e)
{
	printf('HTTP Response: %d %s', $e->getHTTPStatusCode(),
		$e->getHTTPStatusMessage());
	echo "\n";
	printf('API Response: %s (%d)', $e->getMessage(), $e->getCode());
	echo "\n";
}
echo "\n";
?>