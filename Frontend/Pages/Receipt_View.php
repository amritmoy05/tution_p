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
    <title>Receipt_View</title>
    <script src="/local-asset/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/local-asset/bootstrap.min.css">
    <link rel="stylesheet" href="/tution_p/Frontend/css/Receipt_View.css">
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
                </tr>
            </thead>
            <tbody>
                <?php
                include __DIR__ . '/../../Backend/DB.php';
                $sql = "SELECT s.s_id AS sid, s.name,
                r.s_id AS rid,  
                r.jan, r.feb, r.mar, r.apr, r.may, r.jun, r.july, r.aug, r.sept, r.oct, r.nov, r.december
                FROM student s
                LEFT JOIN receipt r ON s.s_id = r.s_id
                ORDER BY s.s_id ASC";

                $months = [
                    'jan' => 'jan',
                    'feb' => 'feb',
                    'mar' => 'mar',
                    'apr' => 'apr',
                    'may' => 'may',
                    'jun' => 'jun',
                    'july' => 'july',
                    'aug' => 'aug',
                    'sept' => 'sept',
                    'oct' => 'oct',
                    'nov' => 'nov',
                    'december' => 'december'
                ];

                $res = $con->query($sql);
                $si = 1;

                while ($row = $res->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?= $si++ ?></td>
                        <td><?= htmlspecialchars($row['name']); ?></td>
                        <?php
                        foreach ($months as $col) {
                            if(!isset($row[$col]) || $row[$col] === 'NA' || trim($row[$col]) === ''){
                                echo "<td class='text-muted'>none</td>";
                            }else{
                                 $file = htmlspecialchars($row[$col]);
                                echo "<td><a href='/tution_p/$file' target='_blank'>view</a></td>";
                            }
                        }
                        ?>
                    </tr>
                    <?php
                }

                ?>
            </tbody>
        </table>
    </div>
</body>

</html>