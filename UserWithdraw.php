<?php
include "UserSidebar.php";
if (!isset($_SESSION['id'])) {
    header("Location: UserAccount.php");
    exit;
}
$con = mysqli_connect("127.0.0.1", "root", "root", "EastWestB");
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}
$id = $_SESSION['id'];
$query = "SELECT * FROM user_tbl WHERE id = $id";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
?>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="./style/UserDeposit.css">
    </head>
    <body>
        <div id="UDEP">
            <div id="UDEP-Whole">
            <div id="UDEP-Title">
                <h1 id="asd">Withdraw</h1>
            </div>
            <form id="UDEP-Form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <h1>Initial Deposit: </h1>
                <h1>
                <?php
                echo $row['amount'];
                ?>
                </h1>
                <div id="UDEP-Container">
                <label for="UDEP-NewAmount" id="UDEP-NewAmountTxt" >Amount</label>
                <input id="UDEP-NewAmount" require type="number" name="amount" size="50" placeholder="Please Enter Amount">

                <button id="UDEP-DepositBtn" type="submit" value="Submit" name="create">Withdraw</button>
                </div>
            </form>
            </div>
        </div>
    </body>
</html>
<?php
if(isset($_POST['create'])){
    if(!empty($_POST['amount'])){
        $con = mysqli_connect("127.0.0.1", "root", "root", "EastWestB");
        if(mysqli_connect_errno()){
            die('Could not connect: ' . mysqli_connect_error());
        }
            $newAmount =  $row['amount'] - $_POST['amount'];
   
        $stmt = mysqli_prepare($con, "UPDATE user_tbl SET amount=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "ss",  $newAmount, $row['id']);
        if(mysqli_stmt_execute($stmt)){
            echo "The deposit was successfully saved!";
            header("Location: UserDashboard.php");
            exit();
        }else{
            die('Could not insert record: ' . mysqli_error($con));
        }
        mysqli_stmt_close($stmt);
        mysqli_close($con);
    }else {
        echo "Please add an amount";
    }
} 
