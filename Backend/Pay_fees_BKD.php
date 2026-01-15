<?php
// echo "<pre>";
// print_r($_POST);
// print_r($_FILES);
// exit;


include "DB.php";
if (isset($_POST['submit'])) {
    $sid = $_POST['sid'];
    $fid = $_POST['fid'];
    $month = $_POST['month'];
    $amount = $_POST['amount'];
    $add_month = $_POST['add_month'];
    $add_amount = $_POST['add_amount'];
    $pay_date = $_POST['p_date'];

    $buf = $_FILES['rcpt_sign']['tmp_name'];
    $fn = $_FILES['rcpt_sign']['name'];
    move_uploaded_file($buf, __DIR__ .  "./Receipt_Sign/" . $fn);
    $sign_path = 'Receipt_sign/' . $fn;
    //student details fetch -------------------------------
    $sel = "SELECT * FROM student WHERE s_id='$sid'";
    $res = $con->query($sel);
    if ($res && $res->num_rows > 0) {
    $row = $res->fetch_assoc();
    // print_r($row); // debug ke liye
    } else {
        die("Student not found");
    }
    //-----------------------------------------------------
    $months = ["jan" => "January", "feb" => "February", "mar" => "March", "apr" => "April","may" => "May","jun" => "June", "july" => "July", "aug" => "August", "sept" => "September",
                            "oct" => "October", "nov" => "November", "december" => "December" ];
    $month_full = $months[$month];       // "jan" => "January"
    $add_month_full = $months[$add_month]; // "feb" => "February"

    //------------------------------------------------------
    if ($add_amount > 0 && !empty($add_month)) {
        if ($month === $add_month) {
            // $upd = "UPDATE fees SET $month = '$amount' + '$add_amount' WHERE s_id='$fid'";
            // $con->query($upd);
        } else {
            // $upd = "UPDATE fees SET $month = '$amount' WHERE s_id='$fid'";
            // $con->query($upd);
            // $upadd = "UPDATE fees SET $add_month = '$add_amount' WHERE s_id = '$fid'";
            // $con->query($upadd);
        }
    } else {
        // $upd = "UPDATE fees SET $month = '$amount' WHERE s_id='$fid'";
        // $con->query($upd);
    }
    
                                    // echo "<pre>";
                                    // print_r($_POST);
                                    // print_r($_FILES);
                                    // exit;

    // if ($con->query($upd)) {
    
        require "./fpdf/fpdf.php";

        class PDF_Rotate extends FPDF
        {
            var $angle = 0;

            function Rotate($angle, $x = -1, $y = -1)
            {
                if ($x == -1)
                    $x = $this->x;
                if ($y == -1)
                    $y = $this->y;
                if ($this->angle != 0)
                    $this->_out('Q');
                $this->angle = $angle;
                if ($angle != 0) {
                    $angle *= M_PI / 180;
                    $c = cos($angle);
                    $s = sin($angle);
                    $cx = $x * $this->k;
                    $cy = ($this->h - $y) * $this->k;
                    $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm', $c, $s, -$s, $c, $cx, $cy));
                }
            }

            function RotatedText($x, $y, $txt, $angle)
            {
                $this->Rotate($angle, $x, $y);
                $this->Text($x, $y, $txt);
                $this->Rotate(0);
            }
        }


        $pdf = new PDF_Rotate();

        $pdf->AddPage("", );
        // $pdf->AddPage('P', array(150, 150)); // width: 100mm, height: 150mm

        $pdf->SetFont('Arial', 'B', 57);
        $pdf->SetTextColor(245, 243, 243);
        $pdf->RotatedText(35, 250, 'AMRITMOY SAMANTA', 45);

        //Reset for normal text 
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', 'B', 14);

        $pdf->SetFont('Arial', '', '12');
        $pdf->Cell(100, 10, 'SI No.: 01', 0, 0, 'L');
        $pdf->Cell(90, 10, 'Date : '.date("d-m-Y", strtotime($pay_date)), 0, 1, 'R');

        $pdf->Ln(8);

        $pdf->SetFont('Arial', 'B', 24);
        $pdf->SetFont('Arial', 'BU', 24); // B = Bold, U = Underline
        $pdf->Cell(190, 10, 'TUTION FEES RECEIPT', 0, 2, 'C');


        $pdf->SetFont("Arial", "", 13);
        $pdf->Cell(190, 10, 'Unsani, Sastitala, Jagacha, Howrah - 711302 ', 0, 1, 'C');
        $pdf->Cell(190, 10, 'P.H. No.- 9144715971 ', 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); //Normal Line
        $pdf->Ln(2);

        $pdf->SetFont('Arial', '', '14');
        $pdf->SetFont('Arial', 'BU', 14);
        $pdf->Cell(180, 10, 'STUDENT INFO', 0, 1, 'C');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', '13');
        $pdf->Cell(130, 10, 'Name : '.$row['name'], 0, 1, 'L');
        $pdf->Image("../student_img/".$row['image'], 148, 82, 25, 30); // Student image 
        $pdf->Cell(95, 10, ''.$row['class'], 0, 1, 'L');
        $pdf->Cell(120, 10, 'Guardian Name : '.$row['g_name'], 0, 1, 'L');
        $pdf->Cell(190, 10, 'Mobile No. : '.$row['mobile_no'], 0, 1, 'L');
        $pdf->Ln(10);


        $pdf->SetFont('Arial', '', '14');
        $pdf->SetFont('Arial', 'BU', 14);
        $pdf->Cell(180, 10, 'FEES DETAILS', 0, 1, 'C');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', '13');
        if(!empty($add_month) && $add_amount > 0){
            $pdf->Cell(130, 10, 'Payment ID: 01', 0, 1, 'L');
            $pdf->Cell(130, 10, 'Paid Month : '.$month_full, 0, 0, 'L');
            $pdf->Cell(95, 10, 'Amount : '.$add_amount , 0, 1, 'L');
            $pdf->Cell(130, 10, 'Additional Month : '.$add_month_full, 0, 0, 'L');
            $pdf->Cell(95, 10, 'Amount : '.$amount, 0, 1, 'L');
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Line(100, $pdf->GetY(), 200, $pdf->GetY()); // Normal Line
            $totalamount = (int)$add_amount + (int)$amount;
            $pdf->Cell(163, 10, 'Total Paid Amount : '.$totalamount, 0, 1, 'R');
        }else{
            $pdf->Cell(130, 10, 'Payment ID: 01', 0, 1, 'L');
            $pdf->Cell(130, 10, 'Paid Month : '.$month_full, 0, 0, 'L');
            $pdf->Cell(95, 10, 'Amount : '.$amount, 0, 1, 'L');
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Line(100, $pdf->GetY(), 200, $pdf->GetY()); // Normal Line
            $pdf->Cell(163, 10, 'Total Paid Amount : '.$amount, 0, 1, 'R');
        }

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->RotatedText(21, 230, 'Authority Signature', 0);
        $pdf->RotatedText(18, 252, '- - - - - - - - - - - - - - - - - - - - - - ', 0);
        $pdf->RotatedText(160, 230, 'Signature', 0);
        $pdf->RotatedText(135, 252, '- - - - - - - - - - - - - - - - - - - - - - - - - -', 0);
        $pdf->Image("mysign.jpeg", 13, 235, 55, 13); //authority sign 
        if (!empty($fn) && file_exists($sign_path)){
            $pdf->Image("$sign_path", 144, 235, 55, 14); // rcpt sign
        }else{
             $pdf->SetFont('Arial', 'I', 8);
            $pdf->Text(150, 245, 'Signature not available');
        }
        $pdf->SetFont('Arial', '', 10);
        date_default_timezone_set("Asia/Kolkata");
        $pdf->RotatedText(78, 290, 'Bill generated on : ' . date("d-m-Y / h:i A"), 0);




        $pdf->Output();


// }

}

// echo "$sid<br>";
// echo "$fid<br>";
// echo "$name<br>";
// echo "$class<br>";
// echo "$month<br>";
// echo "$amount<br>";
// echo "$add_month<br>";
// echo "$add_amount<br>";
// echo "$fn";
