<?php
require_once './dbcon.php';

$session_user = $_SESSION['user_login'];

$user_data = mysqli_query($conn, "SELECT * FROM `users` WHERE `username` = '$session_user'");
$user_row = mysqli_fetch_assoc($user_data);

?>

<div class="row">
    <div class="col-sm-6">
        <table class="table table-bordered">
            <tr>
                <td>Name</td>
                <td><?= ucwords($user_row['name']); ?></td>
            </tr>
            <tr>
                <td>User Name</td>
                <td><?= $user_row['username']; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?= $user_row['email']; ?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td><?= ucwords($user_row['status']); ?></td>
            </tr>
        </table>
        <a href="" class="btn btn-info pull-right">Edit Profile</a>
    </div>
    <div class="col-sm-6">
        <img class="img-thumbnail img-circle" src="images/<?= $user_row['image']; ?>" alt="">
        <?php
        if (isset($_POST['upload_image'])) {
            $file = $_FILES['image']['name'];
            $file = explode('.', $file);
            $file_ext = end($file);
            $file_name = $session_user . '.' . $file_ext;

            $result = mysqli_query($conn, "UPDATE `users` SET `image`='$file_name' WHERE `username` = '$session_user'");
            if ($result) {
                unlink('./images' . '/' . $user_row['image']);
                move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $file_name);
            }
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="Profile">Profile Picture</label>
            <input class="form-control" type="file" name="image" id="Profile" require>
            <input class="btn btn-sm btn-info" type="submit" name="upload_image" value="Update Image">
        </form>
    </div>
</div>