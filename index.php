<?php
// Must pass session data for the library to work (only if not already included in your app).
session_start();
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="utf-8">
  <title>Home | M5S Veneto prova FB</title>
  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Oswald">
  <style>
    body {
      font-family: 'Oswald', serif;
      font-size: 14px;
    }
  </style>
  <!-- un CSS -->      
</head><!--/head-->
<?php

require 'prefs.php';

// Define the root directoy.
define( 'ROOT', dirname( __FILE__ ) . '/' );

// Autoload the required files
require_once( ROOT . 'vendor/autoload.php' );

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;

//Initialize the Facebook SDK.
FacebookSession::setDefaultApplication($app_id, $app_secret);

$helper = new FacebookRedirectLoginHelper($redirect_url);

$loginUrl = $helper->getLoginUrl($scope); 

//var_dump($_SESSION);

?>
<body>
  <?php if ($_SESSION['FBLOGGED']!=true) : ?>
    <P>
      <H2>Newsletter</H2>
      Attivista sottoscrivi aiuta bla bla bla Facebook bla bla bla  propaganda
      bla bla bla riceverai bla bla bla 
    </P>
    <P>
      <form name="frm">
        <input type="checkbox" name="accept_privacy">&nbsp;<font
        size=-2>&nbsp;<a href="privacy.html" target="new_wnd">privacy</a></font>
        <a href="<?php echo $loginUrl; ?>" onclick="if (document.frm.accept_privacy.checked!=true) {alert ('Devi accettare le regole per il trattamento dei dati'); return false; } else return true; ">Login with Facebook</a>
      </form>
    </P>
    <BR>
    <P>
      <img src="imgs/img_invito.png" align="center">
    </P>
  <?php else : ?>
    <p>
      Già loggato in questa app
    </p>
  <?php endif; ?>

</body></html>