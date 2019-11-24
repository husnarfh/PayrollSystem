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
                    <h2>Data Pegawai</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <a href="pegawai.php?view=tambah" class="btn btn-success">Tambah Data</a>
                    <table class="table">
                      <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama Pegawai</th>
                            <th>Jabatan</th>
                            <th>Golongan</th>
                            <th>Status</th>
                            <th>Jumlah Anak</th>
                            <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                    include "connect.php";
                    $sql = mysqli_query($connect, "SELECT pegawai.*,jabatan.nama_jabatan,golongan.nama_golongan 
                    FROM pegawai INNER JOIN jabatan ON pegawai.kode_jabatan=jabatan.kode_jabatan INNER JOIN
                    golongan ON pegawai.kode_golongan=golongan.kode_golongan ORDER BY pegawai.nama_pegawai ASC");
                    $no=1;

                    while($d=mysqli_fetch_array($sql)){
                        echo"<tr>
                              <td>$no</td>
                              <td>$d[nip]</td>
                              <td>$d[nama_pegawai]</td>
                              <td>$d[nama_jabatan]</td>
                              <td>$d[nama_golongan]</td>
                              <td>$d[status]</td>
                              <td>$d[jumlah_anak]</td>
                              <td>
                                <a class='btn btn-warning btn-sm' href='pegawai.php?view=edit&id=$d[nip]'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='aksi_pegawai.php?act=del&id=$d[nip]'>Hapus</a>
                              </td>
                        </tr>";
                        $no++;
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
                <h3>Data Pegawai</h3>
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
                    <form action="aksi_pegawai.php?act=insert" method="post" role="form">

                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="nip">NIP<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" name="nip" required="required" class="form-control">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="namapegawai">Nama Pegawai<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" name="namapegawai" required="required" class="form-control">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Jabatan</label>
                        <div class="col-md-6 col-sm-6 ">
                        <select name="jabatan" class="form-control">
                            <option value=""> Pilih </option>
                            <?php
                            $sqlJabatan=mysqli_query($connect, "SELECT * FROM jabatan ORDER BY kode_jabatan ASC");
                            while($j=mysqli_fetch_array($sqlJabatan)){
                              echo"<option value='$j[kode_jabatan]'>$j[nama_jabatan]</option>";
                            }
                            ?>
                        </select>
                          </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Golongan</label>
                        <div class="col-md-6 col-sm-6 ">
                        <select name="golongan" class="form-control">
                            <option value=""> Pilih </option>
                            <?php
                            $sqlGol=mysqli_query($connect, "SELECT * FROM golongan ORDER BY kode_golongan ASC");
                            while($k=mysqli_fetch_array($sqlGol)){
                              echo"<option value='$k[kode_golongan]'>$k[nama_golongan]</option>";
                            }
                            ?>
                        </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Status</label>
                        <div class="col-md-6 col-sm-6 ">
                          <input class="form-control" type="text" name="status">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Jumlah Anak</label>
                        <div class="col-md-6 col-sm-6 ">
                          <input class="form-control" type="number" name="jumlahanak">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            <input type="submit" class="btn btn-primary" value="Save">
                            <a class="btn btn-danger" href="pegawai.php">Back</a>
                        </div>
                      </div>
    </form>

<?php  
include "connect.php";
    break;
    case "edit";
        $sqlEdit = mysqli_query($connect, "SELECT * FROM pegawai WHERE nip='$_GET[id]'");
        $edit = mysqli_fetch_array($sqlEdit);
?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Data Pegawai</h3>
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
                    <form action="aksi_pegawai.php?act=update" method="post">

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="nip">NIP<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" name="nip" required="required" class="form-control" value="<?php echo $edit['nip']; ?>" readonly>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="namapegawai">Nama Pegawai<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" name="namapegawai" required="required" class="form-control" value="<?php echo $edit['nama_pegawai']; ?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Jabatan</label>
                        <div class="col-md-6 col-sm-6 ">
                        <select name="jabatan" class="form-control">
                            <option value=""> Pilih </option>
                            <?php
                            $sqlJabatan=mysqli_query($connect, "SELECT * FROM jabatan ORDER BY kode_jabatan ASC");
                            while($j=mysqli_fetch_array($sqlJabatan)){
                              $selected = ($j['kode_jabatan'] == $edit['kode_jabatan']) ? 'selected="selected"' : "";
                              echo"<option value='$j[kode_jabatan]' $selected>$j[kode_jabatan] - $j[nama_jabatan]</option>";
                            }
                            ?>
                        </select>
                          </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Golongan</label>
                        <div class="col-md-6 col-sm-6 ">
                        <select name="golongan" class="form-control">
                            <option value=""> Pilih </option>
                            <?php
                            $sqlGol=mysqli_query($connect, "SELECT * FROM golongan ORDER BY kode_golongan ASC");
                            while($k=mysqli_fetch_array($sqlGol)){
                              $selected = ($k['kode_golongan'] == $edit['kode_golongan']) ? 'selected="selected"' : "";
                              echo"<option value='$k[kode_golongan]' $selected>$k[kode_golongan] - $k[nama_golongan]</option>";
                            }
                            ?>
                        </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Status</label>
                        <div class="col-md-6 col-sm-6 ">
                          <input class="form-control" type="text" name="status" value="<?php echo $edit['status']; ?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Jumlah Anak</label>
                        <div class="col-md-6 col-sm-6 ">
                          <input class="form-control" type="number" name="jumlahanak" value="<?php echo $edit['jumlah_anak']; ?>">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            <input type="submit" class="btn btn-primary" value="Update">
                            <a class="btn btn-danger" href="pegawai.php">Back</a>
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