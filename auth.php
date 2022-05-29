<?php 

// Controlliamo che l'utente sia già autenticato, per non dover chiedere il login ogni volta


require_once 'accesstodb.php';
session_start();

function controllaAuth(){
    // Innanzitutto verifichiamo che sia presente la variabile di sessione

    if(isset($_SESSION['u_user_id'])){
        // Se esiste già una sessione, la ritorno, altrimenti ritorno 0
            return $_SESSION['u_user_id'];
            
    } else 
        return 0;
    
}

?>