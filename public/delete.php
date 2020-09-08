<?php 

    // include the config file 
    require "config.php";
    require "common.php";

    // This code will only run if the delete button is clicked
    if (isset($_GET["id"])) {
        
	    // this is called a try/catch statement 
        try {
            // define database connection
            $connection = new PDO($dsn, $username, $password, $options);
            
            // set id variable
            $id = $_GET["id"];
            
            // Create the SQL 
            $sql = "DELETE FROM works WHERE id = :id";

            // Prepare the SQL
            $statement = $connection->prepare($sql);
            
            // bind the id to the PDO
            $statement->bindValue(':id', $id);
            
            // execute the statement
            $statement->execute();

            // Success message
            
            $success = "<br><span class='alert alert-danger'>Work Successfully Deleted!</span>";  
            
        } catch(PDOException $error) {
            // if there is an error, tell us what it is
            echo $sql . "<br>" . $error->getMessage();
        }
    };

    // This code runs on page load
    try {
        $connection = new PDO($dsn, $username, $password, $options);
		
        // SECOND: Create the SQL 
        $sql = "SELECT * FROM works";
        
        // THIRD: Prepare the SQL
        $statement = $connection->prepare($sql);
        $statement->execute();
        
        // FOURTH: Put it into a $result object that we can access in the page
        $result = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

?>

<?php include "templates/header.php"; ?>

<h2>Delete an Assignment</h2>

<?php if ($success) echo $success; ?>


<!-- This is a loop, which will loop through each result in the array -->
<?php foreach($result as $row) { ?>
            
        <p>
            <br>
            ID: 
    <?php echo $row['id']; ?><br> Unit Name:
    <?php echo $row['unitname']; ?><br> Due Date:
    <?php echo $row['duedate']; ?><br> Assignment Name:
    <?php echo $row['assignmentname']; ?><br> Priority:
    <?php echo $row['priority']; ?><br> 
            
            
    <br><a href='delete.php?id=<?php echo $row['id']; ?>'><button class= "btn btn-danger" onclick="return confirm('Are you sure you want to delete this item')" data-toggle="modal" data-target="delete">Delete <span class="glyphicon glyphicon-trash"</span></button></a>
                   
        </p>


<hr>
<?php }; 
?>

<!DOCTYPE html>

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
    
<?php include "templates/footer.php"; ?>