<?php
session_start();
if (($_SESSION['postUser']) != "user") {
  header("location: Error.php");
};
?>
<html>

<head>
  <title>EastWest Bank Login</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="./style/UserSideBar.css">

  <script>
    function goDashboard(){
      window.location.replace('UserDashboard.php');
    }
  </script>
</head>

<body>
  <div id="USB">
    <div id="USB-imagecontainer" onclick="goDashboard()" style=" display: flex; justify-content: center; align-content: center;">
      <img id="USB-logo" alt="logo" src="./images/EWfull.png" style="width: 10vh; height: 10vh ;" />
    </div>
    <a id="USB-home" style="background-color: #542785;" href="#home">Home</a>
    <a href="UserDashboard.php">Dashboard</a>
    <div id="USB-ContainerDropdown">
      <button id="USB-DropdownBtn">Transaction</button>
      <div id="USB-ContainerDropdownBtn">
        <a href="UserDeposit.php">Deposit</a>
        <a href="UserWithdraw.php">Withdraw</a>
      </div>
    </div>
    <a href="UserAccount.php?manage=1">Manage Account</a>
    <a href="#">Settings</a>
    <a id="USB-LogoutBtn" href="Logout.php">Logout</a>
  </div>
</body>

</html>