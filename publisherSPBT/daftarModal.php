<?php session_start();?>
<?php
    require('conn.php');
    $noIC = $_GET['noIC'];
    $date = $_GET['date'];
    date_default_timezone_set("asia/kuala_lumpur"); 
    $date = date('Y-m-d');
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
    	$nama = $_POST['nama'];
    	$noIC = $_POST['noIC'];
    	$stationCode = $_POST['stationCode'];
    	$success = $_POST['success'];
    	$fail = $_POST['fail'];
    	$date = $_POST['date'];
    	$odoStart = $_POST['odoStart'];
    	$odoFinish = $_POST['odoFinish'];
    	$oil = $_POST['oil'];
    	$success = $_POST['success'];
    	$status = $_POST['status'];
    	$itemCode = $_POST['itemCode'];
    	$mysqli->query("UPDATE `infoParcel` SET `stationCode`='$stationCode', `nama`='$nama', `fail` ='$fail', `date`='$date' , `odoStart`='$odoStart', `odoFinish`='$odoFinish', `oil`='$oil', `success`='$success', `status` = '$status', `itemCode` = '$itemCode' WHERE `noIC` ='$noIC' AND `date`='$date'");
    	header("location:indexPublisher.php");
    }

    $members = $mysqli->query("SELECT * FROM `infoParcel` WHERE `noIC`='$noIC' AND `date` = '$date'");
    $mem = mysqli_fetch_assoc($members);
    
    $mem_attend = $mysqli->query("SELECT * FROM `attendance` WHERE `noIC`='$noIC' AND `date` = '$date'");
    $attend = mysqli_fetch_assoc($mem_attend);

?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Using Bootstrap modal</title>
    
</head>
<body>   
<?php if ($attend['time'] != NULL){?>
<form method="post" action="daftarModal.php" role="form">
	<div class="modal-body">
		<div class="form-group">
		    <label for="id">ID</label>
			<input type="text" class="form-control" id="noIC" name="noIC" value="<?php echo $mem['noIC'];?>" readonly="true"/>

		</div>
		
		
		<div class="modal-footer">
			<input type="submit" class="btn btn-primary" name="submit" value="Update Data Parcel" />&nbsp;
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</form>
	<?php }?>
	<?php if ($attend['time'] == NULL){?>
	   <div class="modal-footer">
			<input type="button" class="btn btn-secondary" value="Waiting confirmation parcel list from supervisor!" />&nbsp;
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	<?php }?>
	
  <!--formula subtract on update parcel-->
	<script>
    $(document).ready(function() {
    //this calculates values automatically 
    sum();
    $("#itemCode, #success").on("keydown keyup", function() {
        sum();
    });

    function sum() {
            var num1 = document.getElementById('itemCode').value;
            var num2 = document.getElementById('success').value;
			var result = parseInt(num1) - parseInt(num2);
            if (!isNaN(result)) 
            {
				document.getElementById('fail').value = result;
            }
            if(num2 > 80)
            {
               var calc1 = 20 * 0.9;
               var calc2 = 1.2 * (parseInt(num2) - 81);
               var result2 = parseInt(calc2) + parseInt(calc1);
               document.getElementById('status').value = result2;
            }
            if(num2 < 60)
            {
               var result3 = 0;
               document.getElementById('status').value = result3;
            }
            if(num2 >= 60 && num2 <= 80)
            {
               var result4 = parseInt(num2) * 0.9;
               document.getElementById('status').value = result4;
            }
        }
    });
   </script>