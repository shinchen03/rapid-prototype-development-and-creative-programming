<?php
session_start();

$filename = $_POST['file_to_view'];

$filename = str_replace(array('/'),'',$filename);
$username = $_SESSION['username'];
$full_path = sprintf("/srv/uploads/%s/%s", $username, $filename);
$finfo = new finfo(FILEINFO_MIME_TYPE); //get the mime type
$mime = $finfo->file($full_path);
header("Content-Type: ".$mime);//set the content type header to the mime type of the file and display it
readfile($full_path);

?>
