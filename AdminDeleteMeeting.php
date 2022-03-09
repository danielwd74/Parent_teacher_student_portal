<?php
    session_start();
    include_once "dbconfig.php";
    
    $idToDelete = $_POST['meet_id'];

    print "<h1>" . "Deleting meeting with ID: " . $idToDelete . "</h1>";
    $query = "DELETE from meetings where meet_id = $idToDelete";
    $result = mysqli_query($db, $query);
    if (!($result)) {
        print "Failed to delete from meetings\n";
        print "Status: " . mysqli_connect_error();
        exit();
    }

    mysqli_close($db);
    // taken from logout.php and https://www.tutorialspoint.com/php/php_login_example.htm
    print "Deletion success!";
    header('Refresh: 1; URL = AdminViewMeeting.php');
?>