<?php
session_start();
if (($_SESSION['postAdmin']) != "admin"){
  header("location: Error.php");
};
?>
 <script>
    function goDashboard(){
      window.location.replace('AdminDashboard.php');
    }
  </script>
<html>
<head>
  <title>EastWest Bank Login</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="./style/AdminSidebar.css">
  <link rel="stylesheet" type="text/css" href="./style/UserSidebar.css">
</head>
<body>

<div id="USB">
  <div id="USB-imagecontainer" onclick="goDashboard()"  style=" display: flex; justify-content: center; align-content: center;">
              <img id="USB-logo" alt="logo" src="./images/EWfull.png" style="width: 10vh; height: 10vh ;"/>
              </div>
    <a id="USB-home" style="background-color: #542785;" href="#home">Home</a>
    <a href="AdminDashboard.php">Dashboard</a>
    <div id="USB-ContainerDropdown">
      <button id="USB-DropdownBtn">Account Management</button>
      <div id="USB-ContainerDropdownBtn">
        <a  href="AdminCreate.php">Create Account</a>
        <a href="AdminShowUser.php">Manage Account</a>
      </div>
    </div>
    <a href="AdminDashboard.php">Transaction</a>
    <a href="#">Settings</a>
    <a id="USB-LogoutBtn" href="Logout.php">Logout</a>
    </div>
  </div>
</body>
</html>