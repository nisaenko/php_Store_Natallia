<?php
require 'site_functions.php';
{
$err_t="";
      $err_f="";
      $err_l="";
      $is_allowed=0;
    $id=_get('record_id');
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
    $handle=fopen('students.rtf','r');
    $var1=explode(PHP_EOL, fread($handle, filesize('students.rtf')));
    
        for ($i=0;$i<count($var1);$i++) {
             $var2 = explode(",", $var1[$i]);
    
             if ($var2[0] == $id) {
                 $var1[$i] = "$id,$title,$first_name,$last_name,$email,$site,$cell_number,$home_number,$office_number,$twitter_url,$facebook_url,$comment,$picture";
                 $handle1 = fopen('students.rtf', 'w');
                 fwrite($handle1, implode(PHP_EOL , $var1));
                 fclose($handle1);          
             }}  }  
else if($err_t || $err_f || $err_l){
        echo "<script>alert('".$err_t.$err_f.$err_l."')</script>";
}
      
          echo '<meta http-equiv="refresh" content="0;URL=admin_page.php">';
}