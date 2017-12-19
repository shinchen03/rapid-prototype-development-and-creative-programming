<?php
require 'database5.php';
$username = (string)htmlentities($_POST['username']);
$pwd = (string)htmlentities($_POST['password']);

$hash_pwd = password_hash($pwd, PASSWORD_DEFAULT);
$stmt = $mysqli->prepare("select username from users");
if(!$stmt){
           printf("Query Prep Failed: %s\n", $mysqli->error);
           exit;
          }
$stmt->execute();
$stmt->bind_result($name);
while($stmt->fetch()){
        if($username === $name)
        {
                echo json_encode(array(
                "success" => false,
                "message" => "exist username"
        ));
        exit;
        }
}


$stmt = $mysqli->prepare("insert into users (username, password) values (?, ?)");
if(!$stmt){
        echo json_encode(array(
                "success" => false,
                "message" => "Regist error"
        ));

}
else{   echo json_encode(array(
                "success" => true
        ));
        }

$stmt->bind_param('ss', $username,$hash_pwd);

$stmt->execute();
$stmt->close();
exit;
?>