<?php

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
	echo sprintf('Error: %s'."\n", $e->getMessage());
}

?>