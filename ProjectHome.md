# TrackMania Web Services SDK for PHP #

**The TrackMania Web Services SDK lets you easilly interact with our API so that
you can retrieve TMF game data such as player information, zones, rankings,
manialinks, etc.**

This package contains the PHP SDK (as a single PHP file for easy integration in
your projects) as well as a some examples. Everyting is released under the
GNU LESSER GENERAL PUBLIC LICENSE Version 3.

## Useful links ##

  * Support forum: http://forum.maniaplanet.com/viewforum.php?f=206
  * Intro to TM WS: http://forum.maniaplanet.com/viewtopic.php?f=206&t=1441
  * SDK tutorial: http://forum.maniaplanet.com/viewtopic.php?f=206&t=1207
  * SDK API reference: http://trackmania-ws-sdk.googlecode.com/svn/documentation/index.html
  * Manage your API users: http://developers.trackmania.com/
  * Community-contributed return types documentation: http://forum.maniaplanet.com/viewtopic.php?f=206&t=1512

## Requirements ##

  * PHP 5.2 +
  * CURL extension http://php.net/manual/en/book.curl.php
  * JSON extension http://php.net/manual/en/book.json.php
  * You must be able to execute HTTPS calls to an external server (namely ws.trackmania.com)

## Basic example ##
```
<?php
require_once '/path/to/trackmania-ws.php';

$tmPlayers = new TrackMania_Players('your_api_username', 'your_api_password');
$player = $tmPlayers->get('gou1');

var_dump($player);
?>
```


&lt;wiki:gadget url="http://www.ohloh.net/p/584524/widgets/project\_users.xml" height="100" border="0"/&gt;