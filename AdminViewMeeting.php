<?php 
    session_start();
    include_once "dbconfig.php";

    if (!isset($_SESSION["user_id"])) {
        header("location: index.html");
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Meeting Info - T7P2</title>
</head>
<body>
<div align="center">
    <h1>Meeting Info</h1>
<a href="AdminPage.php">
    <button>Return to Admin Information</button><br><br>
</a>

<?php
    $query = "SELECT * from meetings";
    $result = mysqli_query($db, $query);

    while($row = mysqli_fetch_array($result)) {
        print "<table>" . "<tr>";
            print "Meeting ID: " . $row['meet_id'] . "<br>";
            print  "Subject: " . $row['meet_name'] . "<br>";
            print "Date: " . $row['date'] . "<br>";
            $tslookup = $row['time_slot_id'];
                $query2 = "SELECT start_time, end_time from time_slot where time_slot_id = $tslookup";
                $result2 = mysqli_query($db, $query2);
                $row2 = mysqli_fetch_array($result2);
                mysqli_free_result($result2);
                print "Start time: " . $row2['start_time'] . "<br>";
                print "End time: " . $row2['end_time'] . "<br>";
            print "Group:" . $row['group_id']. "<br>";
            $meetingID = $row['meet_id'];
            // code adapted from https://stackoverflow.com/questions/8169027/how-can-i-submit-a-post-form-using-the-a-href-tag
            // if there is a better way to post I am unaware of please fix
            print "
                <form action = 'AdminDeleteMeeting.php' method = 'post'>
                    <button type = 'submit' name = 'meet_id' value = $meetingID 
                        class = 'btn-link'>Delete Meeting</button>
                </form>
                <form action = 'AdminGroupMaterial.php' method = 'post'>
                    <button type = 'submit' name = 'meet_id' value = $meetingID 
                        class = 'btn-link'>Material</button>
                </form>
            ";
            print "<hr>";
        print "</tr>" . "</table>";
    }
    mysqli_free_result($result);
?>


</div>
</body>
</html>

<?php
    mysqli_close($db);
?>