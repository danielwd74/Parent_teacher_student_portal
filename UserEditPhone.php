<?php

        session_start();

        include_once "dbconfig.php";

        //session variable user_id will be used to update the particular user's info in the database.
        $userid = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : "[Unknown]";
        echo $userid;

        //success_flag is used to note whether the phone number entered was valid or not (used in UserEditPhoneError.php)
        $_SESSION["success_flag"] = 0;

        if(isset($_POST["update"])){

        $_SESSION["phone_number"] = $_POST["phone"];

        //check whether phone number is 10 digits long or if it contains any characters other than numbers.
        if((strlen($_SESSION["phone_number"]) != 10) ||
          (is_numeric($_SESSION["phone_number"]) != true)){

          header("location: UserEditPhoneError.php");
          exit();
        }

        //Run an update query on the specified user's phone number. Changes will be seen in the users table.
        else {
          $query = "UPDATE users SET phone = '$_SESSION[phone_number]' where id = '$userid'   ";
           $result = mysqli_query($db,$query);
           $_SESSION["success_flag"] = 1;
           header("location: UserEditPhoneError.php");
           exit();
           mysqli_free_result($result);
        }

        }
        mysqli_close($db);
 ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit phone number</title>
</head>
<body>
<div align="center">
  <p> Edit phone </p>

<form  action="" method="post">
<p>Enter a new phone number: <input type="text" name="phone"/></p>

<input type = "submit" name = "update" value = "Update Phone Number"/>
</form>
  <a href="studentPage.php"><button>Return</button></a>

</div>

</body>
</html>
