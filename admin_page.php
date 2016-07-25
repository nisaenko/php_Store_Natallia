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
<a href="index.php?logout=true" style="float:right;">LOGOUT</a></br>
<form action="search.php?sea=<?php _get("search"); ?>" method="">
 <input type="text" name="search" value="" style="float:right;" />
  <input type="submit" name="search_b" value="search" style="float:right;" />
 </form>
<div  style="float:center"><h1>Welcome to Admin's Page</h1><br /></div>
    <div style='float:left;'>
        <a href="add.php">Create new contact</a><br />
          <a href="change.php">Change</a>
    </div>
    <div style="float:right;">
    <table border="1">
    <tr>
      <th>Title</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Picture</th>
      <th>View</th>
      <th>Modify</th>
      <th>Delete</th>
  </tr>
  <tbody>
      <?php if (filesize("students.rtf") != 0) {    
            get_students();
      }else { ?>
      <tr><td colspan='7'>No students records found</td></tr>
      <?php }?>
  </tbody>
  </table>
    </div>
        </body>
</html>