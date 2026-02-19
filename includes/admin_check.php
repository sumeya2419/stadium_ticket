<?php
include("../includes/auth_check.php");

if($_SESSION['role'] != 'admin'){
    die("Access Denied");
}
?>
