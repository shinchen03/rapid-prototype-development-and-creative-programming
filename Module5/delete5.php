<?php
session_start();
        header("Content-Type: application/json");
require 'database5.php';
$eventid = (string)$_POST['eventid'];
$stmt = $mysqli->prepare("DELETE FROM event WHERE id = ?");
$stmt->bind_param('s', $eventid);
$stmt->execute();
if(!$stmt){
	echo json_encode(array(
		"success" => false,
		"message" => "Regist error"
	));
	
}
else{	echo json_encode(array(
		"success" => true
	));
	}
    $stmt->close();
	exit;
?>