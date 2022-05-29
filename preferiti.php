<?php 
   require_once 'auth.php';
   if (!$userid=controllaAuth()) {
       header("Location: login.php");
        exit;
    } 
?>



<html>



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
    <link rel='stylesheet' href='preferiti.css'>
    <script src="preferiti.js" defer></script>

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

    <section>
    <div id="preferiti">
        <h1><strong> I tuoi libri preferiti </strong></h1>
    
        <div id="fav-list" ></div>
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