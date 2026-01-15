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
    <title>Quick_Pay</title>
    <script src="/local-asset/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/local-asset/bootstrap.min.css">
    <link rel="stylesheet" href="Frontend/css/Quick_Pay.css">
</head>

<body>
    <div class="container-bg">
        <?php
        $nav = new Navbar();
        $nav->showNavbar();
        ?>
        <h2>This is the Quick_Pay page</h2>
    </div>
</body>

</html>