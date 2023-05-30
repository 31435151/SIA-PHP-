<link rel="stylesheet" type="text/css" href="./style/UserAccount.css">
<?php
    include "UserSidebar.php";
if (!isset($_SESSION['id'])) {
    // Redirect to the login page or display an error message
    header("Location: UserAccount.php");
    exit;
}

// Establish a connection to the database server (MySQL)
$con = mysqli_connect("127.0.0.1", "root", "root", "EastWestB");

// Check if the connection was successful
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

$id = $_SESSION['id'];

// Query the database to retrieve the records of the logged-in user
$query = "SELECT * FROM user_tbl WHERE id = $id";
$result = mysqli_query($con, $query);

// Display the user's data in a table
if (mysqli_num_rows($result) > 0) {
    $table = '
    <div id="UA-Table"><table id="UA-TableItself" border=1>
        <tr id="UA-TableHead">
            <th>Index</th>
            <th>Name</th>
            <th>Address</th>
            <th>Email Address</th>
            <th>Username</th>
            <th>Password</th>
            <th>Account Type</th>
            <th>Amount</th>
            <th>Date Created</th>
            <th>Actions</th>
        </tr>';

    while ($row = mysqli_fetch_array($result)) {
        $table .='
        <tr>
            <td>' . $row['id'] . '</td>
            <td>' . $row['name'] . '</td>
            <td>' . $row['address'] . '</td>
            <td>' . $row['email'] . '</td>
            <td>' . $row['username'] . '</td>       
            <td>' . $row['password'] . '</td>
            <td>' . $row['accountType'] . '</td>
            <td>' . $row['amount'] . '</td>
            <td>' . $row['datecreated'] . '</td>
            <td>
                <button type="button" id="UA-EditBtn" data-id="' . $row['id'] . '">Edit</button>
            </td>
        </tr>';
    }
    $table .= '</table></div>';
    echo $table;
}

mysqli_close($con);
?>

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
    if (!empty($_POST['edit_name']) && !empty($_POST['edit_address']) && !empty($_POST['edit_email']) && !empty($_POST['edit_username']) && !empty($_POST['edit_password']) ) {

        // Prepare the query
        $stmt = mysqli_prepare($con, "UPDATE user_tbl SET name=?, address=?, email=?, username=?, password=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "sssssi", $_POST['edit_name'], $_POST['edit_address'], $_POST['edit_email'], $_POST['edit_username'], $_POST['edit_password'], $_POST['edit_id']);

        // Execute the query
        if(mysqli_stmt_execute($stmt)){
            header("Location: UserAccount.php");
            exit;
        }
        else{   
            die('Could not update record: ' . mysqli_error($con));
        }
        mysqli_stmt_close($stmt);
        mysqli_close($con);
    }
    else{
        echo "All fields must have a value!";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
         <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" type="text/css" href="./style/UserAccount.css">
        <style>
            table {
                margin: 8px auto;
                text-align: center;
            }

            th {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 20px;
                background: #666;
                color: #FFF;
                padding: 2px 6px;
                border-collapse: separate;
                border: 1px solid #000;
            }

            td {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 15px;
                border: 1px solid #DDD;
            }

            .table-container {
                margin-top: 20vh;
            }
        </style>
    </head>
    <body> 
    <div id="UA"  tabindex="-1">
            <div id="UA-container">
                <div id="UA-Header">
                    <h1 class="modal-title" id="exampleModalLabel">Edit</h1>
                </div>

                <div id="UA-Body">
                    <form action="UserAccount.php" method="post" id="UA-Form">
                        <input type="hidden" name="edit_id" id="edit_id">

                        <div class="mb-3">
                            <label for="edit_name" class="col-form-label">Name</label>
                            <input type="text" name="edit_name" id="edit_name" class="form-control" placeholder="Name">
                        </div>
                        <div class="mb-3">
                            <label for="edit_address" class="col-form-label">Address</label>
                            <input type="text" name="edit_address" id="edit_address" class="form-control" placeholder="Address">
                        </div>
                        <div class="mb-3">
                            <label for="edit_email" class="col-form-label">Email</label>
                            <input type="email" name="edit_email" id="edit_email" class="form-control" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <label for="edit_username" class="col-form-label">Username</label>
                            <input type="text" name="edit_username" id="edit_username" class="form-control" placeholder="Username">
                        </div>
                        <div class="mb-3">
                            <label for="edit_password" class="col-form-label">Password</label>
                            <input type="password" name="edit_password" id="edit_password" class="form-control" placeholder="Password">
                        </div>
                      
                    </form>
                </div>
                <div id="UA-Footer">
                    <button type="button" id="UA-CloseBtn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="UA-SaveBtn" form="UA-Form" name="submit">Save changes</button>
                </div>
            </div>
    </div>

 <script>
    $(document).ready(function() {
  $("#UA-EditBtn").click(function() {
    var id = $(this).data("id");

    var tr = $(this).closest("tr");
    var name = tr.find("td:eq(1)").text();
    var address = tr.find("td:eq(2)").text();
    var email = tr.find("td:eq(3)").text();
    var username = tr.find("td:eq(4)").text();
    var password = tr.find("td:eq(5)").text();
    var accountType = tr.find("td:eq(6)").text();
    var amount = tr.find("td:eq(7)").text();

    $("#edit_id").val(id);
    $("#edit_name").val(name);
    $("#edit_address").val(address);
    $("#edit_email").val(email);
    $("#edit_username").val(username);
    $("#edit_password").val(password);
    $("#edit_accountType").val(accountType);
    $("#edit_amount").val(amount);

    $("#UA").show();
    $("table").hide();

    $("#editModal").hide();
  });
});

$(document).ready(function() {
  $("#UA-CloseBtn").click(function() {
    $("table").show();
    $("#UA").hide();
  });
});
    </script>
        </body>
</html>