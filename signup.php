<?php 

require_once 'auth.php';
if (controllaAuth()) {
    header("Location: signup.php");
    exit;
}   

// Stiamo usando dei form e quindi inviamo dati post, controlliamoli in $_POST
// Controlliamo che tutti i campi siano riempiti
if(!empty($_POST['username']) && !empty($_POST['nome']) && 
!empty($_POST['cognome']) && !empty($_POST['email']) &&
!empty($_POST['password']) && !empty($_POST['conferma_password']) &&
!empty($_POST['allow'])){
    $error = array();
    $conn = mysqli_connect($dbconfig['db_host'], $dbconfig['db_user'], $dbconfig['db_password'], $dbconfig['db_name']) or die(mysqli_error($conn));

    // username 
    // Controlla che l'username rispetti il pattern specificato
    if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])) {
        $error[] = "Username non valido";
    } else {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        // Cerco se l'username esiste già o se appartiene a una delle 3 parole chiave indicate
        $query = "SELECT username FROM users WHERE username = '$username'";
        $res = mysqli_query($conn, $query);
        if (mysqli_num_rows($res) > 0) {
            $error[] = "Username già utilizzato";
        }
    }

    // password
    if(strlen($_POST['password']) < 8 || !preg_match("/[0-9]/", $_POST['password'])){ 
        $error[]="La password deve essere di 8 caratteri e un numero.";
    }

    // conferma password 

    if(strcmp($_POST['password'], $_POST['conferma_password']) != 0){
        $error[]= "Le password non coincidono";
    }

    // email 
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error[] = "Email non valida";
    } else {
        $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
        $res = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
        if (mysqli_num_rows($res) > 0) {
            $error[] = "Email già utilizzata";
        }
    }


    // registrazione database 
    if(count($error)==0){
        $nome = mysqli_real_escape_string($conn, $_POST['nome']);
        $cognome = mysqli_real_escape_string($conn, $_POST['cognome']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $password = password_hash($password, PASSWORD_BCRYPT);
        
        $query = "INSERT INTO users(username, nome, cognome, email, password) VALUES('$username', '$nome', '$cognome', '$email', '$password')";
     
        if(mysqli_query($conn, $query)){
            // Rimandiamo l'utente alla home se è tutto okay
            $_SESSION['u_username'] = $_POST['username'];
            $_SESSION['u_user_id'] = mysqli_insert_id($conn);
            // La funzione mysqli_insert_id va a prendere l'id dell'ultima query
            mysqli_close($conn);
            header("Location: homepage.php");
            
            
            exit;
        } else { 
            $error[] = "Errore di connessione al Database";
        }

    }


    mysqli_close($conn);

} else if (isset($_POST["username"])) {
    $error[] = array("Riempi tutti i campi");
}

?>

<!DOCTYPE html> 
<html>
    <head>
        <title>Registrazione</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="signup.css" />  
        <script src="signup.js" defer></script>
    </head>
    <body>
        <form name="Form" method="POST">
                   
            <div id="logo">
                
            </div>

           <div class="registrazione"> 
            <h1>Registrazione</h1>
            <div class="username">
            <div><label for='username'>Nome utente</label></div>
            <div><input type='text' name='username'
            <?php 

// Il form effettua la richiesta (POST) alla stessa pagina
// Ad ogni input, quindi, effettuiamo il controllo
            if(isset($_POST['username'])){
                echo "value=".$_POST['username'];
            }
// In questo modo lui ogni volta invierà a sè stesso il valore che c'è nel campo username
// Applicheremo il metodo per ogni campo da compilare
            ?>></div>
            <span>Username già in utilizzo.</span>
            </div>

            <div class="nome">
            <div><label for='nome'>Nome</label></div>
            <div><input type='text' name='nome'
            <?php 
            if(isset($_POST['nome'])){
                echo "value=".$_POST['nome'];
            }
            ?>></div>
            <span>Nome non valido</span>
            </div>

            <div class="cognome">
            <div><label for='cognome'>Cognome</label></div>
            <div><input type='text' name='cognome'
            <?php 
            if(isset($_POST['cognome'])){
                echo "value=".$_POST['cognome'];
            }
            ?>></div>
            <span>Cognome non valido</span>
            </div>

            <div class="email">
            <div><label for='email'>Email</label></div>
            <div><input type='text' name='email'
            <?php 
            if(isset($_POST['email'])){
                echo "value=".$_POST['email'];
            }
            ?>></div>
            <span>E-mail non valida</span>
            </div>

            <div class="password">
            <div><label for='password'>Password</label></div>
            <div><input type='password' name='password'></div>
            <span>Inserisci una password di almeno 8 caratteri</span>
            </div>



            <div class="conferma_password">
            <div><label for='conferma_password'>Conferma Password</label></div>
            <div><input type='password' name='conferma_password'></div>
            <span>Le password non coincidono</span>
            </div>

            <div class="allow"> 
                <div><input type='checkbox' id='verifica' name='allow' value="1"></div>
                <div><label for='allow'>Acconsento al trattamento dei dati personali</label></div>
            </div>

            <div class="submit"><input type='submit' name='submit' value='Registrati' id="submit" disabled></div>

            
            <div class="signin">Hai già un account? <a href="login.php">Accedi</a></div>
            </div>
        </form>
    </body>
</html>