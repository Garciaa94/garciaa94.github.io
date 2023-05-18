<?php
session_start();

// Define tu Client ID y Client Secret de la aplicación de GitHub
$clientID = "TU_CLIENT_ID";
$clientSecret = "TU_CLIENT_SECRET";

// Redirige a la página de autorización de GitHub
$authorizeURL = "https://github.com/login/oauth/authorize?client_id=$clientID";
header("Location: $authorizeURL");
exit;
?>
