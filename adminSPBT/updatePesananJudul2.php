<?php require('conn.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}

$colname_Recordset = "-1";
if (isset($_SESSION['user'])) {
  $colname_Recordset = $_SESSION['user'];
}

$Recordset = $mysqli->query("SELECT * FROM login WHERE username = '$colname_Recordset'");
$row_Recordset = mysqli_fetch_assoc($Recordset);
$totalRows_Recordset = mysqli_num_rows($Recordset);


date_default_timezone_set("asia/kuala_lumpur"); 
$date = date('Y-m-d'); 
$time = date('H:i:s');
$year = date('Y');

    $refID3 = $mysqli->query("SELECT login.name, statusBekalan.roleID,statusBekalan.state, statusBekalan.zon, statusBekalan.totPesanan, statusBekalan.totBekalan, statusBekalan.year, statusBekalan.judul FROM `statusBekalan` INNER JOIN login ON statusBekalan.roleID = login.roleID WHERE statusBekalan.year = '$year'");
    $RID = mysqli_fetch_assoc($refID3);
    $a=1;
?>
<?php if (!empty($RID['state'])){?>
                <div class="table-responsive">
                  <form method="post" action="indexPublisher.php" role="form" enctype="multipart/form-data">
                            <div>
                              <div class="form-group">
                                 <label style="padding-left: 15px">User Picture:</label>
                                 <div class="input-group mb-3">
                                    <input type="file" name="publisherSPBTFacePic" id="image2" class="form-control" accept="image/*" id="validationDefault17">
                                    <div class="input-group-append input-group-text">
                                      <span class="fas fa-portrait"></span>
                                    </div>
                                </div>
                               </div>

                              <div class="form-group">
                                <div class="input-group mb-3">
                                <input type="text" name="roleID" class="form-control" placeholder="Cadangan Role ID" id="validationDefault01" required>
                                <div class="input-group-append input-group-text">
                                    <span class="fas fa-id-card-alt"></span>
                                </div>
                               </div>
                              </div>
                              
                              <div class="form-group">
                                <div class="input-group mb-3">
                                <input type="text" style="text-transform: uppercase;" class="form-control" placeholder="Taip nama pengedar" name="name" id="validationDefault02" required>
                                <div class="input-group-append input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <div class="input-group mb-3"> 
                                <input type="email" name="username" class="form-control" placeholder="Masukkan cadangan username (e-mel)" id="validationDefault03" required>
                                <div class="input-group-append input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <div class="input-group mb-3"> 
                                     <input type="password" name="password" class="form-control" placeholder="Masukkan cadangan password" id="validationDefault04" required>
                                     <div class="input-group-append input-group-text">
                                        <span class="fas fa-lock"></span>
                                     </div>
                                </div>
                              </div>
                            </div>

                              <input type="hidden" name="role" value="distiSPBT"/>
                              <input type="hidden" name="status" value="active"/>
                              <input type="hidden" name="refID" value="<?php echo $LC['roleID'];?>"/>
                              <div class="modal-footer">
                                  <input type="submit" class="btn btn-primary" name="submit" value="Daftar Pengguna Baharu"/>&nbsp;
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                         </form>
                </div>
<?php } else {echo '<div style="padding-left: 15px"><span class="badge badge-danger">Tiada data setakat ini</span></div>';}?>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
