<?php
if (isset($_REQUEST['action'])) {
    $action=$_REQUEST['action'];
    switch($action){
        case "logout":
            session_unset();
            header("location:./index.php");
            break;
    }
}
