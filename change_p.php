<?php 

require_once 'auth.php';
if (!$userid=controllaAuth()) {
    header("Location: change-password.php");
     exit;
}

if (isset($_POST['op']) && isset($_POST['np'])
    && isset($_POST['c_np'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$op = validate($_POST['op']);
	$np = validate($_POST['np']);
    $crypted_np = password_hash($np, PASSWORD_BCRYPT);
	$c_np = validate($_POST['c_np']);
    
    if(empty($op)){
      header("Location: change-password.php?error=Old Password is required");
	  exit();
    }else if(empty($np)){
      header("Location: change-password.php?error=New Password is required");
	  exit();
    }else if($np !== $c_np){
      header("Location: change-password.php?error=The confirmation password does not match");
	  exit();
    }else {
    	
        $id = $_SESSION['u_user_id'];
		$conn = mysqli_connect($dbconfig['db_host'], $dbconfig['db_user'], $dbconfig['db_password'], $dbconfig['db_name']);
       

        $sql = "SELECT password
                FROM users WHERE 
                id=$id";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 1){
            $result1= mysqli_fetch_assoc($result);
            if(password_verify($op,$result1['password'])){
                $sql_2 = "UPDATE users
                SET password='$crypted_np'
                WHERE id='$id';";
                mysqli_query($conn, $sql_2);
                header("Location: change-password.php?success=Your password has been changed successfully");
                header("Location: logout.php");
                exit();

            }else {
                header("Location: change-password.php?error=Incorrect password");
                exit();
            }
        }

    }
    
}

