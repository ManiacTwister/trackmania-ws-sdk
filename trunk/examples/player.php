<?php
require_once dirname(__FILE__).'/../src/trackmania-ws.php';

// Uncomment the lines below, and set your credentials
// $username = 'your_api_username';
// $password = 'your_api_password';

if(!isset($username) || !isset($password))
{
	die('FATAL ERROR: Open "player.php" and set the "$username" and "$password" variables.'."\n");
}

$players = new TrackMania_Players($username, $password);

while(true)
{
	try
	{
		echo "Enter a TrackMania Forever login:\n";
		$login = trim(fgets(STDIN));
		$player = $players->get($login);
		print_r($player);
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
}
?>