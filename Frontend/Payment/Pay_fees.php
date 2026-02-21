<?php
include __DIR__ . '/../../Backend/DB.php';
if (isset($_GET['fid']) && isset($_GET['sid'])) {
    $fid = $_GET['fid'];
    $sid = $_GET['sid'];

    // dynamic url generate 
    $from = $_GET['from'] ?? 'student';
    if ($from === 'payment') {
        $backUrl = '/tution_p/payment';
        $backText = 'Back to Payment';
    } else {
        $backUrl = '/tution_p/student';
        $backText = 'Back to Students';
    }
    // dynamic url generate 

    $sel = "SELECT s.s_id AS sid, s.name,s.image,
            f.s_id AS fid, 
            s.class AS class, 
            f.jan, f.feb, f.mar, f.apr, f.may, f.jun, f.july, f.aug, f.sept, f.oct, f.nov, f.december
            FROM student s
            LEFT JOIN fees f ON s.s_id = f.s_id
            WHERE s.s_id = '$sid'
            ORDER BY s.s_id ASC";

    $res = $con->query($sel);

    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();
    } else {
        echo "No student found";
        exit;
    }
    // print_r($row);
}
?>
<!-- html start -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay_fees</title>
    <link rel="stylesheet" href="/local-asset/bootstrap.min.css">
    <link rel="stylesheet" href="Frontend/css/Pay_fees.css">
</head>

<body>
    <div class="container-bg mt-4">
        <div class="d-flex justify-content-between align-items-center mb-1 mt-5">
            <u>
                <h3>Student Payment Details Check</h3>
            </u>
            <!-- <a href="../tution_p/student" class="btn btn-sm btn-outline-secondary">Back to Students</a> -->
            <a href="<?= $backUrl ?>" class="btn btn-sm btn-outline-secondary"> <?= $backText ?> </a>

        </div>

        <div class="container border border-2 border-blue rounded p-4 custom-bg mt-4" style="width: 750px;">

            <h2 style="text-align: center; font-family: Arial, sans-serif; ">TUTION FEES RECEIPT</h2>

            <form action="/tution_p/Backend/Pay_fees_BKD.php" method="post" enctype="multipart/form-data">

                <input type="hidden" name="fid" id="" value="<?= $row['fid'] ?>"> <!-- Hidden input passing -->
                <input type="hidden" name="sid" id="" value="<?= $row['sid'] ?>"> <!-- Hidden input passing -->
                <div class="mb-3 mt-4 d-flex justify-content-between align-items-center">
                    <h3>Student Name : <u><?= $row['name'] ?></u></h3>
                    <!-- Old image preview -->
                    <?php if (!empty($row['image'])) { ?>
                        <img src="../tution_p/student_img/<?= $row['image'] ?>" alt="profile" height="100px"
                            width="100px"><br>
                    <?php } ?>
                </div>

                <div class="mb-3">
                    <h4>Student Class : <u><?= $row['class'] ?></u></h4>
                </div>

                <div class="mb-3 mt-5">
                    <h4>Payment Date :</h4>
                    <input type="date" name="p_date" id="" class="form-control w-50" required>
                </div>

                <div class="mb-3 mt-4" id="OnlyPayment" style="">
                    <div class="mb-3">
                        <h4>Payment For :</h4>
                        <select name="month" id="month" class="form-select w-50">
                            <option value="">-Select Month-</option>
                            <?php
                            // Month array banaya
                            $months = [
                                "jan" => "January",
                                "feb" => "February",
                                "mar" => "March",
                                "apr" => "April",
                                "may" => "May",
                                "jun" => "June",
                                "july" => "July",
                                "aug" => "August",
                                "sept" => "September",
                                "oct" => "October",
                                "nov" => "November",
                                "december" => "December"
                            ];

                            // Loop through months
                            foreach ($months as $col => $monthName) {
                                if (isset($row[$col]) && $row[$col] == 0 || $row[$col] < 300) {   // only unpaid months
                                    echo "<option value='$col'>$monthName</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3 mt-4 w-25">
                        <h4>Enter Amount:</h4>
                        <input type="number" name="amount" id="" class="form-control">
                    </div>
                </div>
                <!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ -->
                <!-- Hidden Section (show only if checkbox checked) -->

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="preDue" onclick="togglePre()">
                    <label class="form-check-label" for="preDue">
                        Previous year Due only
                    </label>
                </div>
                <!-- Previous year due only -->
                <div id="predueSection" style="display:none;">
                    <div class="mb-3">
                        <h5>Enter Previous year Amount :</h5>
                        <input type="number" name="PreYearAmount" class="form-control w-75">
                    </div>
                </div>
                <!-- Previous year due only -->


                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="addMore" onclick="toggleExtra()">
                    <label class="form-check-label" for="addMore">
                        Add Additional Month Payment
                    </label>
                </div>
                <!-- Hidden Section (show only if checkbox checked) -->
                <div id="extraSection" style="display:none;">
                    <div class="mb-3">
                        <h5>Select Additional Month :</h5>
                        <select name="add_month" id="add_month" class="form-select ">
                            <option value="">-Select Additional Month-</option>
                            <?php
                            foreach ($months as $col => $monthName) {
                                echo "<option value='$col'>$monthName</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <h5>Enter Additional Amount :</h5>
                        <input type="number" name="add_amount" class="form-control w-75">
                    </div>
                </div> <!-- Hidden Section (show only if checkbox checked) -->
                <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->

                <div class="mb-3 mt-4">
                    <h5>Upload your signature :</h5>
                    <input type="file" name="rcpt_sign_new" id="" class="form-control w-50">
                </div>

                <div class="mb-3 mt-4" style="text-align: right;">
                    <input class="btn btn-secondary me-3" type="reset" value="Reset">
                    <input class="btn btn-primary " type="submit" name="submit" value="Make Payment">
                </div>
            </form>
        </div>
    </div>
</body>
<!-- js for Additional month show and hide  -->
<script src="./Frontend/Payment/Pay_fees.js">
</script>

</html>