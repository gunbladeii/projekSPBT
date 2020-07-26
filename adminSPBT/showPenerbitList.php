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

    $refID3 = $mysqli->query("SELECT *, COUNT(roleID) AS `jumPenerbit` FROM `login` WHERE role = 'publisherSPBT' AND year = '$year'");
    $RID = mysqli_fetch_assoc($refID3);
?>
<?php if ($RID['role'] == 'publisherSPBT'){?>
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Penerbit</th>
                      <th>Username</th>
                      <th>Password</th>
                      <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php do {?>
                    <tr>
                      <td><?php echo $a++;?></td>
                      <td><a data-toggle="modal" data-target="#" data-whatever="<?php echo $RID['id'];?>" class="nav-link"><span class="badge badge-info"><?php echo strtoupper($RID['name']);?></span></a></td>
                      <td><span class="badge badge-secondary"><?php echo $RID['username']?></span></td>
                      <td><span class="badge badge-success"><?php echo $RID['password']?></span></td>
                      <td><span class="badge badge-warning"><?php echo strtoupper($RID['status']);?></span></td>
                    </tr>
                    <?php } while ($RID = mysqli_fetch_assoc($refID3)); ?>
                    </tbody>
                  </table>
                </div>
<?php } else {echo '<div style="padding-left: 15px"><span class="badge badge-danger">Tiada data setakat ini</span></div>';}?>

