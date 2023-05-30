<?php
// delete.php

// Establish a connection to the database server (MySQL)
$con = mysqli_connect("127.0.0.1", "root", "root", "EastWestB");

// Check if the connection was successful
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// Check if the delete request is submitted
if (isset($_POST['delete']) && $_POST['delete'] === 'true' && isset($_POST['id'])) {
    
    // Prepare the delete query
    $stmt = mysqli_prepare($con, "DELETE FROM user_tbl WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $_POST['id']);
    
    // Execute the delete query
    if (mysqli_stmt_execute($stmt)) {
        // Return a success response
        echo "success";
    } else {
        // Return an error response
        echo "error";
    }
    
    mysqli_stmt_close($stmt);
} else {
    // Invalid delete request
    echo "Invalid request";
}

// Close the database connection
mysqli_close($con);
?>
