<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
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

<body class="homepage">
  
<P>
  <H1>Done!</h1>
<?php
die();
  $xmlfile = "emnl/application/data/clients.xml";
  
  class MyDB extends SQLite3
  {
    function __construct() {
       $this->open('emnl/application/data/mldb.sqlite');
    }
  }
  $db = new MyDB();
  if(!$db){
    echo $db->lastErrorMsg();
  } else {
    //echo "Opened database successfully\n";
  }
   
  //var_dump($_SESSION);

  if (isset($_SESSION["FB"]) && $_SESSION["FB"]==true ) {      
    // controllo se è già nel DB
    $nRows=0;
    $sql = "SELECT COUNT(*) as count FROM USERS WHERE idFB='".$_SESSION['ALL_FB']['id']."';";
    $res = $db->query($sql);
    $row = $res->fetchArray(SQLITE3_ASSOC);
    $nRows = $row['count'];
    if($nRows>0) {
      $sql = "SELECT * FROM USERS WHERE idFB='".$_SESSION['ALL_FB']['id']."';";
      $res = $db->query($sql);
      $row = $res->fetchArray(SQLITE3_ASSOC);
      
      //non aggiungo e avviso
      $st = "<H3>Grazie MA</H3> ".$_SESSION['ALL_FB']['first_name']." ".$_SESSION['ALL_FB']['last_name']." ti sei già registrat";
      // a/o
      if ($_SESSION['ALL_FB']['gender']=='male')
        $st .= "o ";
      else
        $st .= "a ";
      $st .= "il ".$row['reg_time'];
      echo $st;
    } else {
      $sql = "INSERT INTO USERS (idFB, first_nameFB,  last_nameFB, emailFB, genderFB, usernameFB, reg_time) VALUES ('".$_SESSION['ALL_FB']['id']."','".$_SESSION['ALL_FB']['first_name']."','".$_SESSION['ALL_FB']['last_name']."','".$_SESSION['ALL_FB']['email']."','".$_SESSION['ALL_FB']['gender']."','".$_SESSION['ALL_FB']['name']."', '".date('d/m/y H:i:s')."');";
      $ret = true;
      $ret = $db->exec($sql);
      if(!$ret){
        echo $db->lastErrorMsg();
      } else {
        $sxe = simplexml_load_file($xmlfile) or die("Error: Cannot create object");

        //var_dump($sxe);
        $ClientsNode = $sxe[0];

        $client = $ClientsNode->addChild('client');
        $client->addChild('name', $_SESSION['ALL_FB']['first_name']." ".$_SESSION['ALL_FB']['last_name']);
        $client->addChild('email', $_SESSION['ALL_FB']['email']);
        $client->addChild('id', $_SESSION['ALL_FB']['id']);
        $sxe->asXML($xmlfile);
        
        $st = "<H1>Grazie</H1> ".$_SESSION['ALL_FB']['first_name']." ".$_SESSION['ALL_FB']['last_name']." riceverai le mail per condividere le immagini all'indirizzo ".$_SESSION['ALL_FB']['email'];
        echo $st;
      } // insert riuscito
    } // utente non già presente
  } // sessione ok
    else {
    echo "Registrazione <font color=red>NON</font> effettuata: torna all'<a href='index.php'>inizio</a>";
}
$db->close();   
?>
  
</P>
</body>
</html>
