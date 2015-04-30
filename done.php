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
  <link type="text/css" rel="stylesheet" href="css/default.css" />
  <!-- un CSS -->      
</head><!--/head-->

<body class="homepage">
<?php if ($_SESSION['MCDONE']!=true) : ?>
  <p id="description">
   Mailing List Regionali 2015  M5S.
   <form id="signup" action="mc_store-address.php" method="post">
    <fieldset>
      <legend>Completa l'iscrizione alla Mailing List: correggi i dati di Facebook</legend>
      <table>
        <tr>
          <td align="right">     
            <label for="fname" id="fname-label">Nome</label>
          </td>
          <td>
            <input type="text" name="fname" id="fname" value="<?php if (isset($_SESSION['FNAME']) && $_SESSION['FNAME']!=null ) echo $_SESSION['FNAME'] ?>" >
          </td>
        </tr>
        <tr>
          <td align="right">     
            <label for="lname" id="lname-label">Cognome</label>
          </td>
          <td>
            <input type="text" name="lname" id="lname"  value="<?php if (isset($_SESSION['LNAME']) && $_SESSION['LNAME']!=null ) echo $_SESSION['LNAME'] ?>" >
          </td>
        </tr>
        <tr>
          <td align="right">
            <label for="email" id="email-label">Indirizzo email</label>
          </td>
          <td>
            <input type="text" name="email" id="email"  value="<?php if (isset($_SESSION['EMAIL']) && $_SESSION['EMAIL']!=null ) echo $_SESSION['EMAIL'] ?>" >
          </td>
        </tr>
        <tr>
          <td colspan=2>
            <input type="hidden" name="gender" value="<?php if (isset($_SESSION['GENDER']) && $_SESSION['GENDER']!=null ) echo $_SESSION['GENDER']; else echo "male"; ?>">
            <input type="hidden" name="fbid" value="<?php if (isset($_SESSION['FBID']) && $_SESSION['FBID']!=null ) echo $_SESSION['FBID'] ?>">
            <input type="hidden" name="regtime" value="<?php echo date('d/m/y H:i:s') ?>">
          
            <input type="image" src="img/join.jpg" name="submit" value="Join" class="btn" alt="Join" />
          </td>
        </tr>
        <tr>
          <td colspan=2> Non manderemo pubblicità o daremo ad altri il tuo indirizzo</td>
        </tr>
      </table>
    </fieldset>
   </form>
  </p>    
  <?php else : ?>
    <?php if ($_SESSION['MCOK']!=true) : ?>
      <p>
        Il gestore della mailing list dà un errore
      </p>
    <?php endif; ?>
  <?php endif; ?>
<?php
  die();
  
  
  //var_dump($_SESSION);
    
  class MyDB extends SQLite3
  {
    function __construct() {
       $this->open('mldb.sqlite'); // writabile to www-data but not to be served by the http server
    }
  }
  $db = new MyDB();
  if(!$db){
    echo $db->lastErrorMsg();
  } else {
    //echo "Opened database successfully\n";
  }

  if (isset($_SESSION["FBLOGGED"]) && $_SESSION["FBLOGGED"]==true ) {      
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
        $st = "<H1>Grazie</H1> ".$_SESSION['ALL_FB']['first_name']." ".$_SESSION['ALL_FB']['last_name']." riceverai le mail per condividere le immagini all'indirizzo ".$_SESSION['ALL_FB']['email'];
        $st .= "<br>Controlla la tua email per la conferma dell'iscrizione.";
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
