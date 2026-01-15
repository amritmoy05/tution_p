<?php
// define("ALLOWED_ACCESS", true);
// $path = trim($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// $path = str_replace('tution_p/', '', $path);
// $path = trim($path, '/');
// $path = strtolower($path);
// include "./classes/navbar.php";

define("ALLOWED_ACCESS", true);
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// project folder remove karo
$baseFolder = 'tution_p/';
$path = str_replace($baseFolder, '', $uri);

// clean slashes
$path = trim($path, '/');
$path = strtolower($path);
// break into parts
$segments = explode('/', $path);
// main route
$route = $segments[0] ?? '';
// optional id (for edit, delete etc.)
$id = $segments[1] ?? null;
// navbar common
include './classes/navbar.php';

// echo "$path";
switch ($route) {
    case '':
    case 'home':
        include 'Frontend/Pages/Home.php';
        break;
    case 'about':
        include 'Frontend/Pages/About.php';
        break;
    case 'student':
        include 'Frontend/Pages/Student.php';
        break;
    case 'admission':
        include 'Frontend/Pages/Admission.php';
        break;
    case 'payment':
        include 'Frontend/Payment/Payment.php';
        break;
    case 'quick_pay':
        include 'Frontend/Pages/Quick_Pay.php';
        break;
    case 'receipt':
        include 'Frontend/Pages/Receipt_View.php';
        break;
    case 'edit':
        include 'Frontend/Pages/Edit.php';
        break;
    case 'check':
        include 'Frontend/Pages/Check.php';
        break;
    case 'pay_fees':
        include 'Frontend/Payment/Pay_fees.php';
    break;



    default:
        include '404.php';
        break;

}
?>