<?php
if (!defined('ALLOWED_ACCESS')) {
    die('Direct access not allowed');
}

include __DIR__ . '/../../Backend/DB.php';

// 🔥 id index.php se aa rahi hai
$upd = $id ?? null;

if ($upd === null) {
    die("Invalid student ID");
}

$sel = "SELECT * FROM student WHERE s_id='$upd'";
$res = $con->query($sel);

if ($res && $res->num_rows > 0) {
    $row = $res->fetch_assoc();
    // print_r($row); // debug ke liye
} else {
    die("Student not found");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form_Edit</title>
    <script src="/local-asset/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/local-asset/bootstrap.min.css">
    <link rel="stylesheet" href="../Frontend/css/Edit.css">

</head>
<body>
    <div class="container-bg">
        <?php
        $nav = new Navbar();
        $nav->showNavbar();
        ?>
        <div class="container border border-2 border-blue rounded p-4 custom-bg mt-5" style="width: 800px;">

            <h2 style="text-align: center; font-family: Arial, sans-serif; text-shadow: 0 0 10px rgba(0, 195, 255, 1); ">ADDMISSION CORRECTION FORM</h2>

            <form action="/tution_p/Backend/Update.php" method="post" enctype="multipart/form-data">
                <!-- student table hidden id  -->
                <input type="hidden" name="id" id="" value="<?= $row['s_id'] ?>"> 
                <div class="mb-3 mt-5">
                    <label for="stname" class="form-lebel">Student Name :</label>
                    <input type="text" name="stname" id="" class="form-control" value="<?=$row['name'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="stgaurdian" class="form-lebel">Guardian Name :</label>
                    <input type="text" name="stguardian" id="" class="form-control" value="<?=$row['g_name'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="stgaurdian" class="form-lebel">Address :</label>
                    <textarea class="form-control" id="" rows="2" name="address"><?=$row['address'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender :</label><br>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="stgender" id="male" class="form-check-input" <?php if($row['gender']=='male'){echo "checked";} ?> value="male" value="male">
                        <label for="Male" class="form-check-label">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="stgender" id="female" class="form-check-input" <?php if($row['gender']=='female'){echo "checked";} ?> value="male" value="female">
                        <label for="Female" class="form-check-label">Female</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="class" class="form-lebel">Select class :</label>
                    <select name="stclass" id="" class="form-select" required>
                        <option <?php if($row['class']=="") {echo "selected"; } ?> value="">-Select-</option>
                        <option <?php if($row['class']=="Class-1") {echo "selected"; } ?> value="Class-1">Class - 1</option>
                        <option <?php if($row['class']=="Class-2") {echo "selected"; } ?> value="Class-2">Class - 2</option>
                        <option <?php if($row['class']=="Class-3") {echo "selected"; } ?> value="Class-3">Class - 3</option>
                        <option <?php if($row['class']=="Class-4") {echo "selected"; } ?> value="Class-4">Class - 4</option>
                        <option <?php if($row['class']=="Class-5") {echo "selected"; } ?> value="Class-5">Class - 5</option>
                        <option <?php if($row['class']=="Class-6") {echo "selected"; } ?> value="Class-6">Class - 6</option>
                        <option <?php if($row['class']=="Class-7") {echo "selected"; } ?> value="Class-7">Class - 7</option>
                        <option <?php if($row['class']=="Class-8") {echo "selected"; } ?> value="Class-8">Class - 8</option>
                        <option <?php if($row['class']=="Class-9") {echo "selected"; } ?> value="Class-9">Class - 9</option>
                        <option <?php if($row['class']=="Class-10") {echo "selected"; } ?> value="Class-10">Class - 10</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="Phone Nomber" class="form-lebel">Enter Mobile Nomber :</label>
                    <input type="number" name="stnumber" id="" class="form-control" value="<?= $row['mobile_no'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="stdate" class="form-lebel">Admission Date :</label>
                    <input type="date" name="stdate" id="" class="form-control" value="<?= $row['addmission_date']?>" required>
                </div>
                <div class="mb-3">
                    <label for="st picture" class="form-lebel">Student image :</label><br>

                    <!-- Old image preview -->
                    <?php if(!empty($row['image'])) { ?>
                    <img src="../student_img/<?= $row['image'] ?>" alt="profile" height="100px" width="100px"><br>
                    <?php } ?>

                    <input type="file" name="stimage" id="stimage" class="form-control mt-2">
                    <!-- hidden field to store old image name -->
                    <input type="hidden" name="old_image" value="<?= $row['image'] ?>">
                </div>
                <div class="mb-3" style="text-align: center;">
                    <input class="btn btn-primary btn-lg btn-block" type="submit" name="save" value="save">
                </div>
            </form>
        </div>
    </div>
</body>
</html>