<?php
  //print_r($_SESSION['currentUser']);
  if(!isset($_SESSION['currentUser'])){
    header("location:index.php");
  }else{
    if(isset($_REQUEST['action'])){
      switch($_REQUEST['action']){
        case "signOut":
          session_unset();
          header("location:index.php");
      }
    }
  }