<?php 
   require_once 'auth.php';
   if (!$userid=controllaAuth()) {
       header("Location: login.php");
        exit;
    } 
?>

<?php 

    $conn = mysqli_connect($dbconfig['db_host'], $dbconfig['db_user'], $dbconfig['db_password'], $dbconfig['db_name']);
    $userid = mysqli_real_escape_string($conn, $userid);
    $query = "SELECT * FROM users WHERE id = $userid";
    $res_1 = mysqli_query($conn, $query);
    if(mysqli_num_rows($res_1) > 0 ){
    $userinfo = mysqli_fetch_assoc($res_1);
    $username = mysqli_real_escape_string($conn, $userinfo['username']);
    } 
?>



<html>

<?php 
        // Carico le informazioni dell'utente loggato per visualizzarle nella sidebar (mobile)
        $conn = mysqli_connect($dbconfig['db_host'], $dbconfig['db_user'], $dbconfig['db_password'], $dbconfig['db_name']);
        $userid = mysqli_real_escape_string($conn, $userid);
        $query = "SELECT * FROM users WHERE id = $userid";
        $res_1 = mysqli_query($conn, $query);
        if(mysqli_num_rows($res_1) > 0 ){
        $userinfo = mysqli_fetch_assoc($res_1);
        }
?>

<!DOCTYPE html>
<html>
    <head>

    <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Averia+Serif+Libre:wght@700&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Prata&display=swap" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <link rel='stylesheet' href='profilo.css'>
        <script src="free.js" defer></script>

        <meta name="viewport"content="width=device-width, initial-scale=1">
        
        <title> BookFind </title>

    </head>

    <body>

        <nav>

            <div id="menu">
            <div></div>
            <div></div>
            <div></div>
            </div>


            <div class="collegamenti">
                <a href="homepage.php" id="return"> </a>
                <a href="homepage.php">Torna all'homepage</a>
            </div>

        </nav>


        <section class="profilo">

            <h1><strong> Il tuo profilo </strong></h1>

            <section class = "dati">
                <div id="benvenuto_e_logout">
                <h1>@</h1><span id="username"><?php echo $username; ?></span>
                </div>

                <div class="area1">
                    <h4>Nome: <span><?php echo $userinfo['nome'] ?></span></h4>
                    <h4>Cognome: <span><?php echo $userinfo['cognome'] ?></span></h4>
                    <h4>Username: <span><?php echo $userinfo['username'] ?></span></h4>
                    <h4>Email: <span><?php echo $userinfo['email'] ?></span></h4>
                </div>

            </section>

        </section>

        <section class="mod">
                <h1><img src="settings.svg"><strong>Impostazioni</strong></img></h1>
                <div>
                > <a href="change-password.php">Modifica password</a>
                </div>
        </section>

        <footer>

            <div><h2>BookFind</h2>
            <a>Informativa e privacy</a>
            </div>

            <div><h2>Business</h2>
            <a>Lavora con noi</a>
            </div>

            <div><h2>Social</h2>
            <a>Facebook</a>
            <a>Instagram</a>
            <a>Twitter</a>
            </div>

            <div><h2>Contatti</h2>
            <a>Assistenza chat</a>
            <a>Reclami</a>
            </div>

            <div id="nomecognome"><h2>Andrea</h2><h2>Tringali</h2><h2>1000002012</h2></div>

        </footer>

    </body>
</html>