<html>
<head>
<link rel="stylesheet" type="text/css" href="./style/USerDashboard.css">
    <style>
        h1 {
            text-align: center;
            font-size: 4cm;
        }
    </style>
</head>
<body>
    <?php 
    include "UserSidebar.php";
    include "ConnectionDB.php";
    include "function.php";

    $con = mysqli_connect("127.0.0.1", "root", "root", "EastWestB");
    if(mysqli_connect_errno()){
        die('Could not connect: ' . mysqli_connect_error());
    }

    $user_data = check_login($con);
    ?>
    <div id="containerN">
        <h1>Welcome User :D</h1>
    </div>
</body>
</html>
