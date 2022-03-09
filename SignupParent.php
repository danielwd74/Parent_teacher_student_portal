<?php
session_start();
include "dbconfig.php";

$username= "";
$email = "";
$errors = array();

// Registering Parent Users
$email = mysqli_real_escape_string($db, $_POST['email']);
$name = mysqli_real_escape_string($db, $_POST['name']);
$phone = mysqli_real_escape_string($db, $_POST['phone']);
$password = mysqli_real_escape_string($db, $_POST['password']);


//Form validation
if(empty($name)) array_push($errors, "Name is required");
if(empty($email)) array_push($errors, "Email is required");
if(empty($password))array_push($errors, "Password is required");


// Checking for Existing Accounts

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Signup</title>
</head>
<body>
<div align="center">
    <h1>Parent Sign-Up</h1>
    <form action="SignupParent.php" method="post">
        <label>Email:</label><br>
        <input type="email" name="email" required id="email" placeholder="Enter your email"><br><br>

        <label>Name:</label><br>
        <input type="text" name="name" required id="name" placeholder="Enter your name"><br><br>

        <label>Phone:</label><br>
        <input type="phone" name="phone" required id="phone" placeholder="Enter your phone number"><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required id="password" placeholder="Enter your password">
        <br><br>

        <button type="submit" name="reg_user">Register</button>
        <br><br>
    </form>
    <a href="index.html"><button>Return to sign in</button></a>
</div>
</body>
</html>

<?php
