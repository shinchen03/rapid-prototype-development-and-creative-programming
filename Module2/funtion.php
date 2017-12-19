<!DOCTYPE HTML>
<html>
<head><title> login page</title></head>
<?php
session_start();
$username = $_SESSION['username'];
//$path = "/srv/uploads/chen/";
$path = sprintf("/srv/uploads/%s/", $username);

print("<OL>");
//echo '<form method="post" action="browser.hp">';
if ($dh = opendir($path)) {
    while(($file = readdir($dh)) !== false) {
        //printf("<a href="">$file</a>");
        //if($file==='..')
        //{break;}
        if($file!='..' && $file!='.')
{
        print_r($file);
        $filepath = $path."/".$file;
        echo ' &nbsp &nbsp last modified: ' . date ("F d Y H:i:s.", filemtime($filepath));
        echo '&nbsp &nbsp';
        echo round(filesize($filepath)/1024)."KB";
        echo '<br \>';
        echo '<form method="POST" action="browser.php" style="display: inline">';
//      echo '<LI>';
        echo "<input type=hidden name=file_to_view value=".$file."/>";
        echo '<input type="submit" name="file" value="view">';
//      echo 'date("m/d",filetime($path));

        echo '</form>';
        echo '&nbsp &nbsp &nbsp';
        echo '<form method="POST" action="download.php" style="display: inline">';
        echo "<input type=hidden name=file_to_download value=".$file."/>";
        echo '<input type="submit" name="file" value="download">';
        echo '</form>';
//      echo '</form>';

        echo '&nbsp &nbsp &nbsp';
        echo '<form method="POST" action="delete.php" style="display: inline">';
        echo "<input type=hidden name=file_to_delete value=".$file."/>";
        echo '<input type="submit" name="file" value="delete">';
        echo '</form>';
        echo '<br \>';
}
    }


    closedir($dh);
}

//echo '</form>';
?>


<body>
    <form enctype="multipart/form-data" action="uploader.php" method="POST">
        <p>
                <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
                <label for="uploadfile_input">Choose a file to upload:</label> <input name="uploadedfile" type="file" id="uploadfile_input" />
        </p>
		
        <p>
                <input type="submit" value="Upload File" />
        </p>	
</form>
</body>
</html>
