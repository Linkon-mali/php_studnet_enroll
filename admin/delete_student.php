<?php
require_once './dbcon.php';

$id = base64_decode($_GET['id']);
$get_data = mysqli_query($conn, "SELECT `image` FROM `student_info` WHERE `id`='$id'");
$data = mysqli_fetch_assoc($get_data);
// print_r($data['image']);
$result = mysqli_query($conn, "DELETE FROM `student_info` WHERE `id` = $id");

if ($result) {
    unlink('./student_image' . '/' . $data['image']);

    header('location: index.php?page=all_student');
}
