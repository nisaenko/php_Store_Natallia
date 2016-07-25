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
       $id=_get('id');
       $handle=fopen('students.txt','r');
       $var1=explode(PHP_EOL, fread($handle, filesize('students.txt')));
        for ($i=0;$i<count($var1);$i++) {
             $var2 = explode(",", $var1[$i]);
             if ($var2[0] == $id) {
                 unset($var1[$i]);
                 $handle1 = fopen('students.txt', 'w');
                 fwrite($handle1, implode(PHP_EOL , $var1));
                 fclose($handle1);
                 echo '<meta http-equiv="refresh" content="0;URL=admin_page.php">';
             }
        }
?>
        </body>
</html>