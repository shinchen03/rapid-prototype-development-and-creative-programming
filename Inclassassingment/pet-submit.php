<?php
session_start();
require 'databasept.php';
if( !isset($_POST['petname']))
{ echo " petname could not be empty!";
exit;
}
if( !isset($_POST['username']))
{ echo " username could not be empty!";
exit;
}
if( !isset($_POST['species']))
{ echo " species could not be empty!";
exit;
}
if( !isset($_POST['weight']))
{ echo " weight could not be empty!";
exit;
}
if( !isset($_POST['description']))
{ echo " description could not be empty!";
exit;
}

$username = (string)$_SESSION['username'];
$name = (string)$_POST['petname'];
$email = (string)$_POST['species'];
$age = (int)$_POST['weight'];
$description = (string)$_POST['description'];
//$_SESSION['name']=$name;
// Get the filename and make sure it is valid
$filename = basename($_FILES['uploadedfile']['name']);
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
    echo $filename;
	echo "Invalid filename";
	exit;
}

$full_path = sprintf("/srv/uploads/%s", $filename);

if( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path) ){
//	header("Location: upload_success.html");
//	exit;
    echo 'sucsess!';} 
//}else{
//	header("Location: upload_failure.html");
//	exit;
//}

$stmt = $mysqli->prepare("insert into pets (username , name, species, weight, description, filename) values (?,?, ?, ?, ?, ?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
// echo $name, $email, $age, $description, $filename;exit;
$stmt->bind_param('sssiss',$username, $name, $species, $weight, $description, $filename);
 
$stmt->execute();
 
$stmt->close();
header("Location: mainlist.php");
exit;
?>