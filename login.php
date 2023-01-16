<?php

define('LOGIN', false);
require_once 'includes/inc.global.php';

// i don't care who they are, or where they come from
// if they hit this page, log them out
$GLOBALS['Player'] = new GamePlayer( );
$GLOBALS['Player']->log_out(false, true);

$meta['title'] = 'Login';
$meta['show_menu'] = false;
$meta['head_data'] = '
	<script type="text/javascript" src="scripts/jquery.overlabel.js"></script>
	<script type="text/javascript" src="scripts/jquery.showpass.js"></script>
	<script type="text/javascript">//<![CDATA[
		jQuery(document).ready( function($) {
			$("div.formdiv label").not(".inline").overlabel( );
			$("div.formdiv input").showpass( );
		});
	//]]></script>

	<style type="text/css">
		.formdiv div {
			position: relative;
		}
		label.overlabel {
			color: #999;
		}
		label.overlabel-apply {
			position: absolute;
			top: 2px;
			left: 5px;
			z-index: 1;
			color: #999;
		}
	</style>
';

$date_format = 'D, M j, Y g:i a';
$approve_users = false;
$new_users = true;
$max_users = 0;
if (class_exists('Settings') && Settings::test( )) {
	$date_format = Settings::read('long_date');
	$approve_users = Settings::read('approve_users');
	$new_users = Settings::read('new_users');
	$max_users = Settings::read('max_users');
}

echo get_header($meta);

?>
		<div id="notes">
			<div id="date"><?php echo ldate($date_format); ?></div>
			<p><strong>Welcome to <?php echo GAME_NAME; ?>!</strong></p>
			<p>Please enter a valid username and password to enter.</p>
			<?php if ($approve_users) { ?>
			<p><span class="notice">NOTE</span>: You will be unable to log in if your account has not been approved yet.</p>
			<p>You should receive an email when your account has been approved.</p>
			<?php } ?>
		</div>

		<div id="content">
			<h2>Login</h2>
			<noscript class="notice ctr">
				<p>Warning! Javascript must be enabled for proper operation of <?php echo GAME_NAME; ?>.</p>
			</noscript>

			<form method="post" action="index.php<?php echo $GLOBALS['_?_DEBUG_QUERY']; ?>"><div class="formdiv">
				<div><label for="username">Username</label><input type="text" id="username" name="username" size="15" maxlength="20" tabindex="1" /></div>
				<div><label for="password">Password</label><input type="password" id="password" name="password" class="inputbox" size="15" tabindex="2" /></div>
				<label for="remember" class="inline"><input type="checkbox" id="remember" name="remember" checked="checked" tabindex="3" />Remember me</label><br />
				<input type="submit" name="login" value="Log in" tabindex="4" />
				<?php
				if ((true == $new_users) && ((0 == $max_users) || (GamePlayer::get_count( ) < $max_users))) {
					?><input type="button" value="Register" onclick="window.open('register.php<?php echo $GLOBALS['_?_DEBUG_QUERY']; ?>', '_self')" tabindex="5" /><?php
				}
				?>
			</div></form>

			<noscript class="notice ctr">
				<p>Warning! Javascript must be enabled for proper operation of <?php echo GAME_NAME; ?>.</p>
			</noscript>
		</div>

		<?php call($GLOBALS); ?>
<style>

p {
  margin: 1.5em 0;
  color: #aaa;
}

img {
  max-height: 50vh;
  text-align:center;
}

a {
  color: inherit;
}

a:hover {
  color: #bbb;
}

.italic { font-style: italic; }
.small { font-size: 0.8em; }

/** LIGHTBOX MARKUP **/

.lightbox {
  /* Default to hidden */
  display: none;

  /* Overlay entire screen */
  position: fixed;
  z-index: 999;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  
  /* A bit of padding around image */
  padding: 1em;

  /* Translucent background */
  background: rgba(0, 0, 0, 0.8);
}

/* Unhide the lightbox when it's the target */
.lightbox:target {
  display: block;
}

.lightbox span {
  /* Full width and height */
  display: block;
  width: 100%;
  height: 100%;

  /* Size and position background image */
  background-position: center;
  background-repeat: no-repeat;
  background-size: contain;
}
.dropbtn {
font-size: 14px;
    border: none;
    color: white;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    margin: 4px 2px;
    cursor: auto;
    background: rgba(0, 0, 0, 0.2);
    box-shadow: 2px 2px 2px black;
}

.dropup {
  position: relative;
  display: inline-block;
}

.dropup-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 100px;
  bottom: 23px;
  z-index: 1;
}

.dropup-content a {
  font-size: 10px;
  color: black;
  padding-top: 2px;
  padding-right: 2px;
  padding-bottom: 2px;
  padding-left: 2px;
  text-decoration: none;
  display: block;
}

.dropup-content a:hover {background-color: #5F7C8A}

.dropup:hover .dropup-content {
  display: block;
}

.active, .dropup:hover .dropbtn {
  background-color: #5F7C8A;
}
</style>
<!-- Lightbox usage markup -->
<center>
<center><h2>World Classic</h2></center>

<!-- thumbnail image wrapped in a link -->
<a href="#img1">
  <img src="./images/board.jpg">
</a>

<!-- lightbox container hidden with CSS -->
<a href="#" class="lightbox" id="img1">
  <span style="background-image: url('./images/board.jpg')"></span>
</a>
<div class="dropup">
  <button class="dropbtn">More</button>
  <div class="dropup-content">
    <a href="https://www.mapconquest.com/play" class="active">World Classic</a>
    <a href="https://www.mapconquest.com/re">Roman Empire</a>
    <a href="https://www.mapconquest.com/9k">9 Kingdoms</a>
    <a href="https://www.mapconquest.com/vikings">Vikings</a>
    <a href="https://www.mapconquest.com/balkans">Balkans</a>
    <a href="https://www.mapconquest.com/caribbean">Caribbean</a>
    <a href="https://www.mapconquest.com/nz">New Zealand</a>
    <a href="https://www.mapconquest.com/japan">Japan</a>
    <a href="https://www.mapconquest.com/fantasy">Fantasy Map</a>
    <a href="https://www.mapconquest.com/germany">Germany</a>
    <a href="https://www.mapconquest.com/a&a">Axis & Allies</a>
    <a href="https://www.mapconquest.com/na">North America</a>
    <a href="https://www.mapconquest.com/gc">The Gold Coast</a>    
    <a href="https://www.mapconquest.com/australasia">Australasia</a> 
    <a href="https://www.mapconquest.com/greece">Ancient Greece</a> 
    <a href="https://www.mapconquest.com/timor">Timor Islands</a>
    <a href="https://www.mapconquest.com/pi">The Philippines</a> 
    <a href="https://www.mapconquest.com/nn">Navajo Nation</a>   
    <a href="https://www.mapconquest.com/chicago">Chicago</a>  
    <a href="https://www.mapconquest.com/ad395">R.Empire ad395</a>     
  </div>
</div>
<p class="italic small">
  42 territories, 6 regions (WarOrder)
</p></center>
		<div id="footerspacer">&nbsp;</div>

		<div id="footer">
			<p>Copyright © 2021 All Rights Reserved by <?php echo GAME_NAME; ?> (Not Associated with official Risk or Hasbro..)</p>
		</div>

	</div>
</body>
</html>
