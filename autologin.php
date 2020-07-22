<?php require('adminSPBT/conn.php'); ?>
<?php
      session_start();
      function locationHeader()
      {
          if($_SESSION['role'] == "administrator")
            {
                header('Location:adminSPBT/index.php');
            }
            else if($_SESSION['role'] == "rider")
            {
            header('Location:publisherSPBT/indexPublisher.php');
            }
            else if($_SESSION['role'] == "ss")
            {
            header('Location:distiSPBT/index.php');
            }
            else
            {
            session_destroy();   
            }
      }
      
      locationHeader();
?>