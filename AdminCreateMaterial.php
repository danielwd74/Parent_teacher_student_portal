<?php
    session_start();
    include_once "dbconfig.php";
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>[Page Title] - T7P2</title>
</head>
<body>
<div align="center">
    <h1>Create Study Materials</h1>

    <form method = 'post'> <body>
        <label for='title'>Title:</label>
            <input type='text' id='title' name='title'>
            <br>
        <label for='author'>Author:</label>
            <input type='text' id='author' name='author'>
            <br>
        <label for='url'>URL:</label>
            <input type='url' id='url' name='url'>
            <br>
        <label for='notes'>Notes:</label>
            <input type='text' id='notes' name='notes'>   
            <br>     
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
            </select> <br><br>
        <input type = 'submit' value = 'Create Material'>
    </form>


<a href="AdminPage.php">
    <button>Return to Admin Information</button><br><br>
</a>

<?php
/*
    $count = 100;
    $query = "SELECT max(material_id) as max from material";
    $result = mysqli_query($db, $query);
    if(!$result) {
        print "<p>" . "Could not find max" . "</p>";
        print "<p>" . "Could not complete query for reason: " . mysqli_error($db) . "</p>";
        exit();
    }
    
    $row = mysqli_fetch_array($result);
    $count = $row['max'] + 1;
    mysqli_free_result($result);

    $material_id = $count;
    $title = $_POST['title'];
    $author = $_POST['author'];
    $type = $_POST['meetingtype'];
    $url = $_POST['url'];
    // https://www.w3schools.com/php/phptryit.asp?filename=tryphp_date1
    date_default_timezone_set('EST');
    #echo date('y-m-d');
    $assigned_date = date('y-m-d');
    $notes = $_POST['notes'];

    $query = "INSERT into material
        values($material_id, '$title', '$author', '$type', '$url', '$assigned_date', '$notes')";
    // doesnt need to be freed, inserting
    $result = mysqli_query($db, $query);
    if(!$result) {
        print "<p>" . "Could not insert into materials" . "</p>";
        print "<p>" . "Could not complete query for reason: " . mysqli_error($db) . "</p>";
        exit();
    }
    else {
        print "<p>" . "Material entry successfull! with values";
        print "<p>" . "material_id: " . $material_id;
        print "<p>" . "title: " . $title;
        print "<p>" . "author: " . $author;
        print "<p>" . "type: " . $type;
        print "<p>" . "url: " . $url;
        print "<p>" . "assigned_date: " . $assigned_date;
        print "<p>" . "notes: " . $notes;
    }*/
?>

</div>
</body>
</html>

<?php
    mysqli_close($db);
?>