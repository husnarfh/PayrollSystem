<?php include "header_pegawai.php"; ?>
<!--div class="container"-->
<!-- page content -->
<?php
include "connect.php";
$view = isset($_GET['view']) ? $_GET['view'] : null;

switch($view){
    default:
?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>PT. ELPINKEU</h3>
              </div>
              <div class="title_right">
              </div>
            </div>
            <div class="clearfix"> </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Kehadiran </h2>
                    <div class="clearfix"></div>
                  </div>
                  <form class="form-inline" method="get" action="">
                  <div class="form-group">
                    <label>Bulan</label>
                    <select name="bulan" class="form-control">
                      <option value="">- Pilih -</option>
                      <option value="01">Januari</option>
                      <option value="02">Februari</option>
                      <option value="03">Maret</option>
                      <option value="04">April</option>
                      <option value="05">Mei</option>
                      <option value="06">Juni</option>
                      <option value="07">Juli</option>
                      <option value="08">Agustus</option>
                      <option value="09">September</option>
                      <option value="10">Oktober</option>
                      <option value="11">November</option>
                      <option value="12">Desember</option>
                    </select>
                  </div>
                <div class="form-group">
                    <label>Tahun</label>
                    <select name="tahun" class="form-control">
                    <option value="">- Pilih -</option>
                      <?php
                      $y = date('Y');
                      for($i=2019;$i<=$y+2;$i++){
                        echo "<option value='$i'>$i</option>";
                      }
                      ?>
                    </select>
                </div>
                
                </form>
                  <br>

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

                <div class="alert alert-info">
                  <strong>Bulan : <?php echo $bulan; ?>, Tahun : <?php echo $tahun; ?> </strong>
                </div>

                 <div class="x_content">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>NIP</th>
                        <th>Nama Pegawai</th>
                        <th>Jabatan</th>
                        <th>Masuk</th>
                        <th>Sakit</th>
                        <th>Izin</th>
                        <th>Alpha</th>
                        <th>Lembur</th>
                        <th>Potongan</th>
                      </tr>
                    </thead>
                  <tbody>
                   <?php
                   include "connect.php";
                    $id = $_SESSION['nip'];
                    $sql = mysqli_query($connect, "SELECT master_gaji.*, pegawai.nama_pegawai, pegawai.kode_jabatan, jabatan.nama_jabatan 
                      FROM master_gaji 
                      INNER JOIN pegawai ON master_gaji.nip=pegawai.nip
                      INNER JOIN jabatan ON pegawai.kode_jabatan=jabatan.kode_jabatan
                      WHERE master_gaji.bulan=$bulantahun and master_gaji.nip=$id
                      ");


                    while($d=mysqli_fetch_array($sql)){
                        echo "<tr>
                        <td>$d[nip]</td>
                        <td>$d[nama_pegawai]</td>
                        <td>$d[nama_jabatan]</td>
                        <td>$d[masuk]</td>
                        <td>$d[sakit]</td>
                        <td>$d[izin]</td>
                        <td>$d[alpha]</td>
                        <td>$d[lembur]</td>
                        <td>$d[potongan]</td>
                       </tr>";
                      }

                     
                      ?>
                      </tbody>
                    </table>     
                </div>
</div>
</div>
</div>
</div>
</div>
<?php
}
?>
                      
<?php include "footer.php"; ?>