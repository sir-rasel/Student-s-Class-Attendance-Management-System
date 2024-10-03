<?php
    session_start();
    session_unset();
    session_destroy();

    session_start();
    $_SESSION["instituteStatus"]=false;
    $_SESSION["studentStatus"]=false;
    $_SESSION["teacherStatus"]=false;
?>

<!doctype html>
<html>
<head>
    <title>Student Class Attendance Management System</title>
    
    <meta charset="UTF-8">
    <meta name="description" content="Student Class Attendance Management System">
    <meta name="keywords" content="Class, Attendance, Managment">
    <meta name="author" content="Saiful Islam Rasel">
    <meta http-equiv="refresh" content="60">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/button.css">
</head>
<body>
    
    <div class="mainSection">
        <div class="header">
            <img src="slideShowImage/index.jpg" alt="demoImage">
            <h2>STUDENT'S CLASS ATTENDANCE MANAGEMENT SYSTEM</h2>
        </div>
        
        <div class="contentSection">
            <h3>Welcome to our "Student's Class Attendance Management System".</h3>
            <a href="loginFile/loginView.php">LOG IN / SIGN IN</a>
            <br/><br/>
            <a href="registerFile/registerView.php">REGISTER / SIGN UP</a>
            <h3>Thanks for using our service.</h3>
        </div>
        
    
        <div class="footer">
    <h4>&copy 2024 All Rights Reserved</h4>
    <p>Developed by: Star </p>
    <p>For inquiries: <a href="mailto:contact@domain.com">contact@domain.com</a></p>
   
    <p>Powered by: Student Class Attendance Management System</p>
</div>

    </div>
    
</body>

</html>
