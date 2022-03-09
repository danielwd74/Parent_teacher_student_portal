<?php

session_start();

include_once "dbconfig.php";

//session variable user_id will be used to update the particular user's info in the database.
$userid = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : "[Unknown]";
echo $userid;

//email_success_flag is used to note whether the email address entered was valid or not (used in UserEditEmailError.php)
$_SESSION["email_success_flag"] = 0;

if(isset($_POST["update"])){

$_SESSION["update_email_id"] = $_POST["email"];
$email = $_SESSION["update_email_id"];

//check whether email address is not valid.
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

  header("location: UserEditEmailError.php");
  exit();
}

//Run an update query on the specified user's email row in the database. Changes will be seen in the users table.
else {
  $query = "UPDATE users SET email = '$_SESSION[update_email_id]' where id = '$userid'   ";
   $result = mysqli_query($db,$query);
   $_SESSION["email_success_flag"] = 1;
   header("location: UserEditEmailError.php");
   exit();
   mysqli_free_result($result);
}

}
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
  <p>Enter a new email address: <input type="text" name="email"/></p>

  <input type = "submit" name = "update" value = "Update Email Address"/>
  </form>
    <a href="studentPage.php"><button>Return</button></a>

</div>
</body>
</html>
