<?php
/**
 * TrackMania Web Services SDK for PHP
 * 
 * Basic example of how to authentify a user with a TrackMania account using OAuth 2.0
 *
 * @copyright   Copyright (c) 2009-2011 NADEO (http://www.nadeo.com)
 * @license     http://www.gnu.org/licenses/lgpl.html LGPL License 3
 * @author      $Author$:
 * @version     $Revision$:
 * @date        $Date$:
 */
require_once __DIR__.'/../../../src/autoload.php';

define('API_USERNAME', 'api_username');
define('API_PASSWORD', 'api_password');
define('SCOPE', 'email');

try
{
	$trackmania = new \TrackMania\WebServices\OAuth2\Player(API_USERNAME, API_PASSWORD);

	// URLs to log in and out
	$loginURL = $trackmania->getLoginURL(SCOPE);
	$logoutURL = $trackmania->getLogoutURL();
	
	if(isset($_POST['logout']))
	{
		session_destroy();
		header('Location: '.$logoutURL);
		exit;
	}

	// Retrive player information. If the user is not logged in, it will return false
	$player = $trackmania->getPlayer();
	
	if($player)
	{
		$email = $trackmania->getEmail();
	}
}
catch(\TrackMania\WebServices\Exception $e)
{
	var_dump($e->getHTTPStatusCode(), $e->getHTTPStatusMessage(), $e->getMessage());
	$player = null;
}
?>
<?php if(array_key_exists('HTTP_USER_AGENT', $_SERVER) && $_SERVER['HTTP_USER_AGENT'] == 'GameBox'): ?>
<manialink>
	<timeout>0</timeout>
	<frame posn="0 25 0">
		<label sizen="70 3"  halign="center" 
			   text="$o$ff0TrackMania Web Services SDK for PHP - OAuth2 example" />
		<?php if($player): ?>
		<label sizen="70 3" posn="0 -5 0"  halign="center" text="Hello <?php echo $player->login ?>" />
		<label sizen="70 70" posn="0 -10 0" halign="center" 
			   text="$oEmail:$o <?php echo $email ?>" />
		<label sizen="70 70" posn="0 -14 0" autonewline="1" halign="center" 
			   text="<?php echo print_r($player, true) ?>" />
		<?php else: ?>
			<label sizen="40 3" posn="0 -5 0"  halign="center" text="Login" manialink="<?php echo htmlentities($loginURL) ?>"/>
		<?php endif ?>
	</frame>
</manialink>
<?php else: ?>
	<html> 
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title>TrackMania Web Services SDK for PHP - OAuth2 example</title>
		</head>
		<body>
			<h1>TrackMania Web Services SDK for PHP</h1>
			<h2>OAuth2 Example</h2>

			<?php if($player): ?>
				<h3>Hello <?php echo $player->login ?></h3>
				<p>You are authentified with your TrackMania Forever account.</p>
				<pre><?php print_r($player) ?></pre>
				<p><b>Email:</b> <?php echo $email ?></p>
				<p>
					<form action="" method="post">
						<input type="hidden" name="logout" value="1" />
						<input type="submit" name="submit" value="Logout" />
					</form>
				</p>

			<?php else: ?>
				<p>
					<a href="<?php echo $loginURL ?>">Login with your TrackMania Forever account</a>
				</p>
			<?php endif ?>

		</body>
	</html>
<?php endif ?>
