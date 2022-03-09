<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Signup</title>
</head>
<body>
<div align="center">
    <h1>Student Sign-Up</h1>

    <form action="SignupStudent.php" method="post">
        <label>Email:</label><br>
        <input type="email" name="email" id="email" placeholder="Enter your email"><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" id="password" placeholder="Enter your password"><br><br>

        <label>Parent Email:</label><br>
        <input type="email" name="pemail" id="pemail" placeholder="Enter your parent email"><br><br>

        <label>Name:</label><br>
        <input type="text" name="name" id="name" placeholder="Enter your name"><br><br>

        <label>Phone:</label><br>
        <input type="tel" name="phone" id="phone" placeholder="Enter your phone number"><br><br>

        <label for="grade">Grade:</label>

        <select id="grade">
            <option label="6"></option>
            <option label="7"></option>
            <option label="8"></option>
            <option label="9"></option>
            <option label="10"></option>
            <option label="11"></option>
            <option label="12"></option>
        </select><br><br>

        <button type="submit">Register</button>
        <br><br>
    </form>
    <a href="index.html"><button>Return to sign in</button></a>
</div>
</body>
</html>

<?php
