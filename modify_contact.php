<?php
require 'site_functions.php';
//applying the '_get' functions
$id = _get('id');
$uname = _get('uname');
$fname = _get('fname');
$lname = _get('lname');
$email = _get('email');
$phone = _get('phone');
$facebook = _get('facebook');
$twitter = _get('twitter');
$error_info = '';
$check1 = '';
$check2 = '';
$check3 = '';
$check4 = '';
//when we press the Modify link, the program fills the form information from the browser.
if (isset($_POST['modify'])) {
    $id = $_POST['record_id'];
	$uname = $_POST['uname'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $error = "<font color='red'>*</font>";
    //checking entered information for errors.
	//if some errors are found, they are shown in the form.
    if (empty($_POST['uname']) || empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['email'])) {
        $error_info = "<font color='red'><p class='text-error'>* This is a mandatory field.</p></font>";
        if (empty($_POST['fname']))
            $check1 = $error;
        if (empty($_POST['lname']))
            $check2 = $error;
        if (empty($_POST['email']))
            $check3 = $error;
		if (empty($_POST['uname']))
            $check4 = $error; 
    }else {
		//otherwise, we connect to the database
        $link = mysqli_connect('localhost','','');
		//we update his/her information in the table 'users'.
        $query = "UPDATE users SET uname = '$uname', fname = '$fname', lname = '$lname', email = '$email', phone = '$phone',
            facebook = '$facebook', twitter = '$twitter'
            WHERE id = $id";
        mysqli_query($link, $query);
		//returning to the contact.php page.
        echo "<meta http-equiv='refresh' content='0;URL=contact_page.php?id=" . $id . "'>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Modify Contact.</title>

        <!-- Import java script function -->
        <script src="functions/function_js.js" type="text/javascript"></script>

        <!-- Import Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

    </head>
    <body>
        <div class="container">
		<?php echo $error_info; ?>
			<!-- form to fill in with fields such as username, first name, last name, e-mail, phone, facebook, twitter -->
			<!-- username, first name, last name, e-mail are mandatory fields -->
			<!-- if the user did not not fill all information in mandatory fields, and pressed the button modify, -->
			<!-- it shows the error messages where the user forgot to fill information, and saves the information that he/she already filled. -->
            <form action="" method="post">   
				<!-- id is a hidden field. -->
                <input  type="hidden" name="record_id" value="<?php echo $id; ?>" /><br /><br />
				<?php echo $check4; ?>Username: <input  type="text" name="uname" value="<?php echo $uname; ?>" /><br /><br />
                <?php echo $check1; ?>First_name: <input  type="text" name="fname" value="<?php echo $fname; ?>" /><br /><br />
                <?php echo $check2; ?>Last_name: <input  type="text" name="lname" value="<?php echo $lname; ?>" /><br /><br />
                <?php echo $check3; ?>Email: <input  type="text" name="email" value="<?php echo $email; ?>" /><br /><br />
                Phone: <input  type="text" name="phone" value="<?php echo $phone; ?>" /><br /><br />
                Facebook: <input  type="text" name="facebook" value="<?php echo $facebook; ?>" /><br /><br />
                Twitter: <input  type="text" name="twitter" value="<?php echo $twitter; ?>" /><br /><br />
				<!-- the user finish the modifying by clicking the button -->
                <input type='submit' name='modify' value="modify" class="btn" />
				<!-- the user can cancel the modifying by pressing the link. -->
                <a href='contact_page.php' class="btn">Cancel</a><br /><br />
            </form> 
        </div>
    </body>
</html>