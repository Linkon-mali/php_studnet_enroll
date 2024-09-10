<?php
require_once './dbcon.php';
?>

<?php
$count_student = mysqli_query($conn, "SELECT * FROM `student_info`");
$total_student = mysqli_num_rows($count_student);

$count_users = mysqli_query($conn, "SELECT * FROM `users`");
$total_users = mysqli_num_rows($count_users);
?>

<div class="row">
    <div class="col-sm-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9">
                        <div class="pull-right" style="font-size: 45px"><?= $total_student ?></div>
                        <div class="clearfix"></div>
                        <div class="pull-right">All student</div>
                    </div>
                </div>
            </div>
            <a href="index.php?page=all_student">
                <div class="panel-footer">
                    <span class="pull-left">All Student</span>
                    <span class="pull-right">
                        <f class="fa fa-arrow-circle-o-right"></f>
                    </span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9">
                        <div class="pull-right" style="font-size: 45px"><?= $total_users ?></div>
                        <div class="clearfix"></div>
                        <div class="pull-right">All Users</div>
                    </div>
                </div>
            </div>
            <a href="index.php?page=all_user">
                <div class="panel-footer">
                    <span class="pull-left">All Users</span>
                    <span class="pull-right">
                        <f class="fa fa-arrow-circle-o-right"></f>
                    </span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9">
                        <div class="pull-right" style="font-size: 35px">YOU ARE</div>
                        <div class="clearfix"></div>
                        <div class="pull-right" style="font-size: 25px"><?= ucwords($data) ?></div>
                    </div>
                </div>
            </div>
            <a href="">
                <div class="panel-footer">
                    <span class="pull-left">User</span>
                    <span class="pull-right">
                        <f class="fa fa-arrow-circle-o-right"></f>
                    </span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<hr>
<h3>New Student</h3>
<div class="table-responsive">
    <table id="example" class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Roll</th>
                <th>City</th>
                <th>Contact</th>
                <th>Photo</th>
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
                    <td><?= $row['city'] ?></td>
                    <td><?= $row['pcontact'] ?></td>
                    <td><img style="width: 100px;" src="student_image/<?= $row['image'] ?>" alt=""></td>
                </tr>
            <?php
            }

            ?>

        </tbody>
    </table>
</div>