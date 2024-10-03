function checkUserLoginStatus($conn, $database, $table, $userId, $instituteCode, $password) {
    // Switch to the provided database
    $sql = "USE $database";
    if ($conn->query($sql) !== TRUE) return -1;  // If there's an error using the database, return -1

    // Query to select the hashed password from the table based on userId and instituteCode
    $sql = "SELECT password FROM $table WHERE InstituteCode='$instituteCode' AND userId='$userId'";

    $flag = false;  // Flag to track if login is successful
    $result = $conn->query($sql);
    
    if (!$result) return -1;  // If query fails, return -1

    // If query returns results
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Use password_verify to check the provided password against the hashed password in the database
            if (password_verify($password, $row["password"])) {
                $flag = true;
                break;
            }
        }
    }

    // Return 1 for successful login, 2 for incorrect login details
    return $flag ? 1 : 2;
}
