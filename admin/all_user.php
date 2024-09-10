<?php
require_once './dbcon.php';

$username = $_SESSION['user_login'];
$get_data = mysqli_query($conn, "SELECT `status` FROM `users` WHERE `username`='$username'");
$status_data = mysqli_fetch_assoc($get_data);
$data = $status_data['status'];
// print_r($data['status']);
if ($data == 'active') {
} else {
    header('location: index.php');
}
?>

<div class="table-responsive">
    <table id="exampl" class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>User Name</th>
                <th>Photo</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $db_sinfo = mysqli_query($conn, "SELECT * FROM `users`");
            while ($row = mysqli_fetch_assoc($db_sinfo)) {
            ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= ucwords($row['name']) ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['username'] ?></td>
                    <td><img style="width: 100px;" src="images/<?= $row['image'] ?>" alt=""></td>
                    <td>
                        <?php
                        $action_data = $row['status'];
                        if ($action_data == 'active') {
                        ?>
                            <a href="inactive_user.php?id=<?= base64_encode($row['id']) ?>" class="btn btn-xs btn-primary"><i class=" fa fa-pencil"></i> Inactive</a>
                        <?php
                        } else {
                        ?>
                            <a href="active_user.php?id=<?= base64_encode($row['id']) ?>" class="btn btn-xs btn-info"><i class=" fa fa-pencil"></i> Active</a>
                        <?php
                        }
                        ?>
                        <a href="delete_user.php?id=<?= base64_encode($row['id']) ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                    </td>
                </tr>
            <?php
            }

            ?>

        </tbody>
    </table>
</div>