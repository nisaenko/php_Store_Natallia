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
$title=_get('title');
$first_name=_get('first_name');
$last_name=_get('last_name');
$email=_get('email');
$site=_get('site');
$cell_number=_get('cell_number');
$home_number=_get('home_number');
$office_number=_get('office_number');
$twitter_url=_get('twitter_url');
$facebook_url=_get('facebook_url');
$comment=_get('comment');
$picture=_get('picture');
?>        
         <form action="edit.php" method="">            
    * Title
      <input  type="text" name="title" value="<?php echo $title; ?>" /><br />
    * First Name
    <input type="text" name="first_name" value="<?php echo $first_name; ?>" /><br />
        * Last Name
    <input type="text" name="last_name" value="<?php echo $last_name; ?>" /><br />
     E-mail
      <input type="email" name="email" value="<?php echo $email; ?>" /><br />
      Site
      <input type="text" name="site" value="<?php echo $site; ?>"  /><br />
    Cell Number
    <input type="text" name="cell_number" value="<?php echo $cell_number; ?>"  /><br />
          Home Number
      <input type="text" name="home_number" value="<?php echo $home_number; ?>"  /><br />
      Office Number
      <input type="text" name="office_number" value="<?php echo $office_number; ?>"  /><br />
      Twitter URL
      <input type="text" name="twitter_url" value="<?php echo $twitter_url; ?>"  /><br />
   Facebook URL
   <input type="text" name="facebook_url" value="<?php echo $facebook_url; ?>"  /><br />
    Comment
    <textarea rows="2" cols="7" name="comment" value="<?php echo $comment; ?>" > </textarea><br />
       <input type="text" name="picture" value="<?php echo $picture; ?>" />
         <input type="hidden" name="record_id" value="<?php echo $id; ?>"/>
           <input type="submit" name="edit_name" value="edit_name" />
			<img src='uploads/<?php echo $picture; ?>' height="100" />
   </form>     
        </body>
</html>