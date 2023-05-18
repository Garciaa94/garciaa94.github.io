<?php
session_start();

// Define tu Client ID y Client Secret de la aplicación de GitHub
$clientID = "TU_CLIENT_ID";
$clientSecret = "TU_CLIENT_SECRET";

// Verifica si hay un código de autorización en el parámetro 'code'
if (isset($_GET['code'])) {
    // Intercambia el código de autorización por un token de acceso
    $code = $_GET['code'];
    $tokenURL = "https://github.com/login/oauth/access_token";
    $params = array(
        'client_id' => $clientID,
        'client_secret' => $clientSecret,
        'code' => $code
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $tokenURL);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
    $response = curl_exec($ch);
    curl_close($ch);

    $responseData = json_decode($response, true);

    // Verifica si se obtuvo el token de acceso correctamente
    if (isset($responseData['access_token'])) {
        // Hace una solicitud para obtener los datos del usuario
        $accessToken = $responseData['access_token'];
        $userURL = "https://api.github.com/user";
        $options = array(
            'http' => array(
                'header' => "User-Agent: PHP\r\n" .
