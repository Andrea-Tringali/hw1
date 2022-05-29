<?php

 require_once 'auth.php';
 if (!$userid=controllaAuth()) {
     header("Location: login.php");
      exit;
  }

 $conn = mysqli_connect($dbconfig['db_host'], $dbconfig['db_user'], $dbconfig['db_password'], $dbconfig['db_name']);

 $userid = mysqli_real_escape_string($conn, $_SESSION['u_user_id']);

 $query = "SELECT * FROM preferiti WHERE userid = $userid AND id ='".$_GET['id']."';";
 $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
 $preferito = mysqli_num_rows($res) > 0;

 echo json_encode(['preferito' => $preferito]);
 mysqli_close($conn);

?>