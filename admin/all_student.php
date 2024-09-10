<?php
require_once './dbcon.php';
?>

<div class="table-responsive">
    <table id="example" class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Roll</th>
                <th>Class</th>
                <th>City</th>
                <th>Contact</th>
                <th>Photo</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $db_sinfo = mysqli_query($conn, "SELECT * FROM `student_info`");
            while ($row = mysqli_fetch_assoc($db_sinfo)) {
            ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= ucwords($row['name']) ?></td>
                    <td><?= $row['roll'] ?></td>
                    <td><?= $row['class'] ?></td>
                    <td><?= ucwords($row['city']) ?></td>
                    <td><?= $row['pcontact'] ?></td>
                    <td><img style="width: 100px;" src="student_image/<?= $row['image'] ?>" alt=""></td>
                    <td>
                        <a href="index.php?page=update_student&id=<?= base64_encode($row['id']) ?>" class="btn btn-xs btn-warning"><i class=" fa fa-pencil"></i> Edit</a>
                        <a href="delete_student.php?id=<?= base64_encode($row['id']) ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                    </td>
                </tr>
            <?php
            }

            ?>

        </tbody>
    </table>
</div>