<?php
function checkInstituteLoginStatus($conn, $database, $table, $instituteCode, $password) {
    // Use the provided database
    $sql = "USE $database";
    if ($conn->query($sql) !== TRUE) {
        error_log("Error selecting database: " . $conn->error);
        return -1;
    }

    // Use prepared statements to avoid SQL injection
    $sql = "SELECT password FROM $table WHERE InstituteCode = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        error_log("Error preparing statement: " . $conn->error);
        return -1;
    }
    
    $stmt->bind_param("s", $instituteCode);  // Bind the variable for InstituteCode
    $stmt->execute();  // Execute the statement
    $result = $stmt->get_result();

    // Check if a matching row exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            return 1;  // Correct password
        }
    }
    
    return 2;  // Incorrect password
}

function checkUserLoginStatus($conn, $database, $table, $userId, $instituteCode, $password) {
    // Use the provided database
    $sql = "USE $database";
    if ($conn->query($sql) !== TRUE) {
        error_log("Error selecting database: " . $conn->error);
        return -1;
    }

    // Use prepared statements to avoid SQL injection
    $sql = "SELECT password FROM $table WHERE InstituteCode = ? AND userId = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        error_log("Error preparing statement: " . $conn->error);
        return -1;
    }

    $stmt->bind_param("ss", $instituteCode, $userId);  // Bind the variables for InstituteCode and UserId
    $stmt->execute();  // Execute the statement
    $result = $stmt->get_result();

    // Check if a matching row exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            return 1;  // Correct password
        }
    }
    
    return 2;  // Incorrect password
}
