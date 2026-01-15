<?php
if (!defined('ALLOWED_ACCESS')) {
    http_response_code(403);
    die('Direct access not allowed. Please use the main website.');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tution_P</title>
    <script src="/local-asset/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/local-asset/bootstrap.min.css">
    <link rel="stylesheet" href="Frontend/css/Home.css">
</head>

<body>
    <div class="container-bg">
        <marquee behavior="" direction="" class="">
            <h4 class="mt-1">Welcome to our Student Database.....!!</h4>
        </marquee>
        <?php
        $nav = new Navbar();
        $nav->showNavbar();
        ?>
    </div>
</body>

</html>