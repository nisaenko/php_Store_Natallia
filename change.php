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
//change user to users array
if ((isset($_POST['newpassword'])) && (isset($_POST['repeatnewpassword']))) {
	 if (($_POST['newpassword']) == ($_POST['repeatnewpassword'])) {
			$h2 = fopen('users.txt', 'w');
			fwrite($h2, "admin," . sha1($_POST['newpassword']));
			fclose($h2);
                         header('Location: index.php');
	 } else {
		echo "Passwords don't match";
         }
}
?>
<h1>Change</h1>
<form action='' method='post'>
    New password: <input type='password' name='newpassword'>
    Repeat new password: <input type='password' name='repeatnewpassword'>
    <input type='submit' name='submit' value='change_password'>
    </form>
             </body>
</html>