<?php
session_start(); //DONT FORGET SESSION START
require 'site_functions.php';
//check if user has filled out the form
if(isset($_POST['usrnme'])){
	//check if credentials are correct
	if(authenticate($_POST['usrnme'], $_POST['pass'])){
		$_SESSION['logged_in'] = 1;
		$_SESSION['user_n'] = $_POST['usrnme'];
	}else{ //inform user of an error
		$err = "Invalid username or password";
	}
//check if user has clicked log out
}else if(isset($_GET['logout'])){
	unset($_SESSION['logged_in']);
	unset($_SESSION['user_n']);
}
?>
<!DOCTYPE html>
<html>
    <head>
<style type="text/css">
#wrap {
   width:800px;
   margin:0 auto;
}
#left_col {
   float:center;
}
#right_col {
   float:right;
   width:200px;
}
</style>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
<div id="wrap">
    <div id="left_col">
        <h1>Welcome to my Book</h1>
	<?php if(isset($err)){
            echo '<span style="color:red;">' . $err .'</span>';
	}?>
        <form action="index.php" method="post">
            Username: <input type="text" name="usrnme" value="admin" ><br>
            Password: <input type="password" name="pass"value="123"><br>
            <input type="submit" value="login">      
        </form>
    </div>
    <div id="right_col">
        	<?php if(is_logged_in()):
               echo '<meta http-equiv="refresh" content="0;URL=admin_page.php">';
                ?>
	<?php else : ?>
	
		<?php
			if(isset($_SESSION['msg'])){
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			}		
		?>		
	<?php endif;?>
    </div>
</div>
     </body>
</html>