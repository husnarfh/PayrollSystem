<?php
session_start();
include "connect.php";

if(!isset($_SESSION['login'])){
    header('location:login.php');
}

if($_GET['act']=='update'){
	$nip = $_SESSION['nip'];
    $nama_pegawai = $_POST['nama_pegawai'];
    $pass = $_POST['password'];
    $password = md5($pass);
    $update = mysqli_query($connect, "UPDATE pegawai SET nama_pegawai='$nama_pegawai', password='$password' WHERE nip='$nip'");
    if($update){
        header('location:data_pegawai.php?e=success');
     }
     else{
         header('location:data_pegawai.php?e=failed');
     }
}
?>