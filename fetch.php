<?php  
 //fetch.php  
 $connect = mysqli_connect("localhost", "root", "", "db_bank");  
 if(isset($_POST["id"]))  
 {  
      $query = "SELECT * FROM db_bank WHERE id = '".$_POST["id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>
 