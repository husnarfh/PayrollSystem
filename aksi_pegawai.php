<?php
session_start();
include "connect.php";

if(!isset($_SESSION['login'])){
    header('location:login.php');
}

if(isset($_GET['act'])){
    if($_GET['act']=='insert'){
        $nip = $_POST['nip'];
        $name = $_POST['namapegawai'];
        $jabatan = $_POST['jabatan'];
        $golongan = $_POST['golongan'];
        $status = $_POST['status'];
        $jmlanak = $_POST['jumlahanak'];
       
        $save = mysqli_query($connect, "INSERT INTO pegawai(
            nip, nama_pegawai, kode_jabatan, kode_golongan, status, jumlah_anak) VALUES (
            '$nip','$name','$jabatan','$golongan','$status','$jmlanak')");
        if($save){
           header('location:pegawai.php?e=success');
        }
        else{
            header('location:pegawai.php?e=failed');
        }
    }

elseif($_GET['act']=='update'){
    $nip = $_POST['nip'];
    $name = $_POST['namapegawai'];
    $jabatan = $_POST['jabatan'];
    $golongan = $_POST['golongan'];
    $status = $_POST['status'];
    $jmlanak = $_POST['jumlahanak'];

    $update = mysqli_query($connect, "UPDATE pegawai SET nama_pegawai='$name', kode_jabatan='$jabatan',
    kode_golongan='$golongan', status='$status', jumlah_anak='$jmlanak' WHERE nip='$nip'");
    if($update){
        header('location:pegawai.php?e=success');
     }
     else{
         header('location:pegawai.php?e=failed');
     }
}

elseif($_GET['act']=='del'){
    $hapus = mysqli_query($connect, "DELETE FROM pegawai WHERE nip='$_GET[id]'");
    if($hapus){
        header('location:pegawai.php?e=success');
     }
     else{
         header('location:pegawai.php?e=failed');
     }
}
}
?>