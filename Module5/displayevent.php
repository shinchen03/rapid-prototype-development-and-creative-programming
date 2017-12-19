<?php
session_start();
        header("Content-Type: application/json");
require 'database5.php';
$username = $_SESSION['username'];
$stmt = $mysqli->prepare("select title, id, date from event where username = ? or `group` = ?");
$stmt->bind_param('ss', $username, $username);
$stmt->execute();

$eventdata=[];


	$result = $stmt->get_result();
	$count=0;
	while($row = $result->fetch_assoc()){
		$item = [];
		$item['title']= $row["title"];
		$item['date'] = $row["date"];
		$item['id'] = $row["id"];
		array_push($eventdata,$item);
		$count++;
	}

	
	echo json_encode( array("eventdata"=>$eventdata,
				"count"=>$count));
    $stmt->close();
	exit;
?>