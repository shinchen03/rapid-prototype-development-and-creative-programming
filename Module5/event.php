<?php
session_start();
        header("Content-Type: application/json");
require 'database5.php';
$deleteflag = (string)$_POST['deleteflag'];
$eventid = (string)$_POST['eventid'];
$username = (string)$_session['username'];
$title = (string)$_POST['title'];
$location = (string)$_POST['location'];
$date = $_POST['date'];
$time = $_POST['time'];
$description = (string)$_POST['description'];
$group = (string)$_POST['goroup']

if($group!==null){
	$stmt = $mysqli->prepare("select username from users");
	$stmt->execute();
	$result = $stmt->get_result();
	while($row = $result->fetch_assoc()){			
		if($group===htmlspecialchars( $row["username"] ))
	{
		
		$stmt = $mysqli->prepare("insert into event (username, title, location, date, time, description, group) values (?, ?, ?, ?, ?, ?, ?)");
        if(!$stmt){
                echo json_encode(array(
                        "success" => false,
                        "message" => "write event error"
                ));

        }
        else{   echo json_encode(array(
                        "success" => true
                ));
                }

        $stmt->bind_param('ssssss', $username, $title, $location, $date, $time, $description, $group);
		$stmt->execute();
        $stmt->close();
	}
	
}
	echo json_encode(array(
                        "success" => false,
                        "message" => "share with invalid username"
                ));
}	else{


        $stmt = $mysqli->prepare("insert into event (username, title, location, date, time, description, group) values (?, ?, ?, ?, ?, ?, ?)");
        if(!$stmt){
                echo json_encode(array(
                        "success" => false,
                        "message" => "write event error"
                ));

        }
        else{   echo json_encode(array(
                        "success" => true
                ));
                }

        $stmt->bind_param('ssssss', $username, $title, $location, $date, $time, $description, $group);
 $stmt->execute();
        $stmt->close();
        exit;

}                                           
													
													// add event to the calendar



?>