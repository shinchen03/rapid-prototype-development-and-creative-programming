<?php
ini_set("session.cookie_httponly", 1);
session_start();
header("Content-Type: application/json");
require 'database5.php';
$username = (string)htmlentities($_POST['username']);
$pwd_guess = (string)htmlentities($_POST['password']);

$stmt = $mysqli->prepare("select COUNT(*), username, password from users where username=?");
if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
}
$stmt->bind_param('s',$username);
$stmt->execute();

$stmt->bind_result($cnt,$username,$pwd_hash);
$stmt->fetch();

if($cnt ==1 && password_verify($pwd_guess,$pwd_hash))
{
        $_SESSION['username']=$username;
        $_SESSION['token'] = substr(md5(rand()), 0, 10);

        echo json_encode(array(
                "success" => true
        ));
        exit;
}
else{
        echo json_encode(array(
                "success" => false,
                "message" => "Incorrect Username or Password"
        ));
}
        $stmt->close();
        exit;

?>