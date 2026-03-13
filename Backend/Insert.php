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
    $stgender = $_POST['stgender'] ?? 0;
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
        // Step 1: Last receipt number nikaalo
        $sel4 = "SELECT MAX(rcpt_no) AS last_no FROM receipt";
        $res4 = $con->query($sel4);
        $row4 = $res4->fetch_assoc();
        // Agar table empty ho toh 0 se start
        $rcpt_no = ($row4['last_no'] ?? 0);


        //🔹 Insert query 2 for 'fees' table
        $ins2 = "INSERT INTO fees (s_id, jan,feb,mar,apr,may,jun,july,aug,sept,oct,nov,december) 
                 VALUES ('$st_id',0,0,0,0,0,0,0,0,0,0,0,0)";
        $con->query($ins2);
        $ins3 = "INSERT INTO receipt (s_id, jan,feb,mar,apr,may,jun,july,aug,sept,oct,nov,december,rcpt_no) 
                 VALUES ('$st_id','NA','NA','NA','NA','NA','NA','NA','NA','NA','NA','NA','NA','$rcpt_no')";
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