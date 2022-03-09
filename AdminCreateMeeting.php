<html lang = 'en'>
<center>
<h1>Create a meeting:</h1>
<!--print "<h1><center>" . "Create a meeting: " . "</center></h1>";
#action = '/phase2/connect.php'-->
<form action = "AdminCreateMeetingSuccess.php" method = 'post'> <body>
            <label for='meetingtype'>Meeting Type:</label>
                <select name='meetingtype' id='meetingtype'> 
                    <option value = 'Math'>Math</option>
                    <option value = 'Pschology'>Pschology</option>
                    <option value = 'Accounting'>Accounting</option>
                    <option value = 'Chemisry'>Chemistry</option>
                    <option value = 'Sociology'>Sociology</option>
                    <option value = 'Biology'>Biology</option>
                    <option value = 'Buisness'>Buisness</option>
                    <option value = 'Computer Science'>Computer Science</option>
                    <option value = 'Music'>Music</option>
                    <option value = 'Economics'>Economics</option>
                    <option value = 'Nursing'>Nursing</option>
                    <option value = 'History'>History</option>
                </select>
                <br>
            <label for='date'>Date as YYYY-MM-DD:</label>
                <input type='date' id='date' name = 'date'>
            <br>
            <label for='announcement'>Announcement:</label>
                <input type='text' id='annoncement' name='announcement'>
            <br> 
            <label for='capacity'>Capacity (enter 1-1000):</label>
                <input type='number' id='capacity' name='capacity'>
            <!--<select name='capacity' id='capacity'>
                     <option value = '1'>1</option>
                    <option value = '2'>2</option>
                    <option value = '3'>3</option> -->
                </select> <br>
            <label for='timeslot'>Time Slot ID:</label>
                <select name='timeslot' id='timeslot'>
                <?php
                    session_start();
                    include_once "dbconfig.php";
                    $query = "SELECT time_slot_id from time_slot where day_of_the_week = 'Sunday' or
                        day_of_the_week = 'Saturday'";
                    $result = mysqli_query($db, $query);
                    if (!$result) {
                        print "<p>" . "Could not complete query for reason: " . mysqli_error($db) . "</p>";
                        exit();
                    }
                    while ($row = mysqli_fetch_array($result)) {
                        $new = $row['time_slot_id'];
                        print "<option value = '$new'>$new</option>";
                        echo $row['time_slot_id'];
                    }
                    mysqli_free_result($result);
                ?>
                </select> <br>
            <label for='group'>Group:</label>
                <select name='group' id='group'>
                    <?php
                        for ($i = 1; $i <= 13; $i++)
                            print "<option value = '$i'>$i</option>";
                    ?>
                </select> <br> <br>
            <input type = 'submit' value = 'Create Meeting'>
</body>
</form>
<a href="AdminPage.php">
    <button>Return to Admin Information</button>
</a>
</center>
</html>

<?php 
#session_start();
#include_once "dbconfig.php";

$query = "SELECT * from time_slot where day_of_the_week = 'Sunday' or
        day_of_the_week = 'Saturday'";
$result = mysqli_query($db, $query);
if (!$result) {
    print "<p>" . "Could not complete query for reason: " . mysqli_error($db) . "</p>";
    exit();
}

#print "<center>";

while ($row = mysqli_fetch_array($result))
{
    $id = $row['time_slot_id'];
    $dwk = $row['day_of_the_week'];
    $st = $row['start_time'];
    $et = $row['end_time'];
    print "<table><tr>
            ID: $id<br>
            Day of the week: $dwk<br>
            Start Time: $st<br>
            End Time: $et <hr>
        </tr></table>";
}

#print "</center>"

/*names =
meetingtype
date
announcement
capacity
timeslot
group*/
mysqli_free_result($result);
mysqli_close($db);
?>

