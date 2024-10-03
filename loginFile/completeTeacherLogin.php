<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Include necessary files for database connection, form validation, and login check
        include "../inc/databaseConnection.php";
        include "../inc/formValidation.php";
        include "../inc/checkingLoginStatus.php";

        // Sanitize and validate form input
        $userId = validateFormData($_POST["userId"]);
        $instituteCode = validateFormData($_POST["instituteCode"]);
        $password = validateFormData($_POST["password"]);

        // Define database and table
        $database = "login_info";
        $table = "teacher_login";

        // Check login status using the provided credentials
        $flag = checkUserLoginStatus($conn, $database, $table, $userId, $instituteCode, $password);

        // Based on the login status, take appropriate action
        if ($flag == 1) { // Success: Correct login credentials
            $conn->close();
            echo "<script>alert('Successfully Logged In');</script>";

            // Start session and set session variables for the logged-in user
            session_start();
            $_SESSION["teacherStatus"] = true;
            $_SESSION["userId"] = $userId;
            $_SESSION["instituteCode"] = $instituteCode;

            // Redirect to the teacher's home page
            echo "<script>window.location.href='../homeFile/teacherHome.php';</script>";
            die();
        } else if ($flag == 2) { // Incorrect credentials
            $conn->close();
            echo "<script>alert('Incorrect Password or UserId or Institute Code, try again');";
            echo "window.location.href='teacherLogin.php';</script>";
            die();
        } else { // Error occurred
            $conn->close();
            echo "<script>alert('Error Occurred');";
            echo "window.location.href='teacherLogin.php';</script>";
            die();
        }
    } else {
        // Redirect if the request method is not POST
        header("Location: ../index.php");
        exit();
    }
?>
