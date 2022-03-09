<?php
    session_start();
    include_once "dbconfig.php";

    if (!isset($_SESSION["user_id"])) {
        header("location: index.html");
    }

    $username = isset($_SESSION["user_name"]) ? $_SESSION["user_name"] : "[Unknown]";
    $userid = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : "[Unknown]";

    // get all information about student stored in users table
    $userquery = "SELECT * FROM users WHERE id = '$userid'";
    $userresult = mysqli_query($db, $userquery);
    $userrow = mysqli_fetch_assoc($userresult);

    // get all information about student stored in students table
    $studentquery = "SELECT * FROM students WHERE student_id = '$userid'";
    $studentresult = mysqli_query($db, $studentquery);
    $studentrow = mysqli_fetch_assoc($studentresult);
    $student_grade = $studentrow["grade"];

    // get parent's email
    $paremailquery = "SELECT email FROM users WHERE id IN 
                              (SELECT parent_id FROM parents WHERE parent_id IN 
                                        (SELECT parent_id FROM students WHERE student_id = '$userid'))";
    $paremailresult = mysqli_query($db, $paremailquery);
    $paremailrow = mysqli_fetch_assoc($paremailresult);
    $parent_email = $paremailrow["email"];

    mysqli_free_result($userresult);
    mysqli_free_result($studentresult);
    mysqli_free_result($paremailresult);
    mysqli_close($db);
?>

<html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Course Manager - Student</title>
</head>
<body>
<div align="center">
    <h1>Welcome <?php echo $username; ?></h1>

    <!--  More stuff goes here  -->
    <table>
        <tr>
            <td><p>Grade: </p></td>
            <td><?php echo $student_grade; ?></td>
            <td></td>
        </tr>
        <tr>
            <td>Parent's Email:&#9;</td>
            <td><?php echo $parent_email; ?>&#9;</td>
            <td></td>
        </tr>
        <tr>
            <td>Email:&#9;</td>
            <td><?php echo $userrow["email"]; ?>&#9;</td>
            <td><form action="UserEditEmail.php"><button type="submit">Edit Email</button></form></td>
        </tr>
        <tr>
            <td>Password:&#9;</td>
            <td>******&#9;</td>
            <td><form action="UserEditPassword.php"><button type="submit">Edit Password</button></form></td>
        </tr>
        <tr>
            <td>Phone:&#9;</td>
            <td><?php echo $userrow["phone"]; ?>&#9;</td>
            <td><form action="UserEditPhone.php"><button type="submit">Edit Phone</button></form></td>
        </tr>
    </table>

    <br>
    <form action="Logout.php">
        <button type="submit">Log out</button>
    </form>

</div>
</body>
</html>

<?php
