<?php
//check if user is logged in
function is_logged_in(){
	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
		return true;
	}
	return false;
}
//redirect user if not logged in
function bouncer($url){
	if(!is_logged_in()){
		header("Location: $url");
		exit();
	}
}
//gets all users and saves them into $users array
function get_users(){
	$users = array();
	$cred_file = fopen('users.rtf', 'r');
	if(!$cred_file)
		return array();
	while($creds = fgetcsv($cred_file)){
		$users[$creds[0]] = $creds[1];
	}
	fclose($cred_file);     
	return $users;
}
//check user credentials
function authenticate($user, $pass){
    $h2 = fopen('users.rtf', 'r');
    if ($h2) {
        $contacts = explode(",", fread($h2, filesize("users.rtf")));
        fclose($h2);
    }
    if($contacts[0] == $user && $contacts[1] == sha1($pass)){
        return true;
    }    
    return false;
}
//check to see if a user exists
function user_exists($user){
	$users = get_users();
	return isset($users[$user]);
}
//add user to users array
function register_user($user, $pass){
	$users = get_users();
	$users[$user] = sha1($pass);
	write_users($users);
}
//write users to file
function write_users($users){
	$cred_file = fopen('users.rtf', 'w');
	foreach($users as $user=>$pass){
		fputcsv($cred_file, array($user, $pass));
	}
	fclose($cred_file);
}
function get_val($index){
    echo $_POST[$index];
	if(isset($_POST[$index]))
		return $_POST[$index];
}
function _get($name)
  {
      return (isset($_GET[$name]) && !empty($_GET[$name]) ? $_GET[$name] : '');      
  }
function add_user()
  {
      $err_t="";
      $err_f="";
      $err_l="";
      $is_allowed=0;
      $title = _get('title');
      $first_name = _get('first_name');
      $last_name = _get('last_name');
      $email = _get('e-mail');
      $site = _get('site');
      $cell_number = _get('cell_number');
      $home_number = _get('home_number');
      $office_number = _get('office_number');
      $twitter_url = _get('twitter_url');
      $facebook_url = _get('facebook_url');
      $comment = _get('comment');
      $picture = _get('11');
      $fin = fopen('students.rtf','a');
if(!$title){
    $err_t = "Title cannot be empty  \\n";
     $is_allowed=1;
}
if(!$first_name){
  $err_f = "First Name cannot be empty  \\n";
 $is_allowed=1;
}
if(!$last_name){
  $err_l = "Last Name cannot be empty  \\n";
  $is_allowed=1;
}
if ($is_allowed==0)
{
      if($fin)
      {       
      $id = getID(); // we need id only when there is no error
          $record = $id . ',' . $title . ',' . $first_name . ',' . $last_name . ',' . $email . ','
                    . $site . ',' . $cell_number . ',' . $home_number . ',' . $office_number . ','
                    . $twitter_url . ',' . $facebook_url . ',' . $comment . ',' .  $picture ;
          fwrite($fin, $record . PHP_EOL);
          fclose($fin);
      }
}
else if($err_t || $err_f || $err_l){
        echo "<script>alert('".$err_t.$err_f.$err_l."')</script>";
}
     echo '<meta http-equiv="refresh" content="0;URL=admin_page.php">';
  }
function view_contact()     
   { 
       $id=_get('id');
       $found = false;
       $records = file('students.rtf');
       foreach($records as $record):
          $contact = explode (",", $record);
          if(is_array($contact) && !empty($contact[0]) && $id == $contact[0])
          {
             print "we found the contact<br />";
             echo "<table border='1'><tr><td>Title</td><td>First Name</td><td>Last Name</td><td>E-mail</td><td>
                  Site</td><td>Cell number</td><td>Home number</td><td>Office number</td><td>Twitter url</td><td>
                  Facebook url</td><td>Comment</td><td>Picture</td></tr>" . "<tr><td>" . $contact[1]
                  . "</td><td>" . $contact[2] . "</td><td>" .
                  $contact[3] . "</td><td>" . $contact[4] . "</td><td>" . $contact[5] . "</td><td>" .
                  $contact[6] . "</td><td>" . $contact[7] . "</td><td>" . $contact[8] .
                  "</td><td>" . $contact[9] . "</td><td>" . $contact[10] . "</td><td>" . $contact[11] .
                  "</td><td>" . $contact[12] . "</td></tr></table>";
             $found = true;
          }
       endforeach;
       if(!$found)
       {
           print "cannot find the user";
       }
       die;
   }  
function get_students()
{
$i=0;
       $handle = fopen('students.rtf','r+');
       while (!feof($handle))
      {
          $student = fgets($handle);
          $student_data = explode (",", $student);
          if(!is_array($student_data) || empty($student_data[0])) continue;
            print "<tr><td>" . $student_data[1] . "</td>"; 
            print "<td>" . $student_data[2] . "</td>";
            print "<td>" . $student_data[3] . "</td>";    
            echo "<td><img src='uploads/" . $student_data[12] . "' alt='' weight='40px' height='40px' /></td>";
            echo "<td><a href='view.php?id=$student_data[0]'>View</a></td>";
            echo "<td><a href='modify.php?id=$student_data[0]&title=$student_data[1]&first_name=$student_data[2]&last_name=$student_data[3]&email=$student_data[4]&site=$student_data[5]&cell_number=$student_data[6]&home_number=$student_data[7]&office_number=$student_data[8]&twitter_url=$student_data[9]&facebook_url=$student_data[10]&comment=$student_data[11]&picture=$student_data[12]' >Modify</a></td>";
            echo "<td><a href='delete.php?id=$student_data[0]' onclick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td></tr>";
            $i++;
      }      
}
function getID()
{
    $file_name = 'ids';
    if (!file_exists($file_name))
    {
        touch($file_name);
        $handle = fopen($file_name,'r+');
        $id = 0;
    }
 else 
    {
        $handle = fopen($file_name, 'r+');
        $id = fread($handle, filesize($file_name));
        settype ($id, "integer");
    }
    rewind ($handle);
    fwrite($handle, ++$id);
    fclose($handle);
    return $id;
}