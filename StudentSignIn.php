<?php
// Login code adapted from https://www.tutorialspoint.com/php/php_mysql_login.htm
include_once "dbconfig.php";
session_start();
$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $studentemail = mysqli_real_escape_string($db, $_POST['studentemail']);
    $studentpass = mysqli_real_escape_string($db, $_POST['studentpassword']);

    $loginquery = "SELECT id, name FROM users WHERE email = '$studentemail' AND password = '$studentpass' AND id IN 
                    (SELECT student_id FROM students)";
    $result = mysqli_query($db, $loginquery);
    $resultcount = mysqli_num_rows($result);

    if($resultcount == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION["user_name"] = $row["name"];
        $_SESSION["user_id"] = $row["id"];

        header("location: StudentPage.php");
        exit();
    }else {
        $error = "Error: Your login email or password is invalid";
    }

    mysqli_free_result($result);
}

mysqli_close($db);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
</head>
<body>
<div align="center">
    <h1>Student Sign In</h1>

    <p><?php echo $error; ?></p>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="studentemail">Email:</label><br>
        <input type="email" name="studentemail" id="studentemail" placeholder="Enter your email"><br><br>

        <label for="studentpassword">Password:</label><br>
        <input type="password" name="studentpassword" id="studentpassword" placeholder="Enter your password"><br><br>
        <br>
        <button type="submit">Sign In</button>
        <br><br>
    </form>
    <a href="index.html"><button>Return</button></a>
</div>
</body>
</html>

