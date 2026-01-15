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
    <title>Payment</title>
    <script src="/local-asset/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/local-asset/bootstrap.min.css">
    <link rel="stylesheet" href="Frontend/css/Payment.css">
</head>

<body>
    <div class="container-bg">
        <!-- <input type="hidden" name="h_id" id="" value="1">  -->
        <?php
        $nav = new Navbar();
        $nav->showNavbar();
        ?>
        
        <table class="table table-bordered mt-5 table-hover">
        <thead>
            <tr>
                <th>Si</th>
                <th class="student-name">Student</th>
                <th>Jan</th>
                <th>Feb</th>
                <th>Mar</th>
                <th>Apr</th>
                <th>May</th>
                <th>Jun</th>
                <th>Jul</th>
                <th>Aug</th>
                <th>Sep</th>
                <th>Oct</th>
                <th>Nov</th>
                <th>Dec</th>
                <th>Total</th>
                <th>Due Months</th>
                <th>Make Payment</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include __DIR__ . '/../../Backend/DB.php';
            // join query of student and fees table
             $sql = "SELECT s.s_id AS sid, s.name,
            f.s_id AS fid,  
            f.jan, f.feb, f.mar, f.apr, f.may, f.jun, f.july, f.aug, f.sept, f.oct, f.nov, f.december
            FROM student s
            LEFT JOIN fees f ON s.s_id = f.s_id
            ORDER BY s.s_id ASC";

            $res = $con->query($sql);
            $si = 1;
            $months = ['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'july', 'aug', 'sept', 'oct', 'nov', 'december'];

            while ($row = $res->fetch_assoc()) {
                $total = 0;
                $dueCount = 0;
                ?>
                <tr>
                    <td><?= $si++; ?></td>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <?php
                    foreach ($months as $m) {
                        $val = isset($row[$m]) ? (int) $row[$m] : 0;
                        if ($val > 0) {
                            echo "<td><span class='badge bg-success'>$val</span></td>";
                        } else {
                            echo "<td><span class='badge bg-danger due-badge'>Due</span></td>";
                            $dueCount++;
                        }
                        $total += $val;
                    }
                    echo "<td><b>$total</b></td>";
                    echo "<td><span class='text-danger'>{$dueCount} month(s)</span></td>";
                    ?>
                    <td><a href="/tution_p/pay_fees?fid=<?= $row['fid'] ?>&sid=<?= $row['sid'] ?>&from=payment"class="btn btn-outline-info btn-sm"> Pay Fees </a></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    </div>
</body>

</html>