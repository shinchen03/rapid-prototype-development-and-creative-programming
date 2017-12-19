<!DOCTYPE HTML>
<?php
session_start();
require 'databasepet.php';
$username = $_POST['username'];
$passwd = $_POST['password'];
  
$stmt = $mysqli->prepare("select username, password from users");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
 
$stmt->execute();
 
$result = $stmt->get_result();
 
echo "<ul>\n";
while($row = $result->fetch_assoc()){
	//printf("%s%s\n",
	//	htmlspecialchars( $row["name"] ),
	//	htmlspecialchars( $row["passwd"] ));
	
		
	if($username===htmlspecialchars( $row["username"] )&& $password===htmlspecialchars( $row["password"] ))
{
	echo 'login successful!';
	$_SESSION['username']=$username;
	header("refresh:2; url=add-pet.php");
        $stmt->close();        
	exit;
}
	
}

echo "</ul>\n";
echo 'invalid username or passwd'; 
$stmt->close();
?>

