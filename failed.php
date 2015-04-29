<?php
// Must pass session data for the library to work (only if not already included in your app).
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
<body>
<?php if (isset($_SESSION['failed']) && $_SESSION['failed'] == true) : ?>
  Accesso tramite Facebook fallito: <a href="index.php">riprova</a>
  <?php
  var_dump($_SESSION);
  if (isset($_SESSION['ex']) )
      echo "<BR>".$_SESSION['ex'];
  ?>
<?php endif; ?>

</body>
</html>