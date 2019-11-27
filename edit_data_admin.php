<?php
session_start();
include "connect.php";

if(!isset($_SESSION['login'])){
    header('location:login.php');
}

if($_GET['act']=='update'){
    $namalengkap = $_POST['namalengkap'];

    $update = mysqli_query($connect, "UPDATE admin SET namalengkap='$namalengkap'");
    if($update){
        header('location:data_admin.php?e=success');
     }
     else{
         header('location:data_admin.php?e=failed');
     }
}
?>