<?php 
print_r($_GET);

$ClientID="";
$Secret="";

$login=curl_init("https://api-m.sandbox.paypal.com/v1/oauth2/token");
curl_setopt($login,CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($login,CURLOPT_USERPWD,$ClientID.":".$Secret);

curl_setopt($login,CURLOPT_RETURNTRANSFER, "grant_type=client_credentials");

$Respuesta=curl_exec($login);

$objRespuesta=json_decode($Respuesta);

$AccessToken=$objRespuesta->access_token;
print_r($AccessToken);
?>