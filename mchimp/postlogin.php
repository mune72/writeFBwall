<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
        <title>Ajax Mailing List Sign Up System</title>
        <link type="text/css" rel="stylesheet" href="css/default.css" />
    </head>

    <body>
        <p id="description">Monthly news and updates plus discounts on all our products.</p>
         <form id="signup" action="<?=$_SERVER['PHP_SELF']; ?>" method="get">
          <fieldset>
            <legend>Join Our Mailing List</legend>
            
              <div id="response">
                <? require_once('inc/store-address.php'); if($_GET['submit']){ echo storeAddress(); } ?>
              </div>
            
              <label for="email" id="email-label">Email Address</label>
              <input type="text" name="email" id="email" />
            
              <label for="fname" id="fname-label">First Name</label>
              <input type="text" name="fname" id="fname" />
            
              <label for="lname" id="lname-label">Last Name</label>
              <input type="text" name="lname" id="lname" />
            
              <label for="address" id="address-label">Address</label>
              <input type="text" name="address" id="address" />
            
              <label for="city" id="city-label">City</label>
              <input type="text" name="city" id="city" />
            
              <label for="state" id="state-label">State</label>
              <input type="text" name="state" id="state" />
            
              <label for="zip" id="zip-label">State</label>
              <input type="text" name="zip" id="zip" />
            
              <input type="image" src="i/join.jpg" name="submit" value="Join" class="btn" alt="Join" />
            
              <div id="no-spam">We'll never spam or give this address away</div>
          </fieldset>
        </form>      

        <!-- Some fancy Ajax stuff to store the sign up info. If you don't want to use it, just delete it and the form will still work -->
        <script type="text/javascript" src="js/prototype.js"></script>
        <script type="text/javascript" src="js/mailing-list.js"></script>

    </body>
</html>
