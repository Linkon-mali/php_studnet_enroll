<?php
require_once './dbcon.php';

if (!isset($_SESSION['user_login'])) {
    header('location: login.php');
}
?>

<?php
$id = base64_decode($_GET['id']);
$db_data = mysqli_query($conn, "SELECT * FROM `student_info` WHERE `id` = $id");
$db_row = mysqli_fetch_assoc($db_data);

?>
<?php
if (isset($_POST['update_student'])) {
    $name = $_POST['name'];
    $roll = $_POST['roll'];
    $class = $_POST['class'];
    $city = $_POST['city'];
    $pcontact = $_POST['pcontact'];

    $query = "UPDATE `student_info` SET `name`='$name',`roll`='$roll',`class`='$class',`city`='$city',`pcontact`='$pcontact' WHERE `id`=$id";

    $result = mysqli_query($conn, $query);
    if ($result) {
        header('location: index.php?page=all_student');
    }
}
?>

<div class="row">
    <div class="col-sm-6">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Student Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= $db_row['name'] ?>" required="">
            </div>
            <div class="form-group">
                <label for="roll">Student Roll</label>
                <input type="text" name="roll" id="roll" class="form-control" value="<?= $db_row['roll'] ?>" pattern="[0-9]{6}" required="">
            </div>
            <div class="form-group">
                <label for="class">Student Class</label>
                <select name="class" id="class" class="form-control" required="">
                    <option value="">Select</option>
                    <option <?php echo $db_row['class'] == '1st' ? 'selected' : '' ?> value="1st">1st</option>
                    <option <?php echo $db_row['class'] == '2nd' ? 'selected' : '' ?> value="2nd">2nd</option>
                    <option <?php echo $db_row['class'] == '3rd' ? 'selected' : '' ?> value="3rd">3rd</option>
                    <option <?php echo $db_row['class'] == '4th' ? 'selected' : '' ?> value="4th">4th</option>
                    <option <?php echo $db_row['class'] == '5th' ? 'selected' : '' ?> value="5th">5th</option>
                </select>
            </div>
            <div class="form-group">
                <label for="city">Student City</label>
                <input type="text" name="city" id="city" class="form-control" value="<?= ucwords($db_row['city']) ?>" required="">
            </div>
            <div class="form-group">
                <label for="pcontact">Parets Contact</label>
                <input type="text" name="pcontact" id="pcontact" class="form-control" value="<?= $db_row['pcontact'] ?>" pattern="01[5|6|7|9][0-9]{8}" required="">
            </div>
            <div class="form-group">
                <input type="submit" name="update_student" value="Add Student" class="btn btn-primary pull-right">
            </div>
        </form>
    </div>
</div>