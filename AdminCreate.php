<html>
<head>
<link rel="stylesheet" type="text/css" href="./style/AdminCreate.css">
</head>
<body>
<?php include "AdminSidebar.php"; ?>
<div id="ACT-Container">
<form id="ACT-Form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    Name: <input type="text" name="name" size="50"><br>
    Address: <input type="text" name="address" size="50"><br>
    Email: <input type="email" name="email" size="50"><br>
    Username: <input type="text" name="username" size="50"><br>
    Password: <input type="password" name="password" size="50"><br><br>
    <label for="type" class="form-label">Account Type</label>
    <select id="type" name="accountType">
        <option value="Saving">Savings</option>
        <option value="Checking">Checking</option>
        <option value="Business">Business</option>
        <option value="Joint">Joint</option>
    </select><br>
    Amount: <input type="text" name="amount" size="50"><br>
    <input id="ACT-SubmitBtn" type="submit" value="Submit" name="create">
</form>
</div>
</body>
</html>
<?php
include("function.php");

if(isset($_POST['create'])){
    // Validate Entries First
    if(!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['amount']) && !empty($_POST['accountType'])){
        // Start Saving
        // Establish a connection to the database server
        $con = mysqli_connect("127.0.0.1", "root", "root", "EastWestB");
        if(mysqli_connect_errno()){
            die('Could not connect: ' . mysqli_connect_error());
        }
        // Prepare the query
        $id = random_num(20);
        $stmt = mysqli_prepare($con, "INSERT INTO user_tbl ( name, address, email, username, password, amount, accountType, datecreated) VALUES ( ?, ?, ?, ?, ?, ?, ?, NOW())");
        mysqli_stmt_bind_param($stmt, "sssssss", $_POST['name'], $_POST['address'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['amount'], $_POST['accountType']);
        // Execute the query
        if(mysqli_stmt_execute($stmt)){
            echo "The record was successfully saved!";
            header("Location: AdminDashboard.php");
            exit();
        }else{
            die('Could not insert record: ' . mysqli_error($con));
        }
        mysqli_stmt_close($stmt);
        mysqli_close($con);
    }else {
        echo "All fields must have a value!";
    }
} 
?>