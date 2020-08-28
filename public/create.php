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


<?php include "templates/header.php"; ?>


<h2>Track An Assignment</h2>

<?php if (isset($_POST['submit']) && $statement) { ?>

<p>Assignment Tracked Successfully!</p>

<?php } ?>

<!--form to collect data for each artwork-->

<form method="post">
    
    
    <br><label for="unitname">Unit Name:</label> 
    <input type="text" name="unitname" id="unitname"> 
        
    <br><label for="duedate">Due Date:</label> 
    <input type="text" name="duedate" id="duedate"> 
    
    <br><label for="assignmentname">Assignment Name:</label>   
    <input type="text" name="assignmentname" id="assignmentname"> 
    
    <br><input type="submit" name="submit" value="Track Item">
        
</form>

<?php include "templates/footer.php"; ?>