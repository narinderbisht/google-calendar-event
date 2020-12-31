<?php
require_once('config.php');
require_once('functions.php');
if(isset($_GET['code'])){

	$client_id = CLIENT_ID;
	$redirect_uri = REDIRECT_URIS;
	$client_secret = CLIENT_SECRET;
	$code = $_GET['code'];
	$token_data = GetAccessToken($client_id, $redirect_uri, $client_secret, $code);
	
	/* echo 'Access Token: '. $token_data['access_token'];
	echo '<br/>';
	echo 'Refresh Token: '. $token_data['refresh_token']; */
	echo '<pre>';
	print_r($token_data);
	echo '</pre>';
	
} else {

	echo 'No direct access';
}