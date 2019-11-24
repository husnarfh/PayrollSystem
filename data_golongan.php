<?php include "header.php"; ?>

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
                    <h2>Data Golongan</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <a href="data_golongan.php?view=tambah" class="btn btn-success">Tambah Data</a>
                    <table class="table">
                      <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Golongan</th>
                            <th>Tunjangan S/I</th>
                            <th>Tunjangan Anak</th>
                            <th>Uang Makan</th>
                            <th>Uang Lembur</th>
                            <th>Askes</th>
                            <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                    include "connect.php";
                    $sql = mysqli_query($connect, "SELECT * FROM golongan ORDER BY kode_golongan ASC");
                    $no=1;

                    while($d=mysqli_fetch_array($sql)){
                        echo"<tr>";
                        echo"<td>". $no ."</td>";
                        echo"<td>". $d['kode_golongan'] ."</td>";
                        echo"<td>". $d['nama_golongan'] ."</td>";
                        echo"<td>". $d['tunjangan_suami_istri'] ."</td>";
                        echo"<td>". $d['tunjangan_anak'] ."</td>";
                        echo"<td>". $d['uang_makan'] ."</td>";
                        echo"<td>". $d['uang_lembur'] ."</td>";
                        echo"<td>". $d['askes'] ."</td>";
                        echo"<td>";
                        
                        echo
                        "<a class='btn btn-warning btn-sm' href='data_golongan.php?view=edit&id=$d[kode_golongan]'>Edit</a>";
                        echo
                        "<a class='btn btn-danger btn-sm' href='aksi_golongan.php?act=del&id=$d[kode_golongan]'>Hapus</a>";
                        echo"</td>";
                        echo"</tr>";
                        $no++;
                    }
                    ?>
                      </tbody>
                    </table>
</div>
<?php
    break;
    case "tambah":
        $simbol='G';
        $query = mysqli_query($connect, "SELECT max(kode_golongan) AS last FROM golongan
            WHERE kode_golongan LIKE '$simbol%'");
        $data = mysqli_fetch_array($query);

        $last_code = $data['last'];
        $last_num = substr($last_code, 1, 2);
        $next_num = $last_num + 1;
        $next_code = $simbol.sprintf('%02s',$next_num);
?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Data Golongan</h3>
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
                    <form action="aksi_golongan.php?act=insert" method="post" role="form">

                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="kodegolongan">Kode Golongan<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" name="kodegolongan" required="required" class="form-control" value="<?php echo $next_code; ?>" readonly>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="namagolongan">Nama Golongan<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" name="namagolongan" required="required" class="form-control">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Tunjangan S/I</label>
                        <div class="col-md-6 col-sm-6 ">
                          <input class="form-control" type="number" name="tunjangansi">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Tunjangan Anak</label>
                        <div class="col-md-6 col-sm-6 ">
                          <input class="form-control" type="number" name="tunjangananak">
                        </div>
                      </div>
                        <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Uang Makan</label>
                        <div class="col-md-6 col-sm-6 ">
                          <input class="form-control" type="number" name="uangmakan">
                        </div>
                      </div>
                        <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Uang Lembur</label>
                        <div class="col-md-6 col-sm-6 ">
                          <input class="form-control" type="number" name="uanglembur">
                        </div>
                      </div>
                        <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Askes</label>
                        <div class="col-md-6 col-sm-6 ">
                          <input class="form-control" type="number" name="askes">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            <input type="submit" class="btn btn-primary" value="Save">
                            <a class="btn btn-danger" href="data_golongan.php">Back</a>
                        </div>
                      </div>
                </form>

<?php  
include "connect.php";
    break;
    case "edit";
        $sqlEdit = mysqli_query($connect, "SELECT * FROM golongan WHERE kode_golongan='$_GET[id]'");
        $edit = mysqli_fetch_array($sqlEdit);
?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Data Golongan</h3>
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
                    <br />
                    <form action="aksi_golongan.php?act=update" method="post">

                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="kodegolongan">Kode Golongan<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" name="kodegolongan" required="required" class="form-control" value="<?php echo $edit['kode_golongan']; ?>" readonly>
                        </div>
                      </div>
                     <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="namagolongan">Nama Golongan<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" name="namagolongan" required="required" class="form-control" value="<?php echo $edit['nama_golongan']; ?>" >
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Tunjangan S/I</label>
                        <div class="col-md-6 col-sm-6 ">
                          <input class="form-control" type="number" name="tunjangansi" value="<?php echo $edit['tunjangan_suami_istri']; ?>" required>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Tunjangan Anak</label>
                        <div class="col-md-6 col-sm-6 ">
                          <input class="form-control" type="number" name="tunjangananak" value="<?php echo $edit['tunjangan_anak']; ?>" required>
                        </div>
                      </div>
                        <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Uang Makan</label>
                        <div class="col-md-6 col-sm-6 ">
                          <input class="form-control" type="number" name="uangmakan" value="<?php echo $edit['uang_makan']; ?>" required>
                        </div>
                      </div>
                        <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Uang Lembur</label>
                        <div class="col-md-6 col-sm-6 ">
                          <input class="form-control" type="number" name="uanglembur" value="<?php echo $edit['uang_lembur']; ?>" required>
                        </div>
                      </div>
                        <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Askes</label>
                        <div class="col-md-6 col-sm-6 ">
                          <input class="form-control" type="number" name="askes" value="<?php echo $edit['askes']; ?>" required>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            <input type="submit" class="btn btn-primary" value="Save">
                            <a class="btn btn-danger" href="data_golongan.php">Back</a>
                        </div>
                      </div>
    </form>
<?php
    break;
}


?>
        
</div> 
    <!-- /page content -->
    
<?php include "footer.php"; ?>