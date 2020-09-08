<?php 

	
    // include the config file that we created before
    require "config.php"; 
    
    // this is called a try/catch statement 
	try {
        // FIRST: Connect to the database
        $connection = new PDO($dsn, $username, $password, $options);
		
        // SECOND: Create the SQL 
        $sql = "SELECT * FROM works";
        
        // THIRD: Prepare the SQL
        $statement = $connection->prepare($sql);
        $statement->execute();
        
        // FOURTH: Put it into a $result object that we can access in the page
        $result = $statement->fetchAll();

	} catch(PDOException $error) {
        // if there is an error, tell us what it is
		echo $sql . "<br>" . $error->getMessage();
	}	

?>

<?php include "templates/header.php"; ?>


<h2>Results</h2>

<!-- This is a loop, which will loop through each result in the array -->
<?php foreach($result as $row) { ?>

<p>
    
    
    ID: 
   <?php echo $row['id']; ?><br> Unit Name:
    <?php echo $row['unitname']; ?><br> Due Date:
    <?php echo $row['duedate']; ?><br> Assignment Name:
    <?php echo $row['assignmentname']; ?><br> Priority:
    <?php echo $row['priority']; ?><br> 

    <br><a class="btn btn-warning" href='update-work.php?id=<?php echo $row['id']; ?>'>Edit  <span class="glyphicon glyphicon-pencil"</span></a>
    
</p>

<hr>
<?php }; //close the foreach
?>

<?php include "templates/footer.php"; ?>                