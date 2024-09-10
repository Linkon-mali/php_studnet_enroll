<?php
require_once './dbcon.php';

$id = base64_decode($_GET['id']);
$result = mysqli_query($conn, "UPDATE `users` SET `status`='inactive' WHERE `id`='$id'");


if ($result) {
    header('location: index.php?page=all_user');
}
