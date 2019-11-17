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
                <h3>Data Jabatan</h3>
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
                    <h2>Tabel</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <a href="data_jabatan.php?view=tambah" class="btn btn-success">Tambah Data</a>
                    <table class="table">
                      <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Jabatan</th>
                            <th>Nama Jabatan</th>
                            <th>Gaji Pokok</th>
                            <th>Tunjangan Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                    include "connect.php";
                    $sql = mysqli_query($connect, "SELECT * FROM jabatan ORDER BY kode_jabatan ASC");
                    $no=1;

                    while($d=mysqli_fetch_array($sql)){
                        echo"<tr>";
                        echo"<td>". $no ."</td>";
                        echo"<td>". $d['kode_jabatan'] ."</td>";
                        echo"<td>". $d['nama_jabatan'] ."</td>";
                        echo"<td>". $d['gaji_pokok'] ."</td>";
                        echo"<td>". $d['tunjangan_jabatan'] ."</td>";
                        echo"<td>";
                        
                        echo
                        "<a class='btn btn-warning btn-sm' href='data_jabatan.php?view=edit&id=$d[kode_jabatan]'>Edit</a>";
                        echo
                        "<a class='btn btn-danger btn-sm' href='aksi_jabatan.php?act=del&id=$d[kode_jabatan]'>Hapus</a>";
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
        $simbol='J';
        $query = mysqli_query($connect, "SELECT max(kode_jabatan) AS last FROM jabatan
            WHERE kode_jabatan LIKE '$simbol%'");
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
                <h3>Data Jabatan</h3>
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
                    <form action="aksi_jabatan.php?act=insert" method="post" role="form">

                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="kodejabatan">Kode Jabatan<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" name="kodejabatan" required="required" class="form-control" value="<?php echo $next_code; ?>" readonly>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="namajabatan">Nama Jabatan<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" name="namajabatan" required="required" class="form-control">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Gaji Pokok</label>
                        <div class="col-md-6 col-sm-6 ">
                          <input class="form-control" type="number" name="gajipokok">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Tunjangan Jabatan</label>
                        <div class="col-md-6 col-sm-6 ">
                          <input class="form-control" type="number" name="tunjanganjabatan">
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            <input type="submit" class="btn btn-primary" value="Save">
                            <a class="btn btn-danger" href="data_jabatan.php">Back</a>
                        </div>
                      </div>
    </form>

<?php  
include "connect.php";
    break;
    case "edit";
        $sqlEdit = mysqli_query($connect, "SELECT * FROM jabatan WHERE kode_jabatan='$_GET[id]'");
        $edit = mysqli_fetch_array($sqlEdit);
?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Data Jabatan</h3>
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
                    <form action="aksi_jabatan.php?act=update" method="post">

                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="kodejabatan">Kode Jabatan<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" name="kodejabatan" required="required" class="form-control" value="<?php echo $edit['kode_jabatan']; ?>" readonly>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="namajabatan">Nama Jabatan<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" name="namajabatan" required="required" class="form-control" value="<?php echo $edit['nama_jabatan']; ?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Gaji Pokok</label>
                        <div class="col-md-6 col-sm-6 ">
                          <input class="form-control" type="number" name="gajipokok" value="<?php echo $edit['gaji_pokok']; ?>" required>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Tunjangan Jabatan</label>
                        <div class="col-md-6 col-sm-6 ">
                          <input class="form-control" type="number" name="tunjanganjabatan" value="<?php echo $edit['tunjangan_jabatan']; ?>" required>
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            <input type="submit" class="btn btn-primary" value="Update">
                            <a class="btn btn-danger" href="data_jabatan.php">Back</a>
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