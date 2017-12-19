<?php
session_start();
require 'connectingtodatabase.php';
 
$content = (string)$_POST['updatecomment'];
$commentid = (int)$_SESSION['commentid'];
$newsid = (int)$_SESSION['newsid'];
$stmt = $mysqli->prepare("UPDATE comment SET content=? WHERE id=?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
 
$stmt->bind_param('ss', $content, $commentid);
 
$stmt->execute();
 
$stmt->close();
header("Location: title.php?newsid=$newsid"); 
?>
