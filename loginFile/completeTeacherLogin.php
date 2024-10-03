<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "../inc/databaseConnection.php";
    include "../inc/formValidation.php";
    include "../inc/checkingLoginStatus.php";
    
    // Sanitize and validate form data
    $userId = validateFormData($_POST["userId"]);
    $instituteCode = validateFormData($_POST["instituteCode"]);
    $password = validateFormData($_POST["password"]);
    
    // The database and table information
    $database = "login_info";
    $table = "teacher_login";
    
    // Check login status
    $flag = checkUserLoginStatus($conn, $database, $table, $userId, $instituteCode, $password);
    
    if ($flag == 1) {
        $conn->close();
        echo "<script>alert('Successfully Logged In');</script>";
        
        // Start session and set login status
        session_start();
        $_SESSION["teacherStatus"] = true;
        $_SESSION["userId"] = $userId;
        $_SESSION["instituteCode"] = $instituteCode;
        
        // Redirect to teacher's home page
        echo "<script>window.location.href='../homeFile/teacherHome.php';</script>";
        die();
    } elseif ($flag == 2) {
        $conn->close();
        echo "<script>alert('Incorrect Password or UserId or Institute Code, try again');</script>";
        echo "<script>window.location.href='teacherLogin.php';</script>";
        die();
    } else {
        $conn->close();
        echo "<script>alert('Error Occurred');</script>";
        echo "<script>window.location.href='teacherLogin.php';</script>";
        die();
    }
} else {
    header("Location: ../index.php");
    exit();
}
