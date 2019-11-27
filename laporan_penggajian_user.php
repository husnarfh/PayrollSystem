<?php
session_start();
if(isset($_SESSION['login'])){
  include "connect.php";
  include "fungsi.php";
  ?>
  <!DOCTYPE html>
  <html>
  <head>
    <title>Cetak Gaji Pegawai</title>
    <style type="text/css">
      body{
          font-family; Arial;
        }
        @media print{
          .no-print{
            display: none;
          }
        }

        table{
          border-collapse: collapse;
        }

      </style>
    </head>
    <body>
    <h3 align="center"> PT. ELPINKEU<br>GAJI PEGAWAI</h3>
    <hr>
    <?php
    if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
           $bulan = $_GET['bulan'];
           $tahun = $_GET['tahun'];
           $bulantahun = $bulan.$tahun;
        }else{
           $bulan = date('m');
           $tahun = date('Y');
           $bulantahun = $bulan.$tahun;
          }
        ?>

  <table>
    <tr>
      <td>Bulan</td>
      <td>:</td>
      <td><?php echo $bulan; ?></td>
    </tr>
    <tr>
      <td>Tahun</td>
      <td>:</td>
      <td><?php echo $tahun; ?></td>
    </tr>  
  </table>

        <table border="1" cellpadding="4" cellspacing="0" width="100%">
                <thead>
                      <tr>
                        <th>NIP</th>
                        <th>Nama Pegawai</th>
                        <th>Jabatan</th>
                        <th>Gol</th>
                        <th>Status</th>
                        <th>Jumlah Anak</th>
                        <th>Gaji Pokok</th>
                        <th>Tj. Jabatan</th>
                        <th>Tj. S/I</th>
                        <th>Tj. Anak</th>
                        <th>Uang Makan</th>
                        <th>Uang Lembur</th>
                        <th>Askes</th>
                        <th>Pendapatan</th>
                        <th>Potongan</th>
                        <th>Total Gaji</th>
                      </tr>
                    </thead>
                  <tbody>
                   
                   <?php
                   include "connect.php";
                   $id = $_SESSION['nip'];
                    $sql = mysqli_query($connect, "SELECT pegawai.nip, pegawai.nama_pegawai, jabatan.nama_jabatan, golongan.nama_golongan,pegawai.status,pegawai.jumlah_anak,jabatan.gaji_pokok, jabatan.tunjangan_jabatan,
                      IF(pegawai.status='Menikah',tunjangan_suami_istri,0) AS tjsi,
                      IF(pegawai.status='Menikah',tunjangan_anak,0) AS tjanak,
                      uang_makan AS uangmakan,
                      master_gaji.lembur*uang_lembur AS uanglembur,askes,
                      (gaji_pokok+tunjangan_jabatan+(SELECT tjsi)+(SELECT tjanak)+(SELECT uangmakan)+(SELECT uanglembur)+askes) AS pendapatan, potongan, 
                      (SELECT pendapatan) - potongan AS totalgaji
                      FROM pegawai
                      INNER JOIN master_gaji ON master_gaji.nip=pegawai.nip
                      INNER JOIN golongan ON golongan.kode_golongan=pegawai.kode_golongan
                      INNER JOIN jabatan ON jabatan.kode_jabatan=pegawai.kode_jabatan
                      WHERE master_gaji.bulan='$bulantahun' and master_gaji.nip=$id
                      ");

                    while($d=mysqli_fetch_array($sql)){
                        echo "<tr>
                        <td>$d[nip]</td>
                        <td>$d[nama_pegawai]</td>
                        <td>$d[nama_jabatan]</td>
                        <td>$d[nama_golongan]</td>
                        <td>$d[status]</td>
                        <td>$d[jumlah_anak]</td>
                        <td>".rupiah($d['gaji_pokok'])."</td>
                        <td>".rupiah($d['tunjangan_jabatan'])."</td>
                        <td>".rupiah($d['tjsi'])."</td>
                        <td>".rupiah($d['tjanak'])."</td>
                        <td>".rupiah($d['uangmakan'])."</td>
                        <td>".rupiah($d['uanglembur'])."</td>
                        <td>".rupiah($d['askes'])."</td>
                        <td>".rupiah($d['pendapatan'])."</td>
                        <td>".rupiah($d['potongan'])."</td>
                        <td>".rupiah($d['totalgaji'])."</td>
                        </tr>";
                      }
                      ?>
                    </tbody>
                  </table>

    <table width="100%">
      <tr>
        <td></td>
        <td width="200px">
          <p>Bogor, <?php echo date("d/m/Y"); ?><br>
          Bendahara,</p>
          <br>
          <br>
          <br>
          <p>__________________________<p>
        </td>
      </tr>
    </table>

    <a href="#" class="no-print" onclick="window.print();">Cetak/Print</a>

    </body>
    </html>

    <?php
  }else{
    header('location:login_multiuser.php');
  }
?>