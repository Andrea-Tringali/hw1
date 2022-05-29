<?php 

// Distruggiamoi la sessione e ritorniamo alla login

include 'accesstodb.php';

// Distruggo la sessione esistente
session_start();
session_destroy();


header('Location: login.php');

?>