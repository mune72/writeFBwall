<?php
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
  <link type="text/css" rel="stylesheet" href="css/default.css" />
  <!-- un CSS -->      
</head><!--/head-->

<body class="homepage">
<P>
  
<?php if (isset($_SESSION["FBLOGGED"]) && $_SESSION["FBLOGGED"]==true ) : ?>
  
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
    <?php if ($_SESSION['MCOK']==true) : ?>
      <?php $st="<H1>Grazie</H1><BR>".$_SESSION['ALL_FB']['first_name']." ".$_SESSION['ALL_FB']['last_name']."<BR>Riceverai le mail per condividere le immagini all'indirizzo ".$_SESSION['ALL_FB']['email'];
      $st .= "<br>Controlla la tua email per la conferma dell'iscrizione.";
      echo $st; ?>
      &nbsp;
    <?php else : ?> 
      Registrazione <font color=red>NON</font> effettuata<BR>
      Il gestore della mailing list dà un errore: <?php echo $_SESSION['MCMSG']?><BR>
      <BR><BR><BR>Torna all'<a href='index.php'>inizio</a>";
    <?php endif; ?>
  <?php endif; ?>
<?php else : ?>
  Registrazione <font color=red>NON</font> effettuata<BR>
  Accesso a Facebook non riuscito<BR>
  <BR><BR><BR>Torna all'<a href='index.php'>inizio</a>"; 
<?php endif; ?>

</P>
</body>
</html>
