<?php
namespace App;

if (isset($_REQUEST['orderid'])) {
    $orderid=$_REQUEST['orderid'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>Thank you</title>
    <style>
        .thanku-icon{
            font-size: 100px;
            color: #198754;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row text-center mt-lg-5">
            <i class="bi bi-hand-thumbs-up thanku-icon"></i>
            <h1 class="text-success ">Thank You for shopping with us</h1>
            <h3>Order Id: <?php echo $orderid; ?></h3>
            <h4 class="text-primary"><a href="./shop.php">Shop more</a></h4>
        </div>
    </div>
</body>
</html>