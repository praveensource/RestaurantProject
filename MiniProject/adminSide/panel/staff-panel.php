<?php include '../inc/dashHeader.php'; ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 1300px; padding-left: 200px; padding-top: 20px  }
    </style>
<div class="wrapper">
    <div class="container-fluid pt-5 pl-600">
        <div class="row">
            <div class="m-50">
                <div class="mt-5 mb-3">
                    <h2 class="pull-left">Staff Details</h2>
                    <a href="../staffCrud/createStaff.php" class="btn btn-outline-dark"><i class="fa fa-plus"></i> Add Staff</a>
                </div>
                <div class="mb-3">
                    <h2 class="pull-left">Search Staff</h2>
                    <form method="POST" action="#">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" id="search" name="search" class="form-control" placeholder="Enter Staff Name or ID">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-light">Search</button>
                            </div>
                            <div class="col-md-3">
                                <a href="staff-panel.php" class="btn btn-info">Show All</a>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                // Include config file
                require_once "../config.php";

                if (isset($_POST['search'])) {
                    if (!empty($_POST['search'])) {
                        $search = $_POST['search'];
                        $sql = "SELECT * FROM Staffs WHERE staff_name LIKE '%$search%' OR staff_id = '$search'ORDER BY staff_id";
                    } else {
                        $sql = "SELECT * FROM Staffs ORDER BY staff_id";
                    }
                } else {
                    // Default query to fetch all reservations
                    $sql = "SELECT * FROM Staffs ORDER BY staff_id;";
                }               

                if ($result = mysqli_query($link, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        echo '<table class="table table-bordered table-striped">';
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>ID</th>";
                        echo "<th>Staff Name</th>";
                        echo "<th>Role</th>";
                        echo "<th>Account ID</th>";
                        //echo "<th>Phone Number</th>";
                        echo "<th>Delete</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['staff_id'] . "</td>";
                            echo "<td>" . $row['staff_name'] . "</td>";
                            echo "<td>" . $row['role'] . "</td>";
                            echo "<td>" . $row['account_id'] . "</td>";
                            //echo "<td>" . $row['phone_number'] . "</td>";
                            echo "<td>";
                            echo '<a href="../staffCrud/delete_staff.php?id=' . $row['staff_id'] . '" title="Delete Record" data-toggle="tooltip" onclick="return confirm(\'Are you sure you want to delete this staff?\')"><span class="fa fa-trash text-black"></span></a>';
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        // Free result set
                        mysqli_free_result($result);
                    } else {
                        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close connection
                mysqli_close($link);
                ?>
            </div>
        </div>
    </div>
</div>

<?php include '../inc/dashFooter.php'; ?>
