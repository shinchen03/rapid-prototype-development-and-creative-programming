<?php
session_start();
        header("Content-Type: application/json");
require 'database5.php';
$eventid = (string)$_POST['eventid'];
$username = $_SESSION['username'];
$stmt = $mysqli->prepare("select title, date, id, location, description, time from event where id = ?");
$stmt->bind_param('s', $eventid);
$stmt->execute();
//$stmt->bind_result($title, $eventid, $date);
$eventdata=[];


	$result = $stmt->get_result();
	$count=0;
	while($row = $result->fetch_assoc()){
		$item = [];
        
		$item['title']= $row["title"];
		$item['date'] = $row["date"];
		$item['id'] = $row["id"];
        $item['location']= $row["location"];
		$item['description'] = $row["description"];
        $item['time']= $row["time"];
		//echo json_encode($item);
		array_push($eventdata,$item);
		//array_push($item,$row["title"],$row["date"],$row["id"]);
		//array_push($eventdata,$item);
		$count++;
	}
	echo json_encode( array("editdata"=>$eventdata,
				"count"=>$count));
	
    $stmt->close();
	exit;
?>