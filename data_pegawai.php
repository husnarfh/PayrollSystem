<?php include "header_pegawai.php"; ?>

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
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Admin</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table class="table">
                      <tr>
                            <td>NIP</td>
                            <td>Nama Lengkap</td>
                            <td>Status</td>
                      </tr>
                      <tbody>
                      <?php
                    include "connect.php";
                    $id = $_SESSION['nip'];
                    $sql = mysqli_query($connect, "SELECT * FROM pegawai WHERE nip=$id");
                    
                    while($d=mysqli_fetch_array($sql)){
                        echo"<tr>";
                        echo"<td>". $d['nip'] ."</td>";
                        echo"<td>". $d['nama_pegawai'] ."</td>";
                        echo"<td>". $d['status'] ."</td>";
                        echo"<td>";
                        echo
                        "<a class='btn btn-warning btn-sm' href='data_pegawai.php?view=edit&id=$d[nip]'>Edit</a>";
                        echo"</td>";
                        echo"</tr>";
                    }
                    ?>
                      </tbody>
                    </table>
</div>


<?php  
include "connect.php";
    break;
    case "edit";
        $id = $_SESSION['nip'];
        $sqlEdit = mysqli_query($connect, "SELECT * FROM pegawai WHERE nip=$id");
        $edit = mysqli_fetch_array($sqlEdit);
?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Profil</h3>
              </div>
            </div>
            <div class="clearfix"></div>
        <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Profil</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form action="edit_data_user.php?act=update" method="post">

                        <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_pegawai">Nama Lengkap<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" name="nama_pegawai" required="required" class="form-control" value="<?php echo $edit['nama_pegawai']; ?>">
                        </div>
                        </div>
                        <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="password">Password<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" name="password" required="required" class="form-control">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            <input type="submit" class="btn btn-primary" value="Update">
                            <a class="btn btn-danger" href="data_pegawai.php">Back</a>
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