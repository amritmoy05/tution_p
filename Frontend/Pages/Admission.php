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
    <title>Addimission</title>
    <script src="/local-asset/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/local-asset/bootstrap.min.css">
    <link rel="stylesheet" href="Frontend/css/Admission.css">

</head>

<body>
    <div class="container-bg">
        <?php
        $nav = new Navbar();
        $nav->showNavbar();
        ?>
        <div class="container border border-2 border-blue rounded p-4 custom-bg mt-5" style="width: 800px;">

            <h2 style="text-align: center; font-family: Arial, sans-serif; ">ADDMISSION FORM</h2>

            <form action="./Backend/Insert.php" method="post" enctype="multipart/form-data">
                <div class="mb-3 mt-5">
                    <label for="stname" class="form-lebel">Student Name :</label>
                    <input type="text" name="stname" id="" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="stgaurdian" class="form-lebel">Guardian Name :</label>
                    <input type="text" name="stguardian" id="" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="stgaurdian" class="form-lebel">Address :</label>
                    <textarea class="form-control" id="" rows="2" name="address"></textarea>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender :</label><br>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="stgender" id="male" class="form-check-input" value="male">
                        <label for="Male" class="form-check-label">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="stgender" id="female" class="form-check-input" value="female">
                        <label for="Female" class="form-check-label">Female</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="class" class="form-lebel">Select class :</label>
                    <select name="stclass" id="" class="form-select" required>
                        <option value="">-Select-</option>
                        <option value="Class-1">Class - 1</option>
                        <option value="Class-2">Class - 2</option>
                        <option value="Class-3">Class - 3</option>
                        <option value="Class-4">Class - 4</option>
                        <option value="Class-5">Class - 5</option>
                        <option value="Class-6">Class - 6</option>
                        <option value="Class-7">Class - 7</option>
                        <option value="Class-8">Class - 8</option>
                        <option value="Class-9">Class - 9</option>
                        <option value="Class-10">Class - 10</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="Phone Nomber" class="form-lebel">Enter Mobile Nomber :</label>
                    <input type="number" name="stnumber" id="" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="stdate" class="form-lebel">Admission Date :</label>
                    <input type="date" name="stdate" id="" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="st picture" class="form-lebel">Upload your image :</label>
                    <input type="file" name="stimg" id="" class="form-control">
                </div>
                <div class="mb-3" style="text-align: right;">
                    <input class="btn btn-secondary me-3" type="reset" value="Reset">
                    <input class="btn btn-primary " type="submit" name="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
</body>

</html>