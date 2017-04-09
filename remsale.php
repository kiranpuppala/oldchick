<?php
require_once('allvars.php');
require_once('starsess.php');



$pid=$_GET['pid'];
$userid=$_SESSION['userid'];

$dbc=mysqli_connect(DB_ADDR,DB_USER,DB_PASS,DB_NAME)
or die('Error connecting to MySQL server.');

$query="DELETE FROM placedsales WHERE rowid='$pid' AND placerid='$userid'";

$result=mysqli_query($dbc,$query)
or die('Error1 querying database.');

header("Location:placedsales.php");

?>



