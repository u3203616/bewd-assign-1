<?php 

// this code will only execute after the submit button is clicked
if (isset($_POST['submit'])) {
	
    // include the config file that we created before
    require "config.php"; 
    
    
    
    // this is called a try/catch statement 
	try {
        // FIRST: Connect to the database
        $connection = new PDO($dsn, $username, $password, $options);
		
        // SECOND: Get the contents of the form and store it in an array
        $new_track = array( 
            
            "unitname" => $_POST['unitname'], 
            "duedate" => $_POST['duedate'],
            "assignmentname" => $_POST['assignmentname'],
            
        );
        
       // THIRD: Turn the array into a SQL statement
        $sql = "INSERT INTO works (unitname, duedate, assignmentname) VALUES (:unitname, :duedate, :assignmentname)";    
        
        // FOURTH: Now write the SQL to the database
        $statement = $connection->prepare($sql);
        $statement->execute($new_track);

	} catch(PDOException $error) {
        // if there is an error, tell us what it is
		echo $sql . "<br>" . $error->getMessage();
	}	
}
?>


<?php include "templates/header.php" ; ?>




<?php if (isset($_POST['submit']) && $statement) { ?>

<p><br><span class= "alert alert-success" class="glyphicon glyphicon-ok" role="alert">Assignment Tracked Successfully! <span class="glyphicon glyphicon-ok" </span></p>

<br>

<?php } ?>





<div class="container">

    <form class="well form-horizontal" action=" " method="post"  id="contact_form">
<fieldset>

<!-- Form Name -->
<legend><center><h2><b>Track Assignment</b></h2></center></legend><br>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label">Unit Name</label>  
    
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input  id="unitname" name="unitname" placeholder="Unit Name" class="form-control"  type="text">
    </div>
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" >Assignment Name</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
  <input id="assignmentname" name="assignmentname" placeholder="Assignment Name" class="form-control"  type="text">
    </div>
  </div>
</div>

  
  
<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label">Due Date</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
  <input  id="duedate" name="duedate" placeholder="Due Date" class="form-control"  type="date">
    </div>
  </div>
</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
    
  <div class="col-md-4"><br>
    <button type="submit" name="submit" class="btn btn-success" >Add Item  <span class="glyphicon glyphicon-plus"></span></button>
  </div>
</div>

</fieldset>
</form>
</div>
    <!-- /.container -->

<?php include "templates/footer.php"; ?>