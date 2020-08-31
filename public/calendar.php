<?php include "templates/header.php"; ?>

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
<!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">+</button>






<?php

// Get prev & next month
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // This month
    $ym = date('Y-m');
}

// Check format
$timestamp = strtotime($ym . '-01');
if ($timestamp === false) {
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}



// Today
$today = date('Y-m-j', time());

// For H3 title
$html_title = date('M / Y', $timestamp);

// Create prev & next month link     mktime(hour,minute,second,month,day,year)
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
// You can also use strtotime!
// $prev = date('Y-m', strtotime('-1 month', $timestamp));
// $next = date('Y-m', strtotime('+1 month', $timestamp));

// Number of days in the month
$day_count = date('t', $timestamp);
 
// 0:Sun 1:Mon 2:Tue ...
$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
//$str = date('w', $timestamp);


// Create Calendar!!
$weeks = array();
$week = '';

// Add empty cell
$week .= str_repeat('<td></td>', $str);

for ( $day = 1; $day <= $day_count; $day++, $str++) {
     
    $date = $ym . '-' . $day;
     
    if ($today == $date) {
        $week .= '<td class="today">' . $day;
    } else {
        $week .= '<td>' . $day;
    }
    $week .= '</td>';
     
    // End of the week OR End of the month
    if ($str % 7 == 6 || $day == $day_count) {

        if ($day == $day_count) {
            // Add empty cell
            $week .= str_repeat('<td></td>', 6 - ($str % 7));
        }

        $weeks[] = '<tr>' . $week . '</tr>';

        // Prepare for new week
        $week = '';
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PHP Calendar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <style>
        .container {
            font-family: 'Noto Sans', sans-serif;
            margin-top: 80px;
        }
        h3 {
            margin-bottom: 30px;
        }
        th {
            height: 30px;
            text-align: center;
        }
        td {
            height: 100px;
        }
        .today {
            background: #ADD8E6;
        }
        th:nth-of-type(1), td:nth-of-type(1) {
            color: red;
        }
        th:nth-of-type(7), td:nth-of-type(7) {
            color: blue;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3><a href="?ym=<?php echo $prev; ?>">&lt;</a> <?php echo $html_title; ?> <a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
        <table class="table table-bordered">
            <tr>
                <th>Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
            </tr>
            <?php
                foreach ($weeks as $week) {
                    echo $week;
                }
            ?>
        </table>
    </div>
</body>
</html>

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


  
  
         
       <div class="container">
  
    
   
        



  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
           <form method="post">
    
    
    <br><label for="unitname">Unit Name:</label> 
    <input type="text" name="unitname" id="unitname"> 
        
    <br><label for="duedate">Due Date:</label> 
    <input type="text" name="duedate" id="duedate"> 
    
    <br><label for="assignmentname">Assignment Name:</label>   
    <input type="text" name="assignmentname" id="assignmentname"> 
    
    <br><input type="submit" name="submit" value="Track Item">
        
</form>
            
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


Pascal Parent
2 months ago
I've done something to add some events
You need only to add elements you want between the <td></td> tag with a result from a database like this (like a ul li):


for ( $day = 1; $day <= $day_count; $day++, $str++) {

		$date = $ym . '-' . $day;

		$req = $bdd->query('SELECT * FROM evenements WHERE MONTH(`date`) = '.date("m",$timestamp).' AND YEAR(`date`) = '.date("Y",$timestamp).' AND DAY(`date`)='.$day.' AND estActif = 1 AND idUtilisateur = '.$_SESSION['calId'].' ORDER BY `date`');
		$res = $req->fetchAll(\PDO::FETCH_ASSOC);
		$eventsReq="";
		for ($i=0; $i < count($res); $i++) { 
			$eventsReq .= "<li class=\"event\" id=\"e_".$day."_".($i+1)."\" onclick=\"eventClick('e_".$day."_".($i+1)."','".$day."', event)\">".$res[$i]["text"]."</li>";
		}



		if ($today == $date) {
			$week .= '<td onclick="dateClick('.$day.', event)" class="today" id="'.$day.'"><span class="textJour">' . $day;
		} else {
			$week .= '<td onclick="dateClick('.$day.', event)" id="'.$day.'"><span class="textJour">' . $day;
		}
		$week .= '</span><br><ul class="contenuJour">'.$eventsReq.'</ul><input class="ajouterEventInput" id="ajouterJour'.$day.'" type=\"text\" style="color:black;position:relative;display:block;visibility:hidden;" placeholder="Nouvel évènement"></input></td>';

    // End of the week OR End of the month
		if ($str % 7 == 6 || $day == $day_count) {

			if ($day == $day_count) {
            // Add empty cell
				$week .= str_repeat('<td></td>', 6 - ($str % 7));
			}

			$weeks[] = '<tr>' . $week . '</tr>';

        // Prepare for new week
			$week = '';
		}

	}




     

     
   
 
   