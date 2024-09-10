<?php
require_once './dbcon.php';
session_start();

if (isset($_SESSION['user_login'])) {
    header('location: index.php');
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username_check = mysqli_query($conn, "SELECT * FROM `users` WHERE `username`= '$username'");
    if (mysqli_num_rows($username_check) > 0) {
        $row = mysqli_fetch_assoc($username_check);
        if ($row['password'] == md5($password)) {
            $_SESSION['user_login'] = $username;
            header('location: index.php');
            // if ($row['status'] == 'active') {
            //     $_SESSION['user_login'] = $username;
            //     header('location: index.php');
            // } else {
            //     $status_inactive = 'Your status is inactive!';
            // }
        } else {
            $wrong_password = 'Password does not match!';
        }
    } else {
        $username_not_found = 'This email not found!';
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Student Management System</title>

    <!-- Bootstrap -->
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container animated shake">
        <h1 class="text-center">Student Management System</h1>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <h2 class="text-center">Admin Login Form</h2>
                <form action="login.php" method="POST">
                    <div>
                        <input type="text" class="form-control" require name="username" value="<?php if (isset($username)) {
                                                                                                    echo $username;
                                                                                                } ?>" placeholder="Username">
                    </div>
                    <div>
                        <input type="password" class="form-control" require name="password" placeholder="Password">
                    </div>
                    <br>
                    <div>
                        <input type="submit" name="login" value="login" class="btn btn-info pull-right">
                    </div>
                </form>
            </div>
        </div>
        <br>
        <?php
        if (isset($username_not_found)) {
            echo '<div class="alert alert-danger col-sm-4 col-sm-offset-4">' . $username_not_found . '</div>';
        }
        if (isset($wrong_password)) {
            echo '<div class="alert alert-danger col-sm-4 col-sm-offset-4">' . $wrong_password . '</div>';
        }
        if (isset($status_inactive)) {
            echo '<div class="alert alert-danger col-sm-4 col-sm-offset-4">' . $status_inactive . '</div>';
        }
        ?>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>