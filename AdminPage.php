<?php
    session_start();
    include_once "dbconfig.php";

    if (!isset($_SESSION["user_id"])) {
        header("location: index.html");
    }

    $username = isset($_SESSION["user_name"]) ? $_SESSION["user_name"] : "[Unknown]";
    $userid = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : "[Unknown]";
?>

<html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Course Manager - Admin</title>
</head>
<body>
<div align="center">
    <h1> Welcome <?php echo $username; ?></h1>
    <center><b>Name:</b> <?php print $username; ?></center>
    <center><b>Email:</b> <?php 
        $query = "SELECT email from users where id = $userid";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        $adminEmail = $row["email"];

        print $adminEmail;
        mysqli_free_result($result);
    ?>
    <a href="AdminEditEmail.php"><button>Edit Email</button></a>
    </center>
    <center><b>Phone:</b> <?php 
        $query = "SELECT phone from users where id = $userid";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        $adminPhone = $row["phone"];

        print $adminPhone;
        mysqli_free_result($result);
        #mysqli_close($db);
    ?>
    <a href="AdminEditPhone.php"><button>Edit Phone</button></a>
    </center>
    <center><b>Password:</b> <?php 

    ?>
    <a href="AdminEditPassword.php"><button>Edit Password</button></a>
    </center>

    <!--  More stuff goes here  -->
    <p>
        <a href="AdminViewMeeting.php"><button>View Meetings</button>
        <a href="AdminCreateMeeting.php"><button>Create Meeting</button>
        <a href="AdminCreateMaterial.php"><button>Create Study Materials</button>
    </p>
    
    <form action="Logout.php">
        <button type="submit">Log out</button>
    </form>
</div>
</body>
</html>

<?php
    mysqli_close($db);
?>
