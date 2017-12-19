<!DOCTYPE HTML>
<?php
require 'connectingtodatabase.php';
$username = $_POST['username'];
$passwd = $_POST['password'];
$country = $_POST['country'];
$pwd = password_hash($passwd, PASSWORD_DEFAULT);
$stmt = $mysqli->prepare("select name from users");
if(!$stmt){
           printf("Query Prep Failed: %s\n", $mysqli->error);
           exit;
          }
$stmt->execute();
$stmt->bind_result($name);
while($stmt->fetch()){
	if($username === $name)
	{
	echo 'exist username or invalid username/passwd';
	header("refresh:2; url=regist.php");
	exit;
	}
}
	

$stmt = $mysqli->prepare("insert into users (name, passwd, country) values (?, ?, ?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
 
$stmt->bind_param('sss', $username,$pwd,$country);
 
$stmt->execute(); 
$stmt->close();
echo'welcome to wustl news';
header("refresh:2; url=mainpage.php");

?>
