<?php
require_once './dbcon.php';

if (!isset($_SESSION['user_login'])) {
    header('location: login.php');
}
?>

<?php
if (isset($_POST['add_student'])) {
    $name = $_POST['name'];
    $roll = $_POST['roll'];
    $class = $_POST['class'];
    $city = $_POST['city'];
    $pcontact = $_POST['pcontact'];

    $file = $_FILES['image']['name'];
    $file = explode('.', $file);
    $file_ext = end($file);
    $image_name = $roll . '.' . $file_ext;

    $query = "INSERT INTO `student_info`(`name`, `roll`, `class`, `city`, `pcontact`, `image`) VALUES ('$name','$roll','$class','$city','$pcontact','$image_name')";

    $result = mysqli_query($conn, $query);
    if ($result) {
        $success = 'Data Insetr Success!';
        move_uploaded_file($_FILES['image']['tmp_name'], 'student_image/' . $image_name);
        // header('location: registration.php');
    } else {
        $error = 'Data Insetr Error!';
    }
}

?>

<div class="row">
    <?php
    if (isset($success)) {
        echo '<p class="alert alert-success col-sm-6">' . $success . '</p>';
    }
    if (isset($error)) {
        echo '<p class="alert alert-danger col-sm-6">' . $error . '</p>';
    }
    ?>
</div>
<div class="row">
    <div class="col-sm-6">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Student Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Student Name" required="">
            </div>
            <div class="form-group">
                <label for="roll">Student Roll</label>
                <input type="text" name="roll" id="roll" class="form-control" placeholder="Student Roll" pattern="[0-9]{6}" required="">
            </div>
            <div class="form-group">
                <label for="class">Student Class</label>
                <select name="class" id="class" class="form-control" required="">
                    <option value="">Select</option>
                    <option value="1st">1st</option>
                    <option value="2nd">2nd</option>
                    <option value="3rd">3rd</option>
                    <option value="4th">4th</option>
                    <option value="5th">5th</option>
                </select>
            </div>
            <div class="form-group">
                <label for="city">Student City</label>
                <input type="text" name="city" id="city" class="form-control" placeholder="Student City" required="">
            </div>
            <div class="form-group">
                <label for="pcontact">Parets Contact</label>
                <input type="text" name="pcontact" id="pcontact" class="form-control" placeholder="01******" pattern="01[5|6|7|9][0-9]{8}" required="">
            </div>
            <div class="form-group">
                <label for="image">Student Image</label>
                <input type="file" name="image" id="image" class="form-control" required="">
            </div>
            <div class="form-group">
                <input type="submit" name="add_student" value="Add Student" class="btn btn-primary pull-right">
            </div>
        </form>
    </div>
</div>