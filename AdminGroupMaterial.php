<?php
    session_start();
    include_once "dbconfig.php";
    $meetID = $_POST['meet_id'];
?>
<html lang='en'>
<h2>Group current study material</h2>
<?php
    $query = "SELECT * from material where material_id 
        in (select material_id from assign where meet_id = $meetID)";
    $result = mysqli_query($db, $query); 
    if (!($result)) {
        print "Failed to delete from meetings\n";
        print "Status: " . mysqli_connect_error();
        mysqli_free_result($result);
        exit();
    }
   
    while($row = mysqli_fetch_array($result)) { 
        print $row['material_id'] . "<br>";
        print $row['title']. "<br>";
        print $row['author']. "<br>";
        print $row['type']. "<br>";
        print $row['url']. "<br>";
        print $row['assigned_date']. "<br>";
        print $row['notes'];
        print "<hr>";
    }
    mysqli_free_result($result);
?>
<hr></hr>
<?php
// get current avaliable materials
    $query = "SELECT * from material where material_id not 
        in (select material_id from assign where meet_id = $meetID)";
    $result = mysqli_query($db, $query); 
    if (!($result)) {
        print "Failed to delete from meetings\n";
        print "Status: " . mysqli_connect_error();
        mysqli_free_result($result);
        exit();
    }
   
    while($row = mysqli_fetch_array($result)) { 
        print $row['material_id'] . "<br>";
        print $row['title']. "<br>";
        print $row['author']. "<br>";
        print $row['type']. "<br>";
        print $row['url']. "<br>";
        print $row['assigned_date']. "<br>";
        print $row['notes'];
        print "<hr>";
    }
    mysqli_free_result($result);
?>

<a href="AdminViewMeeting.php"><button>Return to meetings</button></a>
</html>
<?php mysqli_close($db) ?>