<?php
session_start();
require 'connectingtodatabase.php';
$userid=(int)$_SESSION['userid'];
$usercountry=(string)$_SESSION['usercountry'];
$newsid=(int)$_SESSION['newsid'];
$content = (string)$_POST['comment'];
$now = date('Y/m/d');

$stmt = $mysqli->prepare("insert into comment (user_id, news_id, content, date) values (?, ?, ?, ?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
 
$stmt->bind_param('ssss', $userid, $newsid, $content, $now);
 
$stmt->execute();
 
$stmt->close();
echo 'comment success';
header("refresh:2; url=title.php?newsid=$newsid"); 
?>
