<?php
require_once './dbcon.php';
session_start();

if (isset($_POST['registration'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    $file = $_FILES['image']['name'];
    $file = explode('.', $file);
    $file_ext = end($file);
    $file_name = $username . '.' . $file_ext;


    $input_error = array();

    if (empty($name)) {
        $input_error['name'] = 'The name field is requird';
    }
    if (empty($email)) {
        $input_error['email'] = 'The email field is requird';
    }
    if (empty($username)) {
        $input_error['username'] = 'The username field is requird';
    }
    if (empty($password)) {
        $input_error['password'] = 'The password field is requird';
    }
    if (empty($confirmpassword)) {
        $input_error['confirmpassword'] = 'The confirmpassword field is requird';
    }

    if (count($input_error) == 0) {
        $email_check = mysqli_query($conn, "SELECT * FROM `users` WHERE `email`= '$email'");
        if (mysqli_num_rows($email_check) == 0) {
            $username_check = mysqli_query($conn, "SELECT * FROM `users` WHERE `username`= '$username'");
            if (mysqli_num_rows($username_check) == 0) {
                if (strlen($username) < 15) {
                    if (strlen($password) >= 8) {
                        if ($confirmpassword == $password) {
                            $row_check = mysqli_query($conn, "SELECT * FROM `users`");
                            if (mysqli_num_rows($row_check) == 0) {
                                $password = md5($password);
                                $query = "INSERT INTO `users`(`name`, `email`, `password`, `username`, `image`, `status`) VALUES ('$name','$email','$password','$username','$file_name','active')";
                                $result = mysqli_query($conn, $query);
                                if ($result) {
                                    $_SESSION['data_insert_success'] = 'Data Insetr Success!';
                                    move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $file_name);
                                    header('location: registration.php');
                                } else {
                                    $_SESSION['data_insert_error'] = 'Data Insetr Error!';
                                }
                            } else {
                                $password = md5($password);
                                $query = "INSERT INTO `users`(`name`, `email`, `password`, `username`, `image`, `status`) VALUES ('$name','$email','$password','$username','$file_name','inactive')";
                                $result = mysqli_query($conn, $query);
                                if ($result) {
                                    $_SESSION['data_insert_success'] = 'Data Insetr Success!';
                                    move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $file_name);
                                    header('location: registration.php');
                                } else {
                                    $_SESSION['data_insert_error'] = 'Data Insetr Error!';
                                }
                            }
                        } else {
                            $confirmpassword_match = 'Confirmpassword Dosent Match';
                        }
                    } else {
                        $password_len = "Password less than 8 Charecter";
                    }
                } else {
                    $username_len = 'This User Name More Than 10 Charecter';
                }
            } else {
                $username_error = "This Username Already Exists";
            }
        } else {
            $email_error = "This Email Address Already Exists";
        }
    }

    // print_r($input_error);
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
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>User Registration Form</h1>
        <?php if (isset($_SESSION['data_insert_success'])) {
            echo '<div class="alert alert-success">' . $_SESSION['data_insert_success'] . '</div>';
        }  ?>
        <?php if (isset($_SESSION['data_insert_error'])) {
            echo '<div class="alert alert-warning">' . $_SESSION['data_insert_error'] . '</div>';
        } ?>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group">
                        <label for="name" class="control-label col-sm-1">Name</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" id="name" name="name" value="<?= isset($name) ? $name : '' ?>" placeholder="Enter your name">
                        </div>
                        <label for="" class="error">
                            <?php if (isset($input_error['name'])) {
                                echo $input_error['name'];
                            } ?>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label col-sm-1">Email</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="email" id="email" name="email" value="<?php if (isset($email)) {
                                                                                                        echo $email;
                                                                                                    } ?>" placeholder="Enter your email">
                        </div>
                        <label for="" class="error">
                            <?php if (isset($input_error['email'])) {
                                echo $input_error['email'];
                            } ?>
                        </label>
                        <label for="" class="error">
                            <?php if (isset($email_error)) {
                                echo $email_error;
                            } ?>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="username" class="control-label col-sm-1">Username</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" id="username" name="username" value="<?php if (isset($username)) {
                                                                                                                echo $username;
                                                                                                            } ?>" placeholder="Enter your username">
                        </div>
                        <label for="" class="error">
                            <?php if (isset($input_error['username'])) {
                                echo $input_error['username'];
                            } ?>
                        </label>
                        <label for="" class="error">
                            <?php if (isset($username_error)) {
                                echo $username_error;
                            } ?>
                        </label>
                        <label for="" class="error">
                            <?php if (isset($username_len)) {
                                echo $username_len;
                            } ?>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label col-sm-1">Password</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="password" id="password" name="password" value="<?php if (isset($password)) {
                                                                                                                    echo $password;
                                                                                                                } ?>" placeholder="Enter your password">
                        </div>
                        <label for="" class="error">
                            <?php if (isset($input_error['password'])) {
                                echo $input_error['password'];
                            } ?>
                        </label>
                        <label for="" class="error">
                            <?php if (isset($password_len)) {
                                echo $password_len;
                            } ?>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="confirmpassword" class="control-label col-sm-1">Confirm Password</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="confirmpassword" id="confirmpassword" name="confirmpassword" value="<?php if (isset($confirmpassword)) {
                                                                                                                                        echo $confirmpassword;
                                                                                                                                    } ?>" placeholder="Enter your confirm password">
                        </div>
                        <label for="" class="error">
                            <?php if (isset($input_error['confirmpassword'])) {
                                echo $input_error['confirmpassword'];
                            } ?>
                        </label>
                        <label for="" class="error">
                            <?php if (isset($confirmpassword_match)) {
                                echo $confirmpassword_match;
                            } ?>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="image" class="control-label col-sm-1">Image</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="file" id="image" name="image">
                        </div>
                    </div>
                    <div class="col-sm-4 col-sm-offset-1">
                        <input class="form-control btn btn-info" type="submit" name="registration" value="Registration">
                    </div>
                </form>
                <br>
                <br>
                <p>If you have an account? then please <a href="login.php">Login</a></p>
                <hr>
                <p>Copyright &copy; 2018 - <?= date("Y"); ?> All Right Reserved</p>
            </div>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>