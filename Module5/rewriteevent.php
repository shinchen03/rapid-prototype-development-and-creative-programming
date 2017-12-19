<?php
session_start();
        header("Content-Type: application/json");
require 'database5.php';
$id = (string)$_POST['id'];
$username = $_SESSION['username'];
$title = (string)$_POST['title'];
$location = (string)$_POST['location'];
$date = $_POST['date'];
$time = $_POST['time'];
$description = (string)$_POST['description'];


        $stmt = $mysqli->prepare("UPDATE event set username=?, title=?, location=?, date=?, time=?, description=? where id = ?");
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

        $stmt->bind_param('sssssss', $username, $title, $location, $date, $time, $description, $id);
 $stmt->execute();
        $stmt->close();
        exit;

?>