<?php
  require_once 'auth.php';
  if (!$userid=controllaAuth()) {
      header("Location: login.php");
       exit;
  } 


  if(isset($_SESSION['u_user_id'])) {
    $conn = mysqli_connect($dbconfig['db_host'], $dbconfig['db_user'], $dbconfig['db_password'], $dbconfig['db_name']);

    $userid = mysqli_real_escape_string($conn, $_SESSION['u_user_id']);
    $query = "SELECT * FROM preferiti WHERE userid = $userid";
    $res = mysqli_query($conn, $query);

    $array = array();
    while($risultato = mysqli_fetch_assoc($res)) {
      $array[] =  $risultato;
    }

    echo json_encode($array);
  }
?>