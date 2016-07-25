<?php
require 'site_functions.php';
?>
<!DOCTYPE html>
<html lang ="en">
    <head>
        <meta charset="utf-8">
        <title>Register Page</title>
        <!-- Import Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>   
        <div class="container">
            <?php
            $uname = '';
            $password = '';
            $fname = '';
            $lname = '';
            $email = '';
            $phone = '';
            $facebook = '';
            $twitter = '';
            $error = "<font color='red'>*</font>";
            $error_info = '';
            $check1 = "";
            $check2 = "";
            $check3 = "";
			//if we press the button Register, the program reads information from the following fields.
            if (isset($_REQUEST['add']) && $_REQUEST['add']) {
                $uname = $_POST['uname'];
                $password = $_POST['password'];
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $facebook = $_POST['facebook'];
                $twitter = $_POST['twitter'];
                //checking entered information for errors.
				//if some errors are found, they are shown in the form.
                if (empty($_POST['uname']) || empty($_POST['password']) || empty($_POST['email'])) {
                    $error_info = "<font color='red'><p class='text-error'>* This is a mandatory field.</p></font>";
                    if (empty($_POST['uname']))
                        $check1 = $error;
                    if (empty($_POST['password']))
                        $check2 = $error;
                    if (empty($_POST['email']))
                        $check3 = $error;
                }else {
					//otherwise, we connect to the database
                    $link = mysqli_connect('localhost', 'j3pteam6_admin', 'fZ5V_uZ(2Hu(', 'j3pteam6_gbsbe');
                    if (mysqli_connect_error()) {
                        print "cannot connect to database";
                        die();
                    }
					//define variables and hash the password to make it more strong
                    define("SALT", 'abcdefg');
                    $uname = mysqli_real_escape_string($link, $_REQUEST['uname']);
                    $password = hash('sha512', mysqli_real_escape_string($link, $_REQUEST['password']) . "SALT");
                    $fname = mysqli_real_escape_string($link, $_REQUEST['fname']);
                    $lname = mysqli_real_escape_string($link, $_REQUEST['lname']);
                    $email = mysqli_real_escape_string($link, $_REQUEST['email']);
                    $phone = mysqli_real_escape_string($link, $_REQUEST['phone']);
                    $facebook = mysqli_real_escape_string($link, $_REQUEST['facebook']);
                    $twitter = mysqli_real_escape_string($link, $_REQUEST['twitter']);
					//checking username if it is repeting.
                    $uname_checking = "SELECT uname FROM users
                                   WHERE '$uname' = `uname`";
                    if (@mysqli_num_rows(mysqli_query($link, $uname_checking)) == 1) {
					//if username is taken, it will show the error.
                        $error_info = "<font color='red'><p class='text-error'>* The user name is already taken.</p></font>";
                    } else {
					//if username does not repeat, we insert his/her information into the table 'users' into database 'gbsbe'
                        $query = "INSERT INTO users SET uname = '$uname', password = '$password',
                                   fname = '$fname', lname = '$lname', email = '$email',
                                   phone = '$phone', facebook = '$facebook', twitter = '$twitter'";
                        mysqli_query($link, $query);
						//returning to the index.php page and can login.
                        echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
                    }
                }
            }
            ?>
            <h3>Register</h3>
            <hr />
            <?php echo $error_info; ?>
			<!-- form to fill in with fields such as username, password, first name, last name, e-mail, phone, facebook, twitter -->
			<!-- username, password, e-mail are mandatory fields -->
			<!-- if the user did not not fill all information in mandatory fields, and pressed the button Register, -->
			<!-- it shows the error messages where the user forgot to fill information, and saves the information that he/she already filled. -->
            <form action="" method="post">  
                <!-- id and status are hidden fields. -->		
                <input  type="hidden" name="id" value="" /><br /><br />
                <?php echo $check1; ?>Username: <input type="text" name="uname" value="<?php echo $uname; ?>" /><br /><br />
                <?php echo $check2; ?>Password: <input type="password" name="password" value="<?php echo $password; ?>" /><br /><br />
                First_name: <input type="text" name="fname" value="<?php echo $fname; ?>"  /><br /><br />
                Last_name: <input type="text" name="lname" value="<?php echo $lname; ?>"  /><br /><br />
                <?php echo $check3; ?>E-mail: <input type="text" name="email" value="<?php echo $email; ?>"  /><br /><br />
                Phone: <input type="text" name="phone" value="<?php echo $phone; ?>"  /><br /><br />
                Facebook: <input type="text" name="facebook" value="<?php echo $facebook; ?>"  /><br /><br />
                Twitter: <input type="text" name="twitter" value="<?php echo $twitter; ?>"  /><br /><br />
				<!-- status can be: pending, active, or decline. Default value is pending. -->
                <input type="hidden" name="status" value=""  /><br />
				<!-- the user finish the registration by clicking the button -->
                <input type='submit' name='add' value="Register" class="btn" />
				<!-- the user can cancel the registration by pressing the link. -->
                <a href='index.php' class="btn">Cancel</a><br /><br />
            </form>  
        </div>
    </body>
</html>
