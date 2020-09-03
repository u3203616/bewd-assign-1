<?php

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if( !isset($_SESSION["loggedin"] ) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
    
}

?>
 



<!DOCTYPE html>


<html lang="en">
<head>
<div class="jumbotron text-center" >
 <h1><?php echo htmlspecialchars($_SESSION["username"]); ?>'s Assignment Tracker</h1>
  <p>Track Your Assignments With Ease!</p> 
    <h5>Home Page</h5>
</div>




<html lang="en">
<head>
    
    <meta charset="UTF-8">
   
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    

    

    <div class="page-header">
        
    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password <span class="glyphicon glyphicon-lock"</span></a>
        <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-success" data-toggle="modal"  data-target="#myModal">Notifications <span class="glyphicon glyphicon-envelope"</span></button>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account <span class="glyphicon glyphicon-off"</span></a>
    </p>
    
    
        
        <br><a href="create.php" class= "btn btn-info"> Add New Assignment <span class="glyphicon glyphicon-plus"></span></a>
        <br>
        <br><a href="read.php" class= "btn btn-info">Tracked Assignments <span class="glyphicon glyphicon-eye-open"></span></a>
        <br>
        <br><a href="update.php" class= "btn btn-info">Edit an Assignment <span class="glyphicon glyphicon-pencil"></span></a> 
        <br>
        <br><a href="delete.php" class= "btn btn-info">Delete an Assignment <span class="glyphicon glyphicon-trash"></span></a>
        <br> 
    <br><a href ="calendar.php" class= "btn btn-info">Calendar <span class="glyphicon glyphicon-calendar"></span></a>
    
             
   <html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  
    
        
        



  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Assignments Due Soon</h4>
        </div>
        <div class="modal-body">
          <p>Click Below to View Tasks</p>
            <a href="read.php" target="_blank">Tracked Assignments</a>
            
        </div>
          
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

</body>
</html>

    

    
<?php include "templates/footer.php"; ?>
