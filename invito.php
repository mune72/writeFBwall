<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="utf-8">
  <title>Home | M5S Veneto prova FB</title>
  <!-- un CSS -->      
</head><!--/head-->

<body class="homepage">

<script>
  
  alert('preInizio');
      
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/it_IT/sdk/debug.js";
     //js.src = "//connect.facebook.net/it_IT/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
  
  window.fbAsyncInit = function() {
    FB.init({
      appId      : 'XXX',
      xfbml      : true,
      version    : 'v2.3'
    });
  }
  
  alert('inizio');
  
  FB.login(function(response) {
      if (response.authResponse) {
        var access_token = FB.getAuthResponse()['accessToken'];
        FB.api('/me/photos?access_token='+access_token, 'post',
               { url: imgs/img_JB_prova.jpg, access_token: access_token },
               function(response) {
                if (!response || response.error) {
                    alert('Error occured: ' + JSON.stringify(response.error));
                } else {
                    alert('Post ID: ' + response);
                }
               }
        )
      } else {
          console.log('User cancelled login or did not fully authorize.');
      }
    },
    { scope: 'publish_actions', return_scopes: true }
  );
 
print ('Fine');

  //(function(d, s, id){
  //   var js, fjs = d.getElementsByTagName(s)[0];
  //   if (d.getElementById(id)) {return;}
  //   js = d.createElement(s); js.id = id;
  //   js.src = "//connect.facebook.net/it_IT/sdk/debug.js";
  //   //js.src = "//connect.facebook.net/it_IT/sdk.js";
  //   fjs.parentNode.insertBefore(js, fjs);
  // }(document, 'script', 'facebook-jssdk'));
  
  //To Post on Friends Page: Enter the facebook user Id of friends in place of "/me" .
  //"/"+friends_user_id+"/photos" ....
</script>

<img src="imgs/img_invito.png" align="center">


<!--
<a onclick="publishOnFB('page title', 'page caption', 'default message'); return false;">Share on Facebook</a>
-->
</body>
</html>
