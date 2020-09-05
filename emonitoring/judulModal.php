<?php session_start();?>
<?php
    require('conn.php');
    $id = $_GET['id'];
    date_default_timezone_set("asia/kuala_lumpur"); 
    $date = date('Y-m-d');

   $judul = $_POST['judul'];
   $zon = $_POST['zon'];
   $state = $_POST['state'];
   $roleID2 = $_POST['roleID'];
   $refID = $_POST['refID'];
    
   if (isset($_POST['submit2'])) {

      $mysqli->query("INSERT INTO `statusBekalan` (`roleID`, `refID`, `judul`, `state`, `zon`) VALUES ('$roleID2', '$refID', $judul', '$state', '$zon')");

      header("location:indexPublisher.php");
    } 

    $id2 = $mysqli->query("SELECT * FROM `login` WHERE id =  '$id'");
    $ReID = mysqli_fetch_assoc($id2);

    $judulCall = $mysqli->query("SELECT * FROM `judul`");
    $JC = mysqli_fetch_assoc($judulCall);

    $stateCall = $mysqli->query("SELECT * FROM `state`");
    $SC = mysqli_fetch_assoc($stateCall);

    $stateCall2 = $mysqli->query("SELECT * FROM `state` GROUP BY `zon`");
    $SC2 = mysqli_fetch_assoc($stateCall2);
?>

<!--start if employeeStatus=='temp'-->

<?php if ($ReID['role'] == 'distiSPBT'){?>
  <form method="post" action="judulModal.php" role="form" enctype="multipart/form-data">
               <div class="form-group">
                                      Jumlah Naskhah (Lebihan):
                                      <div class="input-group mb-3">
                                      <input type="text" name="bukuLebihan" class="form-control"  id="bukuLebihan" value="" required>
                                      <input type="text" id="bukuWajib" value="3">
                                      <input type="text" id="bukuStok" name="bukuStok" value="">
                                      <div class="input-group-append input-group-text">
                                          <span class="fas fa-id-card-alt"></span>
                                      </div>
                                      </div>
                                    </div>

                                    <input type="hidden" name="kodSekolah" value="<?php echo $dataSekolah['kodSekolah'];?>"/>
                                    
                                    <input type="hidden" name="namaSekolah" value="<?php echo $dataSekolah['namaSekolah'];?>"/>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary" name="submit" value="Simpan rekod"/>
                                    </div>
<?php }?>


<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/inputmask/jquery.inputmask.bundle.js"></script>

<!--calculate total earning, deduction, grand total
<script src="../calculateTotalSalary.js"></script>-->

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
    //this calculates values automatically 
    sum();
    $('#bukuLebihan','#bukuWajib').on("keydown keyup", function() {
        sum();
     });

    });

    function sum() {
            var num1 = document.getElementById('bukuLebihan').value;
            var num2 = document.getElementById('bukuWajib').value;
            var result = parseInt(num1) - parseInt(num2);
            if (!isNaN(result)) 
            {
        document.getElementById('bukuStok').value = result;
            }
           
        }
   </script>
