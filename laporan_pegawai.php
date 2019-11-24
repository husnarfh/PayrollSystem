<?php include "header.php"; ?>

<!-- page content -->
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>PT. ELPINKEU</h3>
              </div>

              <div class="title_right">
                <div class="no-print">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-secondary" type="button">Go!</button>
                    </span>
                  </div>
                </div>
                </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Laporan Data Pegawai</h2>
                    <div class="no-print">
                    <ul class="nav navbar-right panel_toolbox">
                      <a href="laporan_jabatan.php" class="btn btn-primary" align='right' onclick="window.print();">Cetak/Print</a>
                    </ul>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>NIP</th>
                          <th>Nama Pegawai</th>
                          <th>Jabatan</th>
                          <th>Golongan</th>
                          <th>Status</th>
                          <th>Jumlah Anak</th>
                        </tr>
                      </thead>

                      <tbody>
                      
                      <?php
                      include "connect.php";
                      include "fungsi.php";

                        $sql = mysqli_query($connect, "SELECT pegawai.*, golongan.nama_golongan, jabatan.nama_jabatan FROM pegawai 
                          INNER JOIN jabatan ON pegawai.kode_jabatan=jabatan.kode_jabatan
                          INNER JOIN golongan ON pegawai.kode_golongan=golongan.kode_golongan
                          ORDER BY golongan.nama_golongan DESC");
                        $no = 1;
                        while($d = mysqli_fetch_array($sql)) {
                            echo "<tr>
                                <td align='center' width='40px'>$no</td>
                                <td>$d[nip]</td>
                                <td>$d[nama_pegawai]</td>
                                <td>$d[nama_jabatan]</td>
                                <td>$d[nama_golongan]</td>
                                <td>$d[status]</td>
                                <td>$d[jumlah_anak] Orang</td>
                            </tr>";
                            $no++;
                        }

                        if(mysqli_num_rows($sql) < 1 ) {
                            echo"<tr><td colspan='7'>There is no data...</td></tr>";
                        }
                        ?>

                      </tbody>
                    </table>
                    <table width="100%">
                    <tr>
                        <td></td>
                        <td align='right' width="200px">
                            <p>
                                Dramaga, <?php echo tglIndo(date('Y-m-d')); ?>
                                <br>
                                Administrator,
                            </p>
                            <br>
                            <br>
                            <br>
                            <p>__________________________</p>
                            <p>Annisa Monitha</p>
                        </td>
                    </tr>
                </table>
                
                  </div>
                </div>
              </div>
        </div>
        <!-- /page content -->
        
<?php include "footer.php"; ?>