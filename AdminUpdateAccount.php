<?php
// Establish a connection to the database server (MySQL)
$con = mysqli_connect("127.0.0.1", "root", "root", "EastWestB");

// Check if the connection was successful
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// Update the record if the form is submitted
if (isset($_POST['submit'])) {
    // Validate Entries First
    if (!empty($_POST['edit_name']) && !empty($_POST['edit_address']) && !empty($_POST['edit_email']) && !empty($_POST['edit_username']) && !empty($_POST['edit_password']) && !empty($_POST['edit_accountType']) && !empty($_POST['edit_amount'])) {

        // Prepare the query
        $stmt = mysqli_prepare($con, "UPDATE user_tbl SET name=?, address=?, email=?, username=?, password=?, accountType=?, amount=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "sssssssi", $_POST['edit_name'], $_POST['edit_address'], $_POST['edit_email'], $_POST['edit_username'], $_POST['edit_password'], $_POST['edit_accountType'], $_POST['edit_amount'], $_POST['edit_id']);

        // Execute the query
        if (mysqli_stmt_execute($stmt)) {
            echo "The record was successfully updated";
            header("Location: AdminShowUser.php");
            exit;
        } else {
            die('Could not update record: ' . mysqli_error($con));
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "All fields must have a value!";
    }
}
?>
