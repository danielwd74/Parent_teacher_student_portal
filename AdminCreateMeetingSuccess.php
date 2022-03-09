<?php
session_start();
include_once "dbconfig.php";
// $connect = mysqli_connect('localhost', 'root', '', 'db2')
// or die (print "<p>" . "Failed to connect to MySQL instance" . "</p>");
// print "<h3>" . "Connected to database" . "</h3>";

$announcement = $_POST['announcement'];
$meetingtype = $_POST['meetingtype'];
$date = $_POST['date'];
$capacity = intval($_POST['capacity']);
$timeslot = $_POST['timeslot'];
$group = $_POST['group'];
#print $announcement . "<br>" . $meetingtype. "<br>" . $date. "<br>" . $capacity
#. "<br>" . $timeslot. "<br>" . $group;

$query3 = "SELECT max(meet_id) as max from meetings";
$result3 = mysqli_query($db, $query3);
if(!$result3) {
    print "<p>" . "Could not find max" . "</p>";
    print "<p>" . "Could not complete query for reason: " . mysqli_error($db) . "</p>";
    exit();
}

$row2 = mysqli_fetch_array($result3);
$number = $row2['max'] + 1;
mysqli_free_result($result3);

$query2 = "INSERT into meetings(meet_id, meet_name, date, time_slot_id, capacity, announcement, group_id) 
values($number, '$meetingtype', '$date', $timeslot, $capacity, '$announcement', $group)"; #. $meetingtype . , $date, $timeslot, $capacity, $announcement, $group)";
// result does not need to be freed, insertion
$result2 = mysqli_query($db, $query2);
if(!$result2) {
    print "<p>" . "Could not insert into meetings" . "</p>";
    print "<p>" . "Could not complete query for reason: " . mysqli_error($db) . "</p>";
    exit();
}

print "<h1>Successfully added meeting</h1>";
//mysqli_free_result($result);
mysqli_close($db);
// taken from logout.php and https://www.tutorialspoint.com/php/php_login_example.htm
header('Refresh: 1; URL = AdminCreateMeeting.php');
?>