<?php
/**
 * TrackMania Web Services SDK for PHP
 * 
 * Simple app example using OAuth2 for authentication
 *
 * @copyright   Copyright (c) 2009-2011 NADEO (http://www.nadeo.com)
 * @license     http://www.gnu.org/licenses/lgpl.html LGPL License 3
 * @author      $Author$:
 * @version     $Revision$:
 * @date        $Date$:
 */
require_once __DIR__.'/../../../src/autoload.php';
require_once __DIR__.'/tmfcolorparser.inc.php';

define('DB_HOSTNAME', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'example');

define('API_USERNAME', 'api_username');
define('API_PASSWORD', 'api_password');

define('ADMIN_LOGIN', 'your_login');

define('SCOPE', ''); // Basic scope = empty string

/**
 * The guestbook data handling class
 */
class Guestbook
{
	const PER_PAGE = 5 ;

	protected $db;

	function __construct()
	{
		$this->db = mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
		mysql_select_db(DB_NAME, $this->db);
		mysql_set_charset('utf8');
	}

	function getPosts($page)
	{
		$result = mysql_query(sprintf(
				'SELECT id, login, datePosted, message '.
				'FROM guestbook '.
				'ORDER BY id DESC '.
				'LIMIT %d,%d', self::PER_PAGE*(abs($page - 1)), self::PER_PAGE), $this->db);
		if(!$result)
		{
			trigger_error(mysql_error());
		}
		
		$array = array();
		while($elt = mysql_fetch_object($result))
		{
			$array[] = $elt;
		}
		return $array;
	}

	function createPost($login, $message)
	{
		if(!$message || !$login)
		{
			return;
		}
		if(!mysql_query(sprintf(
					'INSERT INTO guestbook (login, message) VALUES (\'%s\', \'%s\') ',
					mysql_real_escape_string($login, $this->db),
					mysql_real_escape_string($message, $this->db)), $this->db))
		{
			trigger_error(mysql_error());
		}
	}
	
	function deletePost($id)
	{
		mysql_query(sprintf('DELETE FROM guestbook WHERE id=%s', $id), $this->db);
	}

}

/**
 * Tries to login the user with the TM WS SDK
 */
try
{
	$trackmania = new \TrackMania\WebServices\OAuth2\Base(API_USERNAME, API_PASSWORD);
	$login = $trackmania->getLogin();
	$player = $trackmania->getPlayer();
}
catch(\TrackMania\WebServices\Exception $e)
{
	var_dump($e->getHTTPStatusCode(), $e->getHTTPStatusMessage(), $e->getMessage());
	$login = null;
	$player = null;
}

/**
 * Instanciates the Guestbook class to we can handle data
 */
$guestbook = new Guestbook();

/**
 * Instanciates the color parser
 * @see http://fish.stabb.de/index.php5?page=3&subpage=127
 */
$tmfcolorparser = new TMFColorParser('#ffffff');

/**
 * Looks for different actions
 */
if($login && array_key_exists('post', $_POST))
{
	$guestbook->createPost($login, $_POST['post']);
}
elseif($login && $login == ADMIN_LOGIN && array_key_exists('delete', $_GET))
{
	$guestbook->deletePost($_GET['delete']);
}

/**
 * Get the page
 */
if(array_key_exists('page', $_GET))
{
	$page = abs((int)$_GET['page']);
}
else
{
	$page = 1;
}

/**
 * Generates the Login URL if needed
 */
if(!$login)
{
	$loginURL = $trackmania->getLoginURL( SCOPE);
}
else
{
	$logoutURL = $trackmania->getLogoutURL();
}

/**
 * Gets the current URL. The OAuth class can do that...
 */
$currentURL = $trackmania->getCurrentURI();

/**
 * Retrieves the posts list
 */
$posts = $guestbook->getPosts($page);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html> 
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>TrackMania Web Services SDK for PHP - Guestbook example</title>
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/start/jquery-ui.css" type="text/css" media="all" />
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" ></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" ></script>
		<style type="text/css">
			input.text { width:80%; padding: 6px; }
			#guestbook { font-size: 13px; width: 500px; margin: 20px 0; }
			#guestbook .post, #guestbook  .header { padding: 10px; margin: 5px 0; }
			#guestbook .post p { margin: 2px; }
			#guestbook .post .ui-priority-secondary { font-size: 11px; text-align: right; }
			.ui-state-highlight { padding: 5px; }
		</style>
		<script type="text/javascript">
			$(document).ready(function() {
				$('input:submit, input:reset, .button').button();
			});
		</script>
	</head>
	<body>
		<h1>TrackMania Web Services SDK for PHP</h1>
		<h2>Guestbook example</h2>
		<div id="guestbook">
			<p class="ui-widget">
				<?php if($login): ?>
						Hello <?php echo $tmfcolorparser->toHTML($player->nickname); ?>
					&bull; <a href="<?php echo $logoutURL ?>">Logout</a>
				<?php else: ?>
					<a href="<?php echo $loginURL ?>">Login with your TrackMania Forever account</a>
				<?php endif ?>
			</p>
			<div class="header ui-widget ui-widget-header ui-corner-all">
				Guestbook
			</div>
			<?php if($page==1 && !count($posts)): ?>
				<p class="ui-widget ui-widget-content ui-state-highlight ui-corner-all">
					There are no posts
				</p>
			<?php else: ?>
				<?php foreach($posts as $post): ?>
					<div class="post ui-widget ui-widget-content ui-corner-all">
						<p>
							<?php echo $tmfcolorparser->toHTML($post->message) ?>
						</p>
						<p  class="ui-widget ui-priority-secondary">
								<?php if($login && $login == ADMIN_LOGIN): ?>
									<a href="<?php echo $currentURL.'?delete='.$post->id ?>">Delete this post</a>
								<?php endif ?>
								By <?php echo $post->login ?> &bull; <?php echo $post->datePosted ?>
						</p>
					</div>
				<?php endforeach ?>
				<table width="100%" class="ui-widget ui-widget-content ui-corner-all">
					<tr>
						<td width="30%">
							<?php if($page > 1): ?>
								<a href="<?php echo $currentURL.'?page='.($page-1) ?>" class="button">
									<span class="ui-icon ui-icon-seek-prev">&nbsp;</span>
								</a>
							<?php endif ?>
						</td>
						<td align="center" width="40%">
							Page <?php echo $page ?>
						</td>
						<td align="right" width="30%">
							<?php if(count($posts)): ?>
								<a href="<?php echo $currentURL.'?page='.($page+1) ?>" class="button">
									<span class="ui-icon ui-icon-seek-next">&nbsp;</span>
								</a>
							<?php endif ?>
						</td>
					</tr>
				</table>
			<?php endif ?>
			<?php if($login): ?>
				<div class="header ui-widget ui-widget-header ui-corner-all">
					Post a message
				</div>
				<form method="post" action="<?php echo $currentURL ?>" enctype="multipart/form-data">
					<input type="text" maxlength="255" name="post" class="text ui-widget ui-widget-content ui-corner-all" />
					<input type="submit" value="Post" />
				</form>
			<?php else: ?>
				<p class="ui-widget ui-widget-content ui-state-highlight ui-corner-all">
					You must be logged in to post a message.
					<a href="#">top</a>
				</p>
			<?php endif ?>
		</div>
	</body>
</html>