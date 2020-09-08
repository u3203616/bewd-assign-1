<?php
if( !isset($_SESSION["loggedin"] ) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

?>

<?php include "templates/header.php"; ?>

    <ul>
        <li><a href="create.php">Add New Assignment</a></li>
        <li><a href="read.php">Tracked Assignments</a></li>
        <li><a href="update.php">Edit an Assignment</a></li>
        <li><a href="delete.php">Delete an Assignment</a></li>     
    </ul>

<?php include "templates/footer.php"; ?>
      