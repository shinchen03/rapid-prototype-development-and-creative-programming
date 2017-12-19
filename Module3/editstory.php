<?php
session_start();
require 'connectingtodatabase.php';

$content = $_POST['content'];
$username = $_SESSION['username'];
$authorid= $_SESSION['userid'];
$title = $_POST['title'];
$introduction = $_POST['introduction'];
$category = $_POST['category'];
$date = date('Y/m/d');
$newsid = $_SESSION['newsid'];

$stmt = $mysqli->prepare("UPDATE news SET content=? ,title=?, introduction=?, category=?, date=? WHERE id=?");
if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
}

$stmt->bind_param('ssssss', $content, $title, $introduction, $category, $date, $newsid);

$stmt->execute();

$stmt->close();
header("Location: title.php?newsid=$newsid");
?>

