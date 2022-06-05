<?php  
 $connect = mysqli_connect("localhost", "root", "", "db_bank");  
 $query = "SELECT * FROM db_bank ORDER BY id DESC";  
 $result = mysqli_query($connect, $query);  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Customer List</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <style>
          
           
          body{
               background-color:white;
          }
          table,th,td{
               border:1px dotted white;
               border-collapse:collapse;
               padding:20px;
               font-size:20px;
          }
          th{
               background:black;
               padding:30px;
               color:white;
          }
          tr{
               background:rgb(188, 98, 233); 
               color:white;
          }
          .btn-info{
               background-color:white;
               color:black;
               border:1px solid black;
               width:100%;
               font-size:15px;
          }
          .btn-info:hover{
               background-color:rgb(188, 98, 233);
               color:white;
               border:1px solid white;
               width:100%;
               font-size:15px;
               font-weight:bold;
          }
          h1{
               font-weight:bold;
          }
        
                
           </style>
          </head>  
      <body>  
           <br /><br />  
           <div class="container" style="width:700px;">  
                <h3 align="center">List of Customers</h3>  
                <br />  
                <div class="table-responsive">  
                       
                     <br />  
                     <div id="employee_table">  
                          <table class="table table-bordered">  
                               <tr>  
                                    <th width="70%">Customer Name</th>  
                                    <th width="15%">Email</th>  
                                    <th width="15%">Balance</th>  
                                    <th width="15%">Transfer</th>  
                               </tr>  
                               <?php  
                               while($row = mysqli_fetch_array($result))  
                               {  
                               ?>  
                               <tr>  
                                    <td><?php echo $row["name"]; ?></td>  
                                    <td><?php echo $row["email"]; ?></td>  
                                    <td><?php echo $row["balance"]; ?></td>  
                                    <td><input type="button" name="edit" value="Transfer" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs edit_data" /></td>  
                               </tr>  
                               <?php  
                               }  
                               ?>  
                          </table>  
                     </div>  
                </div>  
           </div>  
      </body>  
 </html>  
 <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Employee Details</h4>  
                </div>  
                <div class="modal-body" id="employee_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
 <div id="add_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Transfer Money</h4>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="insert_form">  
                          <label>Enter Receiver Name</label>  
                          <input type="text" name="name" id="name" class="form-control" />  
                          <br />  
                          <label>Enter Your Name</label>  
                          <input type="text" name="yourname" id="yourname" class="form-control"></textarea>  
                          <br />  
                    
                          <label>Enter Balance</label>  
                          <input type="text" name="balance" id="balance" class="form-control" />  
                          <br />  
                           
                          <input type="hidden" name="id" id="id" />  
                          <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />  
                     </form>  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
 <script>  
 $(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
      $(document).on('click', '.edit_data', function(){  
           var id = $(this).attr("id");  
           $.ajax({  
                url:"fetch.php",  
                method:"POST",  
                data:{id:id},  
                dataType:"json",  
                success:function(data){  
                     $('#name').val(data.name);  
                     $('#yourname').val(data.yourname);  
                     $('#balance').val(data.balance);   
                     $('#id').val(data.id);  
                     $('#insert').val("Transfer");  
                     $('#add_data_Modal').modal('show');  
                }  
           });  
      });  
      $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
           if($('#name').val() == "")  
           {  
                alert("Receiver Name is required");  
           }  
           else if($('#yourname').val() == '')  
           {  
                alert("Your name is required");  
           }  
           else if($('#balance').val() == '')  
           {  
                alert("Balance is required");  
           }  
           
           else  
           {  
                $.ajax({  
                     url:"insert.php",  
                     method:"POST",  
                     data:$('#insert_form').serialize(),  
                     beforeSend:function(){  
                          $('#insert').val("Transferinging");  
                     },  
                     success:function(data){  
                          $('#insert_form')[0].reset();  
                          $('#add_data_Modal').modal('hide');  
                          $('#employee_table').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', '.view_data', function(){  
           var id = $(this).attr("id");  
           if(id != '')  
           {  
                $.ajax({  
                     url:"select.php",  
                     method:"POST",  
                     data:{id:id},  
                     success:function(data){  
                          $('#employee_detail').html(data);  
                          $('#dataModal').modal('show');  
                     }  
                });  
           }            
      });  
 });  
 </script>
 
