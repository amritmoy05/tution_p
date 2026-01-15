<?php
include("DB.php");
$st_id = $_GET['did'];

// delete image name fetch
$sql = "SELECT image FROM student WHERE s_id = '$st_id'";
$res = $con->query($sql);
// fees row delete by student id 
$del1 = "DELETE FROM fees WHERE s_id = '$st_id'";
$con->query($del1);
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