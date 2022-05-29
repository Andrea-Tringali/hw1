<?php

// Verifica che l'utente sia già loggato, in caso positivo va direttamente alla home
include 'auth.php';
if (controllaAuth()) {
    header('Location: homepage.php');
    exit;
}   
 

// Vogliamo gestire una sessione che sia già attiva
// Per farlo useremo una pagina auth.php
// Se l'utente ha già effettuato l'eccesso deve essere reindirizzato alla homepage
if(isset($_POST['username']) && isset($_POST['password'])){
    // Se username e password sono stati inviati
    // Connessione al DB
    $conn = mysqli_connect($dbconfig['db_host'], $dbconfig['db_user'], $dbconfig['db_password'], $dbconfig['db_name']) or die(mysqli_error($conn));
    // Preparazione 
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // ID e Username per sessione, password per controllo
    $query = "SELECT id, username, password FROM users WHERE username = '$username'";
    // Esecuzione
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));;
    if (mysqli_num_rows($res) > 0) {
        // Ritorna una sola riga, il che ci basta perché l'utente autenticato è solo uno
        $entry = mysqli_fetch_assoc($res);
        
        if (password_verify($password, $entry['password'])) {
            
            // Imposto una sessione dell'utente
            $_SESSION["u_username"] = $entry['username'];
            $_SESSION["u_user_id"] = $entry['id'];
            header("Location: homepage.php");
            mysqli_free_result($res);
            mysqli_close($conn);
            exit;
        }
    }
    }

?>



<!DOCTYPE html>
<html>
    <head>
        <title>Accedi</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="login.css" /> 
        <script src="login.js" defer></script>
    </head>
    <body>
        <form name="loginForm" method="post" action="login.php">
            
         
            <div id="logo">

            </div>

            <div class="accesso"> 
                
                <h1>Accedi</h1>
                
                <input type="text" id="username" placeholder="Username" name="username" maxlength="20" required>
                <p id='segnalazione' class='erroreU hidden'>"Inserisci l'username"</p>
            
                <input type="password" id="password" placeholder="Password" name="password" maxlength="15" required>
                <p id='segnpass' class='erroreP hidden'>Inserisci la password</p>
                
                <button id="bottone" type="submit" name="access">Accedi</button>

            <div class="login">Non sei registrato? <a href="signup.php">Registrati</a></div>
            </div>
            </div>
        </form>
    </body>
</html>