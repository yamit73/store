<?php
namespace App;

if (!isset($_SESSION['currentUser'])) {
    header("location:../index.php");
} else {
    if (isset($_REQUEST['action'])) {
        switch ($_REQUEST['action']) {
            case "signOut":
                session_unset();
                header("location:../index.php");
                break;
        }
    }
}
$role=Helper::userRole();
$id=$_SESSION['currentUser']['id'];
$currentSection='';

if (isset($_REQUEST['currentSection'])) {
    $currentSection=$_REQUEST['currentSection'];
}

if (isset($_REQUEST['eAction'])) {
    if ($role="admin") {
        $action=$_REQUEST['eAction'];
        if (isset($_REQUEST['eId'])) {
            $eId=$_REQUEST['eId'];
        }
        if (isset($_REQUEST['prId'])) {
            $prId=$_REQUEST['prId'];
        }
        //product info
        if ($action=="addProduct") {
            require_once("./upload_images.php");
            $productName=$_POST['productName'];
            $productCategory=$_POST['productCategory'];
            $productSubCategory=$_POST['productSubCategory'];
            $productListPrice=$_POST['productListPrice'];
            $productPrice=$_POST['productPrice'];
        }
        if ($action=="editProfile") {
            $editMyProfileId=$_POST['editMyProfileId'];
            $newPassword=$_POST['newPassword'];
            $newConfirmPassword=$_POST['newConfirmPassword'];
            $newUserName=$_POST['newUserName'];
        }
        if ($action=="search") {
            $searchTxt=$_POST['searchTxt'];
        }
        switch($action){
            case "approveUser":
                Helper::approveUser($eId);
                break;
            case "blockUser":
                Helper::blockUser($eId);
                break;
            case "editProfile":
                Helper::editMyProfile($editMyProfileId, $newPassword, $newConfirmPassword, $newUserName);
                break;
            case "deleteUser":
                Helper::deleteUser($eId);
                break;
            case "deleteProduct":
                Helper::deleteProduct($prId);
                break;
            case "addProduct":
                Helper::addProduct($productName, $productImage, $productCategory, $productSubCategory, $productListPrice, $productPrice);
                break;
            case "search":
                //echo $searchTxt;
                $searchedProducts = Functions::searchProducts($searchTxt);
                print_r($searchedProducts);
                break;
        }
    }
}
