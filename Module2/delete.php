<!DOCTYPE html>

<?php
session_start();

$filename = $_POST['file_to_delete'];
$filename = str_replace(array('/'),'',$filename);
$username = $_SESSION['username'];
$full_path = sprintf("/srv/uploads/%s", $username);
if($od=opendir($full_path))
{
        while(($file=readdir($od))!==false)
        {
                if($file === $filename){
                        $filename = sprintf("/srv/uploads/%s/%s", $username,$filename);
                        $result = unlink($filename);
                        echo "Congratulation! You have successful deleted your file";
                        header("refresh:2; url=funtion.php");
                }
         }
}

?>