<?php
session_start(); //DONT FORGET SESSION START
  if (!(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==1)) {
        echo "error - not logged in";
        die();
    }
require 'site_functions.php';
?>
<!DOCTYPE html>
<html lang ="en">
	<head>
		<meta charset="utf-8">
		<title> </title>
	</head>
        <body>
<?php
$filename = "students.rtf"; 
$fp = fopen($filename, "r") or die("Couldn't open $filename"); 
while(!feof($fp)) 
{ 
    $line = fgets($fp); 
if (preg_match('/'._get("search").'/',$line))
print "$line<br>"; 
} 
fclose($fp); 
?>
        </body>
</html>