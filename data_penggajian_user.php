<?php include "header_pegawai.php"; ?>
<!--div class="container"-->
<!-- page content -->
<?php
include "connect.php";
include "fungsi.php";
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
                    <h2>Gaji Pegawai</h2>
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
                  <div class="table-responsive">
                  <table class="table">
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
                      WHERE master_gaji.bulan='$bulantahun' and master_gaji.nip = $id");

                

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
                </div>
              </div>
                        <?php  
                        include "connect.php";
                        if(mysqli_num_rows($sql) > 0 ) {
                          echo "
                            <center>
                            <a class='btn btn-success' href='laporan_penggajian_user.php?bulan=$bulan&tahun=$tahun' target='_blank'> <span class='glypicon glypicon-print'></span> Cetak Daftar Gaji Pegawai </a>
                            <a class='btn btn-warning' href='excel_laporan_penggajian_user.php?bulan=$bulan&tahun=$tahun' target='_blank'> <span class='glypicon glypicon-print'></span> Export to Excel </a>
                            </center>
                          ";
                          }
                        ?>
                                     
<?php
}
?>

</form>       
</div> 
    
<?php include "footer.php"; ?>