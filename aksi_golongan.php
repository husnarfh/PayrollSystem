<?php
session_start();
include "connect.php";

if(!isset($_SESSION['login'])){
    header('location:login.php');
}

if(isset($_GET['act'])){
    if($_GET['act']=='insert'){
        $kode = $_POST['kodegolongan'];
        $name = $_POST['namagolongan'];
        $tunjsi = $_POST['tunjangansi'];
        $tunjanak = $_POST['tunjangananak'];
        $uangmakan = $_POST['uangmakan'];
        $uanglembur = $_POST['uanglembur'];
        $askes = $_POST['askes'];

        if($kode=='' || $name=='' || $tunjsi=='' || $tunjanak=='' || $uangmakan=='' || $uanglembur=='' || $askes==''){
            header('location:data_golongan.php?view=tambah&e=bl');
        }
       
        $save = mysqli_query($connect, "INSERT INTO golongan(
            kode_golongan, nama_golongan, tunjangan_suami_istri,tunjangan_anak,uang_makan,uang_lembur,askes) VALUES (
            '$kode','$name','$tunjsi','$tunjanak','$uangmakan','$uanglembur','$askes')");
        
        if($save){
           header('location:data_golongan.php?e=success');
        }
        else{
            header('location:data_golongan.php?e=failed');
        }
    }

elseif($_GET['act']=='update'){
        $kode = $_POST['kodegolongan'];
        $name = $_POST['namagolongan'];
        $tunjsi = $_POST['tunjangansi'];
        $tunjanak = $_POST['tunjangananak'];
        $uangmakan = $_POST['uangmakan'];
        $uanglembur = $_POST['uanglembur'];
        $askes = $_POST['askes'];

    if($kode=='' || $name=='' || $tunjsi=='' || $tunjanak=='' || $uangmakan=='' || $uanglembur=='' || $askes==''){
        
        header('location:data_golongan.php?view=edit&e=bl');
    }

    $update = mysqli_query($connect, "UPDATE golongan SET nama_golongan='$name', tunjangan_suami_istri='$tunjsi', tunjangan_anak='$tunjanak', uang_makan='$uangmakan', uang_lembur='$uanglembur', askes='$askes' WHERE kode_golongan='$kode'");

    if($update){
        header('location:data_golongan.php?e=success');
     }
     else{
         header('location:data_golongan.php?e=failed');
     }
}

elseif($_GET['act']=='del'){
    $hapus = mysqli_query($connect, "DELETE FROM golongan WHERE kode_golongan='$_GET[id]'");
    if($hapus){
        header('location:data_golongan.php?e=success');
     }
     else{
         header('location:data_golongan.php?e=failed');
     }
}
}
?>