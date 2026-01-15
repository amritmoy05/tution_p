<?php
include "DB.php";

if (isset($_POST['save'])) {

    // 1️⃣ form se data lena
    $id = $_POST['id'];
    $stname = $_POST['stname'];
    $stguardian = $_POST['stguardian'];
    $address = $_POST['address'];
    $stgender = $_POST['stgender'];
    $stclass = $_POST['stclass'];
    $stnumber = $_POST['stnumber'];
    $stdate = $_POST['stdate'];

    // image
    $old_image = $_POST['old_image'];
    $new_image = $_FILES['stimage']['name'];
    $tmp_name = $_FILES['stimage']['tmp_name'];

    // 2️⃣ image logic
    if (!empty($new_image)) {
        // new image upload
        move_uploaded_file($tmp_name, "../student_img/" . $new_image);

        // old image delete
        if (!empty($old_image) && file_exists("../student_img/" . $old_image)) {
            unlink("../student_img/" . $old_image);
        }

        $final_image = $new_image;
    } else {
        // old image hi rakho
        $final_image = $old_image;
    }

    // 3️⃣ update query
    $upd = "UPDATE student SET
                name = '$stname',
                g_name = '$stguardian',
                address = '$address',
                gender = '$stgender',
                class = '$stclass',
                mobile_no = '$stnumber',
                addmission_date = '$stdate',
                image = '$final_image'
            WHERE s_id = '$id'";

    // 4️⃣ execute
    if ($con->query($upd)) {
        header("Location:../student");
        exit;
    } else {
        echo "Update failed : " . $con->error;
    }
}
?>