<?php
session_start();
include "connect.php";

if(!isset($_SESSION['login'])){
    header('location:login.php');
}

if(isset($_GET['act'])){
    if($_GET['act']=='insert'){
        $kode = $_POST['kodejabatan'];
        $name = $_POST['namajabatan'];
        $gapok = $_POST['gajipokok'];
        $tunjangan = $_POST['tunjanganjabatan'];
       
        $save = mysqli_query($connect, "INSERT INTO jabatan(
            kode_jabatan, nama_jabatan, gaji_pokok, tunjangan_jabatan) VALUES (
            '$kode','$name','$gapok','$tunjangan')");
        if($save){
           header('location:data_jabatan.php?e=success');
        }
        else{
            header('location:data_jabatan.php?e=failed');
        }
    }

elseif($_GET['act']=='update'){
    $kode = $_POST['kodejabatan'];
    $name = $_POST['namajabatan'];
    $gapok = $_POST['gajipokok'];
    $tunjangan = $_POST['tunjanganjabatan'];

    $update = mysqli_query($connect, "UPDATE jabatan SET nama_jabatan='$name', gaji_pokok='$gapok',
    tunjangan_jabatan='$tunjangan' WHERE kode_jabatan='$kode'");
    if($update){
        header('location:data_jabatan.php?e=success');
     }
     else{
         header('location:data_jabatan.php?e=failed');
     }
}

elseif($_GET['act']=='del'){
    $hapus = mysqli_query($connect, "DELETE FROM jabatan WHERE kode_jabatan='$_GET[id]'");
    if($hapus){
        header('location:data_jabatan.php?e=success');
     }
     else{
         header('location:data_jabatan.php?e=failed');
     }
}
}
?>