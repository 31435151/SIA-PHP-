<?php
session_start();

include "./ConnectionDB.php";
include "./function.php";

$errorMessage = ""; // Initialize the variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM user_tbl WHERE username = '$username' AND password = '$password' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo "Error: " . mysqli_error($conn);
        exit(); // Add exit() to stop executing the rest of the code
    }
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $_SESSION['id'] = $row['id']; // Store the user_id in the session

        if ($row["usertype"] == "admin") {
            $_SESSION['postAdmin'] = "admin";
            header("location: AdminDashboard.php");
            exit(); // Add exit() to stop executing the rest of the code
        } else {
            $_SESSION['postUser'] = "user";
            header("location: UserDashboard.php");
            exit(); // Add exit() to stop executing the rest of the code
        }
    } else {
        $errorMessage = 'Incorrect username or password';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>EastWest Bank Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <script>
        function clearFields() {
            document.getElementById("username").value = "";
            document.getElementById("password").value = "";
        }
    </script>
   <link rel="stylesheet" type="text/css" href="./style/Login.css">
</head>

<body>

<div id="login-container">

    <form id="login-Form" action="#" method="POST">
        <div id="login-imagecontainer">
            <img id="login-logo" alt="logo" src="./images/EWlogo.png"/>
        </div>
        <h4 id="login-Title">Login Form</h4><br/><br/>
        <?php
        if (!empty($errorMessage)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>
        <div id="login-FormGroup">
            <label for="username" class="form-label">Username</label>
            <input type="text"
                   class="form-control"
                   id="username"
                   name="username"
                   placeholder="Please enter username"
            >
        </div>
        <div id="login-FormGroup">
            <label for="password" class="form-label">Password</label>
            <input type="password"
                   class="form-control"
                   id="password"
                   name="password"
                   placeholder="Please enter password">

            <div class="d-flex justify-content-between align-items-center">
                <button type="submit" id="login-SubmitBtn" name="create">Sign In</button>
            </div>
        </div>
    </form>
</div>

</body>
</html>
