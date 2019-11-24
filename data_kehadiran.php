<?php include "header.php"; ?>
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
                <h3>Data Kehadiran Pegawai</h3>
              </div>
              <div class="title_right">
                <div class="col-md-5 col-sm-5  form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"> </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tabel</h2>
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
                  <button type="submit" class="btn btn-primary">Tampilkan Data</button>
                  <a href="data_kehadiran.php?view=tambah" class="btn btn-success">Input Kehadiran Pegawai</a>
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
                  <strong>Bulan : <?php echo $bulan; ?>, Tahun : <?php echo $tahun; ?> </stronh>
                </div>

                 <div class="x_content">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>No</th>
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
                    $sql = mysqli_query($connect, "SELECT master_gaji.*, pegawai.nama_pegawai, pegawai.kode_jabatan, jabatan.nama_jabatan 
                      FROM master_gaji 
                      INNER JOIN pegawai ON master_gaji.nip=pegawai.nip
                      INNER JOIN jabatan ON pegawai.kode_jabatan=jabatan.kode_jabatan
                      WHERE master_gaji.bulan=$bulantahun
                      ORDER BY pegawai.nip ASC");

                    $no=1;

                    while($d=mysqli_fetch_array($sql)){
                        echo "<tr>
                        <td>$no</td>
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
                        $no++;
                      }

                     if(mysqli_num_rows($sql) > 0){
                      echo "<tr>
                        <td colspan='9' text-align='center'>
                        <a class='btn btn-warning' href='data_kehadiran.php?view=edit&bulan=$bulan&tahun=$tahun'>Edit Data Kehadiran</a>
                        </td>
                        </tr>";
                      }else{
                        echo "<tr>
                        <td colspan='9' text-align='center'>
                        Belum ada data pada bulan dan tahun yang anda pilih...!!!
                        </td>
                        </tr>";
                        }
                      ?>
                      </tbody>
                    </table>     
                </div>





              <?php
                  break;
                  case "tambah":
                  ?>
              <div class="right_col" role="main">
                        <div class="">
                          <div class="page-title">
                            <div class="title_left">
                              <h3>Data Kehadiran</h3>
                            </div>
                            <div class="title_right">
                              <div class="col-md-5 col-sm-5  form-group pull-right top_search">
                                <div class="input-group">
                                  <input type="text" class="form-control" placeholder="Search for...">
                                  <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Go!</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 ">
                              <div class="x_panel">
                                <div class="x_title">
                                  <h2>Tambah Data</h2>
                                  <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                  <br />
                                  <form class="form-inline" method="get" action="">
                                  <input type="hidden" name="view" value="tambah">
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
                                <button type="submit" class="btn btn-primary">Generate Form</button>
                              </form>
                            <br>

                        <?php  
                        include "connect.php";
                        if((isset($_GET['tahun']) && $_GET['tahun']!='') && (isset($_GET['bulan']) && $_GET['bulan']!='')){
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

                        <form method="post" action="aksi_kehadiran.php?act=insert">
                        <div class="x_content">
                           <table class="table">
                             <thead>
                              <tr>
                                <th>No</th>
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
                          $no=1;
                          include "connect.php";
                              $query = mysqli_query($connect, "SELECT pegawai.*, jabatan.nama_jabatan FROM pegawai 
                                INNER JOIN jabatan ON pegawai.kode_jabatan=jabatan.kode_jabatan 
                                WHERE NOT EXISTS (SELECT * FROM master_gaji WHERE bulan='$bulantahun' AND pegawai.nip=master_gaji.nip) 
                                ORDER BY pegawai.nip ASC");
                           $jmlPegawai=mysqli_num_rows($query);
                           while($d=mysqli_fetch_array($query)){
                        ?>
                         
                        <input type="hidden" name="bulan[]" value="<?php echo $bulantahun; ?>" />
                        <input type="hidden" name="nip[]" value="<?php echo $d['nip']; ?>" />
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $d['nip']; ?></td>
                          <td><?php echo $d['nama_pegawai']; ?></td>
                          <td><?php echo $d['nama_jabatan']; ?></td>
                          <td>
                            <input type="number" name="masuk[]" class="form-control" value="0" required />
                          </td>
                          <td>
                            <input type="number" name="sakit[]" class="form-control" value="0" required />
                          </td>
                          <td>
                            <input type="number" name="izin[]" class="form-control" value="0" required />
                          </td>
                          <td>
                            <input type="number" name="alpha[]" class="form-control" value="0" required />
                          </td> 
                          <td>
                            <input type="number" name="lembur[]" class="form-control" value="0" required />
                          </td>
                          <td>
                            <input type="number" name="potongan[]" class="form-control" value="0" required />
                          </td>
                        </tr>
                        
                        <?php 
                          $no++; 
                        }

                        if($jmlPegawai >0){
                          ?>
                          <tr>
                            <td colspan="4"></td>
                            <td colspan="6">
                              <input class="btn btn-primary" type="submit" value="Save">
                              <a href="data_kehadiran.php" class="btn btn-danger">Back</a>
                            </td>
                          </tr>
                          
                        <?php
                          }else{
                            ?>
                          <tr>
                            <td colspan="10">
                              <label class="label label-warning"> Maaf, bulan dan tahun yang dipilih sudah di proses, silahkan lakukan edit data...</label>
                            </td>
                          </tr>
                        
                        <?php
                        }
                        ?>
                        
                    </form>


                        <?php
                            break;
                            case "edit";
                            ?>

                      <div class="right_col" role="main">
                          <div class="">
                            <div class="page-title">
                              <div class="title_left">
                                  <h3>Data Kehadiran</h3>
                                  <div class="clearfix"></div>
                                </div>
                                <div class="title_right">
                              <div class="col-md-5 col-sm-5  form-group pull-right top_search">
                                <div class="input-group">
                                  <input type="text" class="form-control" placeholder="Search for...">
                                  <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Go!</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 ">
                              <div class="x_panel">
                                <div class="x_title">
                                  <h2>Edit Data</h2>
                                  <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                  <br/>
                                  <form class="form-inline" method="get" action="">
                                  <input type="hidden" name="view" value="update">
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
                                <button type="submit" class="btn btn-primary">Generate Form</button>
                              </form>
                              <br>

                               <?php  
                        include "connect.php";
                        if((isset($_GET['tahun']) && $_GET['tahun']!='') && (isset($_GET['bulan']) && $_GET['bulan']!='')){
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

                        <form method="post" action="aksi_kehadiran.php?act=update">
                        <div class="x_content">
                           <table class="table">
                             <thead>
                              <tr>
                                <th>No</th>
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
                          $no=1;
                          include "connect.php";
                              $query = mysqli_query($connect, "SELECT master_gaji.*, pegawai.nama_pegawai, jabatan.nama_jabatan FROM master_gaji 
                                INNER JOIN pegawai ON master_gaji.nip=pegawai.nip
                                INNER JOIN jabatan ON pegawai.kode_jabatan=jabatan.kode_jabatan
                                WHERE master_gaji.bulan='$bulantahun'
                                ORDER BY master_gaji.nip ASC");
                           $jmlPegawai=mysqli_num_rows($query);
                           while($d=mysqli_fetch_array($query)){
                        ?>
                         
                        <input type="hidden" name="bulan[]" value="<?php echo $bulantahun; ?>" />
                        <input type="hidden" name="nip[]" value="<?php echo $d['nip']; ?>" />
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $d['nip']; ?></td>
                          <td><?php echo $d['nama_pegawai']; ?></td>
                          <td><?php echo $d['nama_jabatan']; ?></td>
                          <td>
                            <input type="number" name="masuk[]" class="form-control" value="<?php echo $d['masuk']; ?>" required />
                          </td>
                          <td>
                            <input type="number" name="sakit[]" class="form-control" value="<?php echo $d['sakit']; ?>" required />
                          </td>
                          <td>
                            <input type="number" name="izin[]" class="form-control" value="<?php echo $d['izin']; ?>" required />
                          </td>
                          <td>
                            <input type="number" name="alpha[]" class="form-control" value="<?php echo $d['alpha']; ?>" required />
                          </td> 
                          <td>
                            <input type="number" name="lembur[]" class="form-control" value="<?php echo $d['lembur']; ?>" required />
                          </td>
                          <td>
                            <input type="number" name="potongan[]" class="form-control" value="<?php echo $d['potongan']; ?>" required />
                          </td>
                        </tr>
                        
                        <?php 
                          $no++; 
                        }
                          ?>

                          <tr>
                            <td colspan="4"></td>
                            <td colspan="6">
                              <input class="btn btn-primary" type="submit" value="update">
                              <a href="data_kehadiran.php" class="btn btn-danger">Back</a>
                            </td>
                          </tr>  
                    

<?php
}
?>

</form>       
</div> 
    
<?php include "footer.php"; ?>