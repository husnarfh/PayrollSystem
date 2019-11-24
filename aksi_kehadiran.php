<?php
session_start();
include "connect.php";

if(!isset($_SESSION['login'])){
    header('location:login.php');
}

if(isset($_GET['act'])){
    if($_GET['act']=='insert'){
        $bulan = $_POST['bulan'];
        $nip = $_POST['nip'];
        $masuk = $_POST['masuk'];
        $sakit = $_POST['sakit'];
        $izin = $_POST['izin'];
        $alpha = $_POST['alpha'];
        $lembur = $_POST['lembur'];
        $potongan = $_POST['potongan'];

        $count = count($nip);

        $sql="INSERT INTO master_gaji(bulan,nip,masuk,sakit,izin,alpha,lembur,potongan) VALUES ";
        
        for($i=0; $i < $count; $i++){
            $sql .= "('{$bulan[$i]}','{$nip[$i]}','{$masuk[$i]}','{$sakit[$i]}','{$izin[$i]}','{$alpha[$i]}','{$lembur[$i]}','{$potongan[$i]}')";
            $sql .= ",";
        }

        $sql = rtrim($sql,",");

        $save = mysqli_query($connect, $sql);
        
        if($Save){
           header('location:data_kehadiran.php?e=success');
        }else{
            header('location:data_kehadiran.php?e=failed');
        }
    }

elseif($_GET['act']=='update'){
    
        $bulan = $_POST['bulan'];
        $nip = $_POST['nip'];
        $masuk = $_POST['masuk'];
        $sakit = $_POST['sakit'];
        $izin = $_POST['izin'];
        $alpha = $_POST['alpha'];
        $lembur = $_POST['lembur'];
        $potongan = $_POST['potongan'];

        $count = count($nip);

        for($i=0; $i < $count; $i++){
            $update = mysqli_query($connect, "UPDATE master_gaji SET masuk='$masuk[$i]', sakit='$sakit[$i]', izin='$izin[$i]', alpha='$alpha[$i]', lembur='$lembur[$i]', potongan='$potongan[$i]' 
                WHERE bulan='$bulan[$i]' AND nip='$nip[$i]'");
        }
    
    if($update){
           header('location:data_kehadiran.php?e=success');
        }else{
            header('location:data_kehadiran.php?e=failed');
        }
    }

    }
?>