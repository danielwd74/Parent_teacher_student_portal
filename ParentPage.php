<?php
    session_start();

    if (!isset($_SESSION["user_id"])) {
        header("location: index.html");
    }

    $username = isset($_SESSION["user_name"]) ? $_SESSION["user_name"] : "[Unknown]";
    $userid = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : "[Unknown]";
?>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Course Manager - Parent</title>
</head>
<body>
<div align="center">
    <h1>Welcome <?php echo $username; ?></h1>

    <!--  More stuff goes here  -->

    <form action="Logout.php">
        <button type="submit">Log out</button>
    </form>
</div>
</body>
</html>

<?php
