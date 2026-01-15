<?php
// echo "<pre>";
// print_r($_POST);
// print_r($_FILES);
// exit;


include("DB.php");
if (isset($_POST['submit'])) {
    $stname = $_POST['stname'];
    $stguardian = $_POST['stguardian'];
    $staddress = $_POST['address'];
    $stgender = $_POST['stgender'];
    $stclass = $_POST['stclass'];
    $stnumber = $_POST['stnumber'];
    $stdate = $_POST['stdate'];
    // image 
    $buf = $_FILES['stimg']['tmp_name'];
    $fn = $_FILES['stimg']['name'];
    move_uploaded_file($buf, "../student_img/" . $fn);

    // 🔹 Insert query 1 for 'student' table
    $ins = "INSERT INTO student  (name, g_name, address, gender, class, mobile_no, addmission_date, image)
    VALUES ('$stname', '$stguardian', '$staddress', '$stgender', '$stclass', $stnumber, '$stdate', '$fn')";

    if (mysqli_query($con, $ins)) {

        $st_id = $con->insert_id; // last inserted student id

        //🔹 Insert query 2 for 'fees' table
        $ins2 = "INSERT INTO fees (s_id, jan,feb,mar,apr,may,jun,july,aug,sept,oct,nov,december) 
                 VALUES ('$st_id',0,0,0,0,0,0,0,0,0,0,0,0)";
        $con->query($ins2);
         $ins3 = "INSERT INTO receipt (s_id, jan,feb,mar,apr,may,jun,july,aug,sept,oct,nov,december) 
                 VALUES ('$st_id','NA','NA','NA','NA','NA','NA','NA','NA','NA','NA','NA','NA')";
        $con->query($ins3);
    } else {
        header("location:../404.php");
    }
    header("location:../student");

    // echo "$stname<br>";
    // echo "$stguardian<br>";
    // echo "$staddress<br>";
    // echo "$stgender<br>";
    // echo "$stclass<br>";
    // echo "$stnumber<br>";
    // echo "$stdate<br>";
    // echo "$fn";
}
?>