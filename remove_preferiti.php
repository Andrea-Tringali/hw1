<?php
  require_once 'auth.php';
  if (!$userid=controllaAuth()) {
      header("Location: login.php");
       exit;
   }
 
  $conn = mysqli_connect($dbconfig['db_host'], $dbconfig['db_user'], $dbconfig['db_password'], $dbconfig['db_name']);

  $userid = mysqli_real_escape_string($conn, $_SESSION['u_user_id']);
  $id = mysqli_real_escape_string($conn, $_POST['id']);

  $query = "DELETE FROM preferiti WHERE userid = $userid AND id = '$id'";
  $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

  if($res) {
    $response = array('esito' => true);
  } else {
    $response = array('esito' => false);
  }

  echo json_encode($response);
  mysqli_close($conn);
?>