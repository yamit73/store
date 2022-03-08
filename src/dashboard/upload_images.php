<?php
namespace App;

$target_file = "../img/". basename($_FILES["productImage"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$productImage='';
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
if ($uploadOk != 0) {
    if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
        $productImage=basename($_FILES["productImage"]["name"]);
    } else {
        echo "<small>Sorry, there was an error uploading your image</small>";
    }
}
