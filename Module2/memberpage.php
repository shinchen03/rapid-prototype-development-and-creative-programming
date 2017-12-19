<!DOCTYPE html>
<head><title>membersite</title></head>
<?php
session_start();
$user = $_POST["id"];
$password = $_POST["password"];
if(!isset($_POST['id'])||!isset($_POST['password']))
{
	<p>
	echo "Please enter your id and password";
	
	</p>
	
}
elseif(isset($_POST['id'])==chen && isset($_POST['password']==111111))
{
	echo"login success!";	
}
else
{
	<p>
	echo "Invalid username or password";
	
	</p>
	
}
?>