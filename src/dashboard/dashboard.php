<?php
  session_start();
  require_once("../classes/products.php");
  require_once("../classes/helper.php");
  require_once("dashUservalidation.php");
  $role=Helper::userRole();
  $id=$_SESSION['currentUser']['id'];
  $currentSection='';

  if(isset($_REQUEST['currentSection'])){
    $currentSection=$_REQUEST['currentSection'];
  }

  if(isset($_REQUEST['eAction'])){
    if($role="admin"){
      $action=$_REQUEST['eAction'];
      if(isset($_REQUEST['eId'])){
        $eId=$_REQUEST['eId'];
      }
      if(isset($_REQUEST['prId'])){
        $prId=$_REQUEST['prId'];
      }
      //product info
      if($action=="addProduct"){
        $productName=$_POST['productName'];
        $productImage=$_POST['productImage'];
        $productCategory=$_POST['productCategory'];
        $productSubCategory=$_POST['productSubCategory'];
        $productPrice=$_POST['productPrice'];
      }
      

      switch($action){
        case "approveUser":
          Helper::approveUser($eId);
          break;
        case "blockUser":
          Helper::blockUser($eId);
          break;
        case "deleteUser":
          Helper::deleteUser($eId);
          break;
        case "deleteProduct":
          Helper::deleteProduct($prId);
          break;
        case "addProduct":
          Helper::addProduct($productName, $productImage, $productCategory, $productSubCategory, $productPrice);
          break;
      }
    }
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Dashboard</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <link href="./assets/css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">CEDCOSS</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="?action=signOut">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <p class="nav-link active" aria-current="page" href="dashboard.php">
              <span data-feather="home"></span>
              <?php echo Helper::userName(); ?>
            </p>
          </li>
          <?php echo Helper::dashboardSideNav($role);?>
        </ul>        
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <p></p>

        <?php echo Helper::dashboardImportExportSection($role);?>
        
      </div>

      <h2><?php echo $currentSection; ?></h2>
      <?php 

        if($currentSection=="Products" && $role="admin"){
          echo Helper::searchProductSection();
          echo Helper::addProductSection();
        }

      ?>
      <div class="table-responsive mt-4">
        <table class="table table-striped table-sm">

            <?php 

              if($currentSection=="My-Profile"){
                echo Helper::myProfile($id);
              }else if($currentSection=="Users" && $role="admin"){
                echo Helper::allUsers();
              }else if($currentSection=="Products" && $role="admin"){
                echo Helper::allproducts();
              }

            ?>

        </table>
      </div>
      <div class="row mt-5">
        <div class="col-md-4">
          <?php 

            if($currentSection=="My-Profile"&& $role="user"){
              echo Helper::userProfileEditForm();
            }

          ?>
        </div>
      </div>
    </main>
  </div>
</div>


    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>