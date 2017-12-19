<!DOCTYPE html>

<?php
session_start();
$filename = $_POST['file_to_download'];
$filename = str_replace(array('/'),'',$filename);
$full_path = sprintf("/srv/uploads/%s", $username);
$filepath = $full_path."/".$filename;
header('Content-Type: application/force-download');
header('Content-Length: '.filesize($filepath));
header('Content-disposition: attachment; filename="'.$filename.'"');
readfile($filepath);
?>