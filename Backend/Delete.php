<?php
include("DB.php");
$st_id = $_GET['did'];

// delete image name fetch
$sql = "SELECT image FROM student WHERE s_id = '$st_id'";
$res = $con->query($sql);
// fees row delete by student id 
$del1 = "DELETE FROM fees WHERE s_id = '$st_id'";
$con->query($del1);

// Receipt file delete 
$sel = "SELECT jan,feb,mar,apr,may,jun,july,aug,sept,oct,nov,december FROM receipt WHERE s_id = '$st_id'";
$res2 = $con->query($sel);

$months = ['jan','feb','mar','apr','may','jun','july','aug','sept','oct','nov','december'];
if ($res2 && $res2->num_rows > 0) {
    $rrow = $res2->fetch_assoc();

    foreach ($months as $m) {
        if (!empty($rrow[$m]) && $rrow[$m] !== 'NA') {
            $filePath = "../" . $rrow[$m]; // e.g. ../Receipt/April Payment Receipt_X.pdf
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }
}
$del3 = "DELETE FROM receipt WHERE s_id = '$st_id'";
$con->query($del3);

// student table record delete and image delete from folder 
if ($res && $res->num_rows > 0) {
    $row = $res->fetch_assoc();
    $oldimage = $row['image'];
    // student table record delete
    $del2 = "DELETE FROM student WHERE s_id = '$st_id'";
    if ($con->query($del2)) {
        if (!empty($oldimage) && file_exists("../student_img/" . $oldimage)) {
            unlink("../student_img/" . $oldimage);
        }
        header("location:../student"); // redirect in "student" page 
        exit;
    } else {
        echo "Delete Faild";
    }
} else {
    echo "Record not found";
}

?>