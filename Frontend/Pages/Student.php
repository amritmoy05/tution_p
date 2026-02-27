<?php
if (!defined('ALLOWED_ACCESS')) {
    http_response_code(403);
    die('Direct access are not allow. Please use the main website');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>
    <script src="/local-asset/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/local-asset/bootstrap.min.css">
    <link rel="stylesheet" href="Frontend/css/Payment.css">
</head>

<body>
    <div class="container-bg">
        <?php
        $nav = new Navbar();
        $nav->showNavbar();
        ?>
        <table class="table table-bordered mt-5 table-hover custom-table ">
            <thead>
                <tr>
                    <th>Si No</th>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Guardian Name</th>
                    <th>Class</th>
                    <th>Mobile</th>
                    <th>Addmission Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Payment details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("./Backend/DB.php");
                $sel = ("SELECT * FROM student");
                $res = $con->query($sel);
                $si = 1;
                while ($row = $res->fetch_assoc()) {
                    ?>

                    <tr>
                        <td><?= $si++; ?></td>
                        <td>
                            <?php if (!empty($row['image'])) { ?>
                                <img src="./student_img/<?= $row['image'] ?>" alt="" height="65px" width="75px">
                            <?php } else { ?>
                                None
                            <?php } ?>
                        </td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['gender'] ?></td>
                        <td><?= $row['g_name'] ?></td>
                        <td><?= $row['class'] ?></td>
                        <td><?= $row['mobile_no'] ?></td>
                        <td><?= date("d-m-Y", strtotime($row['addmission_date'])) ?></td>
                        <td><a href="edit/<?=$row['s_id'] ?>" class="link-light"><button type="button" class="btn btn-primary">Edit</button></a></td>
                        <td><a href="./Backend/delete.php?did=<?= $row['s_id'] ?>" class="link-light" onclick="return confirm('Are you sure ?');"> <button type="button" class="btn btn-danger">Del</button></a></td>
                        <td><a href="check/<?= $row['s_id'] ?>"><button type="button" class="btn btn-success">Check</button></a></td>
                    </tr>
                    
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>