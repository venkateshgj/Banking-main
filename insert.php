<?php
 $connect = mysqli_connect("localhost", "root", "", "db_bank");
 <html>
 <head>

 </head>
 <body>
 <p>
 'sdjqwibeuwef'
 </p>
 </body>
 </html>
 if(!empty($_POST))
 {
      $output = '';
      $message = '';
      $name = mysqli_real_escape_string($connect, $_POST["name"]);
      $yourname = mysqli_real_escape_string($connect, $_POST["yourname"]);
      $balance = mysqli_real_escape_string($connect, $_POST["balance"]);

      if($_POST["id"] != '')
      {
        $select_query = "SELECT balance FROM db_bank where name='$name'";
        $result = mysqli_query($connect, $select_query);
        $row = mysqli_fetch_array($result);


     //    echo "balance: " .$row['balance']. "";
        $amt=$row['balance'];
        $newbal = $balance + $row['balance'];
     //    echo $newbal;

           $query = "
           UPDATE db_bank
           SET
           balance = '$newbal'
           WHERE id='".$_POST["id"]."'";
           $message = 'Money Transfered';

           $newquery = "
           INSERT INTO transaction(name, yourname, balance)
           VALUES('$name', '$yourname', '$newbal')";

           if(mysqli_query($connect, $newquery))
           {
               // $output .= '<label class="text-success">' . $message . '</label>';
           }
      }
      else
      {
           $query = "
           INSERT INTO transaction(name, yourname, balance)
           VALUES('$name', '$yourname', '$balance');
           ";
           $message = 'Data Inserted';
      }
      if(mysqli_query($connect, $query))
      {
           $output .= '<label class="text-success">' . $message . '</label>';
           $select_query = "SELECT * FROM db_bank ORDER BY id DESC";
           $result = mysqli_query($connect, $select_query);
           $output .= '
                <table class="table table-bordered">
                     <tr>
                          <th width="70%">Customer Name</th>
                          <th width="15%">Email</th>
                          <th width="15%">Balance</th>
                          <th width="15%">Transfer</th>
                     </tr>
           ';
           while($row = mysqli_fetch_array($result))
           {
                $output .= '
                     <tr>
                          <td>' . $row["name"] . '</td>
                          <td>' . $row["email"] . '</td>
                          <td>' . $row["balance"] . '</td>
                          <td><input type="button" name="edit" value="Transfer" id="'.$row["id"] .'" class="btn btn-info btn-xs edit_data" /></td>
                     </tr>
                ';
           }
           $output .= '</table>';
      }
      echo $output;
 }
 ?>
