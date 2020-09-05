<?php session_start();?>
<?php
    require('conn.php');
    $kodJudul = $_GET['kodJudul'];
    $kodSekolah = $_GET['kodSekolah'];
    date_default_timezone_set("asia/kuala_lumpur"); 
    $date = date('Y-m-d');

    
    $kodSekolah2 = $_POST['kodSekolah'];
    $namaSekolah = $_POST['namaSekolah'];
    $bukuLebihan = $_POST['bukuLebihan'];
    $bukuStok = $_POST['bukuStok'];
    $kodJudul2 = $_POST['kodJudul'];
  

    
   if (isset($_POST['submit'])) {
    $mysqli->query ("INSERT INTO `rekodPemantauan` (`kodSekolah`,`namaSekolah`,`kodJudul`,`bukuLebihan`,`bukuStok`) VALUES ('$kodSekolah2','$namaSekolah','$kodJudul2','$bukuLebihan','$bukuStok')");
    header("location:main3.php?kodSekolah=$kodSekolah2");
    }

    $id2 = $mysqli->query("SELECT * FROM `dataJudul` WHERE kodJudul =  '$kodJudul'");
    $ReID = mysqli_fetch_assoc($id2);

    $Recordset2 = $mysqli->query("SELECT * FROM dataSekolah WHERE kodSekolah LIKE '$kodSekolah'");
    $dataSekolah = mysqli_fetch_assoc($Recordset2);
    $totalRows_Recordset2 = mysqli_num_rows($Recordset2);

?>


  <form method="post" action="judulModal.php" role="form" enctype="multipart/form-data">
               <div class="form-group"> 
                Kod Judul: <?php echo strtoupper($kodJudul);?>
               </div>

               <div class="form-group"> 
               Judul: <?php echo strtoupper($ReID['judul']);?>
               </div>

               <div class="form-group"> 
               
                                      Jumlah Naskhah (Lebihan):
                                      <div class="input-group mb-3">
                                      <input type="text" name="bukuLebihan" class="form-control"  id="bukuLebihan" value="" required>
                                      <input type="hidden" id="bukuWajib" value="3">
                                      <input type="hidden" id="bukuStok" name="bukuStok" value="">
                                      <div class="input-group-append input-group-text">
                                          <span class="fas fa-id-card-alt"></span>
                                      </div>
                                      </div>
                                    </div>

                                    <input type="hidden" name="kodSekolah" value="<?php echo $dataSekolah['kodSekolah'];?>"/>
                                    <input type="hidden" name="namaSekolah" value="<?php echo $dataSekolah['namaSekolah'];?>"/>
                                    <input type="hidden" name="kodJudul" value="<?php echo $$ReID['kodJudul'];?>"/>
                                    <input type="hidden" name="namaSekolah" value="<?php echo $dataSekolah['namaSekolah'];?>"/>
                                    <div class="modal-footer">
                                    <input type="submit" class="btn btn-primary" name="submit" value="Simpan rekod"/>
               </div>
  </form>



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
