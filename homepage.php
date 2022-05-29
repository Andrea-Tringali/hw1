<?php 
   require_once 'auth.php';
   if (!$userid=controllaAuth()) {
       header("Location: login.php");
        exit;
    } 
?>


<html>
<head>
<?php 
        // Carico le informazioni dell'utente loggato per visualizzarle nella sidebar
        $conn = mysqli_connect($dbconfig['db_host'], $dbconfig['db_user'], $dbconfig['db_password'], $dbconfig['db_name']);
        $userid = mysqli_real_escape_string($conn, $userid);
        $query = "SELECT * FROM users WHERE id = $userid";
        $res_1 = mysqli_query($conn, $query);
        if(mysqli_num_rows($res_1) > 0 ){
        $userinfo = mysqli_fetch_assoc($res_1);
        $username = mysqli_real_escape_string($conn, $userinfo['username']);
        }
?>



<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Averia+Serif+Libre:wght@700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Prata&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
    <link rel='stylesheet' href='homepage.css'>
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
        <a href="homepage.php">Homepage</a>
        <a href="preferiti.php">Preferiti</a>
        <a href="profilo.php"> Area Privata</a>
        </div>
        

        <div id="benvenuto_e_logout">
           <h2>Benvenuto</h2> <span id="username"><?php echo $username; ?></span>
           <div id="logout">
               <span></span>
               <a href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <header>
        <p><strong>BookFind</strong></p>
    </header>


    <section class=box>
        <form id='cerca' method = 'GET'>
            <div class="container">
              <div id="input">
                <input type='text' id='name' class="view" placeholder="Cerca">
                <button type='submit' id='Login' class="view" onclick="">Search</button>
              </div>
            </div>
        </form>
    </section>

    <div id="book-list">
    </div>
   
    <footer>
        <div id="footer">
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
        </div>

        <div id="logo">
            Powered by <a id="photo" href="https://play.google.com/store/books?hl=it&gl=US" > <img id="logoG" src="google.png" > </img></a>
        </div>
        
    </footer>

</body>
</html>