<?php
if (isset($_FILES['userfile']))
            {
             
                $uploaddir = '/home/assignments/uploads/';
                $bb = basename($_FILES['userfile']['name']);
                $uploadfile = $uploaddir . $bb ;
     if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {           
     } else {
        echo "Upload failed";
     }
     echo '<meta http-equiv="refresh" content="0;URL=add.php">';
            }