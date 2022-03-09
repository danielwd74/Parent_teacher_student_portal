<?php
    // Login code adapted from https://www.tutorialspoint.com/php/php_mysql_login.htm
    include_once "dbconfig.php";
    session_start();
    $error = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

        $adminemail = mysqli_real_escape_string($db, $_POST['adminemail']);
        $adminpass = mysqli_real_escape_string($db, $_POST['adminpassword']);

        $loginquery = "SELECT id, name FROM users WHERE email = '$adminemail' AND password = '$adminpass' AND id IN 
                    (SELECT admin_id FROM admins)";
        $result = mysqli_query($db, $loginquery);
        $resultcount = mysqli_num_rows($result);

        if($resultcount == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION["user_name"] = $row["name"];
            $_SESSION["user_id"] = $row["id"];

            header("location: AdminPage.php");
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
    <title>Admin Login</title>
</head>
<body>
<div align="center">
    <h1>Admin Sign In</h1>

    <p><?php echo $error; ?></p>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="adminemail">Email:</label><br>
        <input type="email" name="adminemail" id="adminemail" placeholder="Enter your email"><br><br>

        <label for="adminpassword">Password:</label><br>
        <input type="password" name="adminpassword" id="adminpassword" placeholder="Enter your password"><br><br>
        <br>
        <button type="submit">Sign In</button>
        <br><br>
    </form>

    <br>
    <a href="index.html">
        <button>Back</button>
    </a>

</div>
</body>
</html>
