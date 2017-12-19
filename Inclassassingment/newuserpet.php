<!DOCTYPE HTML>
<?php
require 'databasept.php';
$username = $_POST['username'];
$passwd = $_POST['password'];
$pwd = password_hash($passwd, PASSWORD_DEFAULT);
$stmt = $mysqli->prepare("select username from users");
if(!$stmt){
           printf("Query Prep Failed: %s\n", $mysqli->error);
           exit;
          }
$stmt->execute();

$stmt = $mysqli->prepare("insert into users (username, password) values (?, ?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
 
$stmt->bind_param('ss', $username,$pwd);
 
$stmt->execute(); 
$stmt->close();
echo'welcome!';
header("refresh:2; url=pet-submit.php");

?>
