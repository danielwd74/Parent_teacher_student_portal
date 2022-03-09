<center>
  <br/>
<?php
    session_start();
    //use session variable pass_success_flag to check if password entered was valid. If it was echo "Success" to the page. If not, echo "invalid...."
    if($_SESSION["pass_success_flag"] == 1)
         echo "Success";

    else echo "Invalid Password";
 ?>
</center>

<br/>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Phone Result</title>
</head>
<body>
<div align="center">


    <a href="studentPage.php"><button>Return</button></a>

</div>
</body>
</html>
