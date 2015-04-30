<?php
// Must pass session data for the library to work (only if not already included in your app).
session_start();

require 'vendor/autoload.php';
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

try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
  $fbid = $graphObject->getProperty('id');              // To Get Facebook ID
  $fbfullname = $graphObject->getProperty('name'); // To Get Facebook full name
  $fbfname = $graphObject->getProperty('first_name'); // To Get Facebook first name
  $fblname = $graphObject->getProperty('last_name'); // To Get Facebook last name
  $femail = $graphObject->getProperty('email');    // To Get Facebook email ID
  /* ---- Session Variables -----*/
  $_SESSION['FBID'] = $fbid;           
  $_SESSION['FULLNAME'] = $fbfullname;
  $_SESSION['FNAME'] = $fbfname;
  $_SESSION['LNAME'] = $fblname;
  $_SESSION['EMAIL'] =  $femail;
  $_SESSION['FBLOGGED']= true;
  //checkuser($fuid,$ffname,$femail);
  
  header("Location: done.php");
} else {
  //$loginUrl = $helper->getLoginUrl();
  $_SESSION['failed'] = true;
  if (isset($ex))
    $_SESSION['ex']=$ex;
  header("Location: failed.php");
}
?>
