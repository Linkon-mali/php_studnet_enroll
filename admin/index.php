<?php
session_start();

if (!isset($_SESSION['user_login'])) {
    header('location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Student Management System</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap.css">

    <link href="style.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">SMS</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav navbar-right">
                    <li><a href=""><i class="fa fa-users"> </i> Welcome: <?= ucwords($_SESSION['user_login']); ?></a></li>
                    <li><a href="registration.php"><i class="fa fa-plus"> </i> Add User</a></li>
                    <li><a href="index.php?page=user_profile"><i class="fa fa-user"> </i> Profile</a></li>
                    <li><a href="logout.php"><i class="fa fa-power-off"> </i> Logout</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">
                <div class="list-group">
                    <a href="index.php?page=dashboard" class="list-group-item active">
                        <i class="fa fa-dashboard"> </i> Dash Board
                    </a>
                    <a href="index.php?page=add_student" class="list-group-item"><i class="fa fa-user-plus"> </i> Add Student</a>
                    <a href="index.php?page=all_student" class="list-group-item"><i class="fa fa-user-plus"> </i> All Student</a>

                    <?php
                    require_once './dbcon.php';
                    $username = $_SESSION['user_login'];
                    $get_data = mysqli_query($conn, "SELECT `status` FROM `users` WHERE `username`='$username'");
                    $status_data = mysqli_fetch_assoc($get_data);
                    $data = $status_data['status'];
                    // print_r($data['status']);
                    if ($data == 'active') {
                    ?>
                        <a href="index.php?page=all_user" class="list-group-item"><i class="fa fa-user-plus"> </i> All Users</a>
                    <?php
                    } else {
                    ?>
                        <a href="" class="list-group-item" style="color: red;"><i class="fa fa-user-plus"> </i> You are not active user</a>
                    <?php
                    }
                    ?>

                </div>
            </div>
            <div class="col-sm-9">
                <div class="content">
                    <h1 class="text-primary"><i class="fa fa-dashboard"></i> Dashbard <small>statics view</small></h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php?page=dashboard"><i class="fa fa-dashboard"></i> Dashbard</a></li>
                    </ol>

                    <?php
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'] . '.php';
                    } else {
                        $page = 'dashboard.php';
                    }

                    if (file_exists($page)) {
                        require_once $page;
                    } else {
                        echo '<h1>Page no found</h1>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="footer">
        <p>Copyright &copy;202 Student Management System All Right Reserved</p>
    </div> -->
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap.js"></script>
<script>
    new DataTable('#example');
</script>

</html>