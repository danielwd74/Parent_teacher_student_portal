<?php

session_start();

include_once "dbconfig.php";

//session variable user_id will be used to update the particular user's info in the database.
$userid = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : "[Unknown]";
echo $userid;

//pass_success_flag is used to note whether the password entered was valid or not (used in UserEditPasswordError.php)
$_SESSION["pass_success_flag"] = 0;

if(isset($_POST["update"])){

$_SESSION["update_password"] = $_POST["password"];


//check whether password is empty.
if(empty($_SESSION["update_password"])){

  header("location: UserEditPasswordError.php");
  exit();
}

//Run an update query on the specified user's password row in the database. Changes will be seen in the users table.
else {
  $query = "UPDATE users SET password = '$_SESSION[update_password]' where id = '$userid'   ";
   $result = mysqli_query($db,$query);
   $_SESSION["pass_success_flag"] = 1;
   header("location: UserEditPasswordError.php");
   exit();
   mysqli_free_result($result);
}

}

//header("location: UserEditPhoneError.php");
//exit();
//  $newPhone =  $_POST["phone"];


//mysqli_free_result($result);
mysqli_close($db);

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>[Page Title] - T7P2</title>
</head>
<body>
<div align="center">

    <p> Edit phone </p>

  <form  action="" method="post">
  <p>Enter a new password: <input type="text" name="password"/></p>

  <input type = "submit" name = "update" value = "Update Password"/>
  </form>
    <a href="studentPage.php"><button>Return</button></a>

</div>
</body>
</html>
