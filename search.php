<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Document</title>
</head>
<body>
<?php
    // $button = $_GET ['submit'];
    // $search = $_GET ['search'];
	$button = isset($_GET['submit']) ? $_GET['submit'] : false;
$search = isset($_GET['search']) ? $_GET['search'] : false;
if(!$button) echo "you didn't submit a keyword!";
    $con = MySQLi_connect(
        "localhost", //Server host name.
        "root", //Database username.
        "", //Database password.
        "autocomplete" //Database name or anything you would like to call it.
     );
     //Check connection
     if (MySQLi_connect_errno()) {
        echo "Failed to connect to MySQL: " . MySQLi_connect_error();
     }
     $sql = "SELECT * FROM search WHERE MATCH(Name) AGAINST ('%" . $search . "%')";

     $run = mysqli_query($con,$sql);
     $foundnum = mysqli_num_rows($run);

     if($foundnum==0)
     {
         echo "We were unable to find a product with that name";
     }
     else{
         echo "<h1><strong> $foundnum Results Found for \"" .$search."\"</strong></h1>";
         //get num of results stored in db

         $sql = "SELECT * FROM search WHERE MATCH(Name) AGAINST ('%" .$search . "%')";
         $getquery = mysqli_query($con,$sql);

         While($runrows = mysqli_fetch_array($getquery))
         {
            // $name = $runrows["Name"];
             echo"<h5 class='card-title'>". $runrows["Name"] . "</h5>";
         }
     }
     mysqli_close($con);
    ?>
</body>
</html>