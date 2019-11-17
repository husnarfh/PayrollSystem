<?php
function rupiah($angka){
    $uang = "Rp " . number_format($angka,0,',','.');
    return $uang;
}

function bulanIndo($angkaBulan){
    switch($angkaBulan){
        case "1":
            $bulan = "Januari";
            break;

        case "2":
            $bulan = "Februari";
            break;

        case "3":
            $bulan = "Maret";
            break;

        case "4":
            $bulan = "April";
            break;

        case "5":
            $bulan = "Mei";
            break;
            
        case "6":
            $bulan = "Juni";
            break;
        
        case "7":
            $bulan = "Juli";
            break;

        case "8":
            $bulan = "Agustus";
            break;

        case "9":
            $bulan = "September";
            break;
            
        case "10":
            $bulan = "Oktober";
            break;

        case "11":
            $bulan = "November";
            break;
            
        case "12":
            $bulan = "Desember";
            break;

        default:
            $bulan = "No month chosen..";
            break;
    }

    return $bulan;
}

function tglIndo($tanggal){
    $tgl = substr($tanggal, 8, 2);
    $bulan = bulanIndo(substr($tanggal, 5, 2));
    $tahun = substr($tanggal, 0, 4);
    return $tgl.' '.$bulan.' '.$tahun;
}
?>