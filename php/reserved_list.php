<!DOCTYPE html>



<html>

<head>
<title>Denis Alfonso - Project 1</title> 
<link href="../css/style.css" rel="stylesheet" type="text/css">
<meta charset="utf-8">
    
</head>
    
    

<body>
<h1>Reservations and Unit Amounts</h1>
 <a href="../index.html">Back To Form</a>
<?php


    
    
    
// Connects php file to mysql server or gives an error message if it fails to connect.
$db = mysqli_connect('localhost','denis1','abc123','denis_database', 8889)
 or die('Error connecting to MySQL server.');


// Connects php file to table called "mytable1" on the mysql server and gathers the values from it.
      $query = "SELECT * FROM mytable1";
        mysqli_query($db, $query) or die('Error querying database.');
        // Creates an array for the values gathered from the "mytable1" table.
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_array($result);
        /* While $row is equal to the arrays of $result, echo each of the values in $row. */
        while ($row = msqli_fetch_array($result)) {
            echo $row['first'] . ' ' . $row['last'] . ': ' . $row['units'] . '<br>';
        }
        
        // Gathers the values from user input and ties it to variables.
        $first = $_POST['first'];
        $last = $_POST['last'];
        $units = $_POST['units'];
        // Escapes the user input for security purposes.
        $first = mysql_real_escape_string($first);
        $last = mysql_real_escape_string($last);
        $units = mysql_real_escape_string($units);
        // gets the id of the current page.
        $articleid = $_GET['id'];
        // Checks if the page id is a number, if not, spit out an error message to the user.
        if(! is_numeric($articleid))
            die('invalid article id');
        
        // inserts user input into table to be saved.
        $query_insert = "INSERT INTO mytable1 (id, first, last, units) VALUES (NULL, '$first', '$last', '$units', CURRENT_TIMESTAMP, '$articleid');";
        //checks if the data was saved to the table successfully. If it is, it echos a success message, otherwise, it sends an error message with a specific error code.
        if (mysqli_query($db, $query_insert)) {
            echo "<br>Reservation Saved Successfully.";
        } else {
            echo "<br>Error: Could not execute $query_insert" . mysqli_error($db);
        }
        
        // selects the listed items from the table named "mytable1".
       $list = "SELECT id, first, last, units FROM mytable1";
        $listresult = $db->query($list);
        /* checks if the number of rows in $listresult is greater than 0. Also While $row is equal to $listresult's associative arrays, echo "reservation number:" and the info inside of the table. Else, echo "no reservations to display". */
        if ($listresult->num_rows > 0) {
            while ($row = $listresult->fetch_assoc()) {
                echo "Reservation Number: " . $row["id"] . "<br>Name: " . $row["first"] . " " . $row["last"] . "<br>Number of Units: " . $row["units"];
            }
        } else {
            echo "No reservations to display."
        } 
        
        
        
        
        // Closes the connection to the MySQL server.
         mysqli_close($db);




?>
    
    
    
    
   
    </body>


</html>