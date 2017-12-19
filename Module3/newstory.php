<!DOCTYPE HTML>
<?php
session_start();
require 'connectingtodatabase.php';
$username = (string)$_SESSION['username'];
$authorid= (int)$_SESSION['userid'];
$title = (string)$_POST['title'];
$newstory = (string)$_POST['newstory'];
$newsid = (int)$_SESSION['newsid'];
$introduction = (string)$_POST['introduction'];
$category = (string)$_POST['category'];
$date = date('Y/m/d');
$stmt = $mysqli->prepare("insert into news (title, content, introduction, category, date, author_id, browse) values (?, ?, ?, ?, ?, ?,0)");
if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
}

$stmt->bind_param('sssssi', $title, $newstory, $introduction, $category, $date, $authorid);
$stmt->execute();
$stmt->close();
echo'Submit success!!';
header("refresh:2; url=mainpage.php");
?>
