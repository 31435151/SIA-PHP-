<link rel="stylesheet" type="text/css" href="./style/AdminShowUser.css">
<?php
    include "AdminSidebar.php";
    // Establish a connection to the database server (MySQL)
    $con = mysqli_connect("127.0.0.1", "root", "root", "EastWestB");
    // Check if the connection was successful
    if (mysqli_connect_errno()) {
        die("Failed to connect to MySQL: " . mysqli_connect_error());
    }
    // Query the database to retrieve all records from the user_tbl table
    $result = mysqli_query($con, "SELECT * FROM user_tbl");
    // Loop through the result set and display each record
    if (mysqli_num_rows($result) > 0) {
        $table = '<div id="UA-Table">
        <table id="UA-TableItself" border="1">
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
                    <button type="button" id="UA-EditBtn" class="UA-EditBtn"   data-id="' . $row['id'] . '">Edit</button>
                    <button id="UA-DeleteBtn" class="UA-DeleteBtn" data-id="' .$row['id']. '">Delete</button>
                </td>
            </tr>';
        }
        $table .= '</table></div>';
    echo $table;
    }
    // Close the database connection
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
if (isset($_POST['delete']) && $_POST['delete'] === 'true' && isset($_POST['id'])) {
    // Delete the record if the delete request is submitted
    $id = $_POST['id'];
    // Prepare the delete query
    $stmt = mysqli_prepare($con, "DELETE FROM user_tbl WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    // Execute the delete query
    if (mysqli_stmt_execute($stmt)) {
        echo "The record was successfully deleted";
        header("Location: AdminShowUser.php");
        exit;
    } else {
        die('Could not delete record: ' . mysqli_error($con));
    }
    mysqli_stmt_close($stmt);
}
?>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <!-- Modal -->
   <!-- Modal -->
<div id="UA" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div id="UA-container">
            <div id="UA-Header">
                <h1 class="modal-title" id="exampleModalLabel">Edit</h1>
            </div>
            
            <div id="UA-Body">
                <form method="post" action="AdminUpdateAccount.php" id="UA-Form">
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
                    <div class="mb-3">
                      <label for="edit_accountType" class="col-form-label">Account Type</label>
                      <select name="edit_accountType" id="edit_accountType" class="form-control">
                          <option value="Saving">Saving</option>
                          <option value="Joint">Joint</option>
                          <option value="Checking">Checking</option>
                          <option value="Business">Business</option>
                      </select>
                  </div>
                    <div class="mb-3">
                        <label for="edit_amount" class="col-form-label">Amount</label>
                        <input type="text" name="edit_amount" id="edit_amount" class="form-control" placeholder="Amount">
                    </div>
                </form>
            </div>
            
            <div id="UA-Footer">
                <button type="button" id="UA-CloseBtn"  data-bs-dismiss="modal">Close</button>
                <button type="submit" id="UA-SaveBtn" form="UA-Form" name="submit">Save changes</button>
            </div>
        </div>
</div>
<script>
    $(document).ready(function() {
        $('.UA-EditBtn').on('click', function() {
            var tr = $(this).closest('tr');
            var id = tr.find('td:eq(0)').text();
            var name = tr.find('td:eq(1)').text();
            var address = tr.find('td:eq(2)').text();
            var email = tr.find('td:eq(3)').text();
            var username = tr.find('td:eq(4)').text();
            var password = tr.find('td:eq(5)').text();
            var accountType = tr.find('td:eq(6)').text();
            var amount = tr.find('td:eq(7)').text();

            $('#edit_id').val(id);
            $('#edit_name').val(name);
            $('#edit_address').val(address);
            $('#edit_email').val(email);
            $('#edit_username').val(username);
            $('#edit_password').val(password);
            $('#edit_accountType').val(accountType);
            $('#edit_amount').val(amount);


            $("#UA").show();
            $("table").hide();

            $("#editModal").hide();
        });
        
        $('.UA-DeleteBtn').on('click', function() {
            var tr = $(this).closest('tr');
            var id = tr.find('td:eq(0)').text();
            
            // Show confirmation dialog before deleting
            if (confirm("Are you sure you want to delete this record?")) {
                // Send AJAX request to delete.php
                $.ajax({
                    url: 'delete.php',
                    method: 'POST',
                    data: {
                        delete: 'true',
                        id: id
                    },
                    success: function(response) {
                        if (response === 'success') {
                            // Reload the page after successful deletion
                            location.reload();
                        } else {
                            alert('Failed to delete the record');
                        }
                    },
                    error: function() {
                        alert('An error occurred while deleting the record');
                    }
                });
            }
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
