<?php
session_start(); //DONT FORGET SESSION START
  if (!(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==1)) {
        echo "error - not logged in";
        die();
    }
require 'site_functions.php';
?>
<script language="JavaScript" type="text/JavaScript">
    function validateData(){
        alert("hello");
         window.event.returnValue = false;
    }
</script>
<!DOCTYPE html>
<html lang ="en">
	<head>
		<meta charset="utf-8">
		<title> </title>
	</head>
	<body>
                   <?php
 echo getcwd ();
if (isset($_FILES['userfile']))
    {
     $uploaddir = '/home/assignments/uploads/';
     $bb = basename($_FILES['userfile']['name']);
     $uploadfile = $uploaddir . $bb ;
     echo "<p>";
     if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
       echo "File is valid, and was successfully uploaded.\n";
            
     } else {
        echo "Upload failed";
     }
}
else {
     echo "File not set";
}
?>   <br />
           <form enctype="multipart/form-data" action="" method="POST">
     Send this file: <input name="userfile" type="file" />
          <input type="submit" name="send_file" value="Upload" /><br />
</form>  
            <form action="" method="">        
    * Title
      <input  type="text" name="title" value="" /><br />
    * First Name
    <input type="text" name="first_name" value="" /><br />
        * Last Name
    <input type="text" name="last_name" value="" /><br />
     E-mail
      <input type="email" name="e-mail" value="" /><br />
      Site
      <input type="text" name="site" value=""  /><br />
    Cell Number
    <input type="text" name="cell_number" value=""  /><br />
          Home Number
      <input type="text" name="home_number" value=""  /><br />
      Office Number
      <input type="text" name="office_number" value=""  /><br />
      Twitter URL
      <input type="text" name="twitter_url" value=""  /><br />
   Facebook URL
   <input type="text" name="facebook_url" value=""  /><br />
    Comment
    <textarea rows="2" cols="7" name="comment" value="" > </textarea><br />
    <input type='submit' name='add' value="add" /><br />
    <input type="hidden" name="11" value="<?php echo $bb; ?>" />
   </form>         
            <?php
if(_get('add'))
  {
        add_user();  
  }
  ?>
        </body>
</html>