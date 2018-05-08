<?php

ob_start();
system('ipconfig /all');
$mycom=ob_get_contents();
ob_clean();

$findme = "Physical";
$pmac = strpos($mycom, $findme);
$mac=substr($mycom,($pmac+36),17);

echo $mac;

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1 id="tok"></h1>
    <script src="https://treaty.io/beta/treaty.js"></script>
    <script>
    	treaty.getToken(function(token){
    		treaty.consumeToken(token, function(fingerprint){
    			console.log(fingerprint);
          document.getElementById("tok").innerHTML = fingerprint.deviceId;
    		});
    	});
    </script>
  </body>
</html>
