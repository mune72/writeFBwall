<?php
/*///////////////////////////////////////////////////////////////////////
Part of the code from the book 
Building Findable Websites: Web Standards, SEO, and Beyond
by Aarron Walter (aarron@buildingfindablewebsites.com)
http://buildingfindablewebsites.com

Distrbuted under Creative Commons license
http://creativecommons.org/licenses/by-sa/3.0/us/
///////////////////////////////////////////////////////////////////////*/

session_start();

///var_dump($_POST);

require_once 'inc/MCAPI.class.php';

function storeAddress(){
  require 'prefs.php';
  
  // Validation
  if(!$_POST['email']){
    $_SESSION['MCOK']=false;
    echo "<BR>"."No email address provided"; } 
  
  if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/i", $_POST['email'])) {
    $_SESSION['MCOK']=false;
    echo "<BR>"."Email address is invalid"; 
  }
  
  // grab an API Key from http://admin.mailchimp.com/account/api/
  $api = new MCAPI($mcAPIkey);
  
  // grab your List's Unique Id by going to http://admin.mailchimp.com/lists/
  // Click the "settings" link for the list - the Unique Id is at the bottom of that page. 
  $list_id = $mclistID;
  
  // Merge variables are the names of all of the fields your mailing list accepts
  // Ex: first name is by default FNAME
  // You can define the names of each merge variable in Lists > click the desired list > list settings > Merge tags for personalization
  // Pass merge values to the API in an array as follows
  $mergeVars = array('FNAME'=>$_POST['fname'],
            'LNAME'=>$_POST['lname'],
            'ID'=>$_POST['fbid'],
            'REGTIME'=>$_POST['regtime'],
            'GENDER'=>$_POST['gender']);
  
  if($api->listSubscribe($list_id, $_POST['email'], $mergeVars) === true) {
    // It worked!  
    echo "<BR>".'Successo! Controlla la tua email per la conferma dell\'iscrizione.';
    $_SESSION['MCOK']=true;
  }else{
    // An error ocurred, echo "<BR>".error message  
    echo "<BR>".'Error: ' . $api->errorMessage;
    $_SESSION['MCOK']=false;
  }
}  
$_SESSION['MCDONE']=true;

storeAddress();
?>
