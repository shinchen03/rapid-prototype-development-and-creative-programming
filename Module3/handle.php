<!DOCTYPE html>
<html>
<head></head>
<body>
<?php
    session_start();
    $newsid = (int)$_SESSION['newsid'];
    $commentid = (int)$_GET['commentid'];
    $_SESSION['commentid'] = $commentid;
    $userid = (int)$_SESSION['userid'];
    $action = (string)$_GET['action'];
    
    require 'connectingtodatabase.php';
    if($action === 'delete'){
         $stmt = $mysqli->prepare("DELETE FROM comment WHERE id = '$commentid' and user_id = '$userid'");
     		    
    } else if ($action == 'edit'){
        $stmt = $mysqli->prepare("SELECT content from comment WHERE id = '$commentid' and user_id= '$userid'");   
   	//$stmt->bind_param('ii',$commentid, $userid);
    }
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->execute();
    if($action == "delete"){
        $stmt->close();
        header("Location: title.php?newsid=$newsid");
        exit();
    } else if ($action == 'edit'){
        $stmt->bind_result($content);
        echo "\n";
        while($stmt->fetch()){ 
	$updatecomment = htmlspecialchars($content);
	} 
	echo 'Please edit your comment';
        echo '<br><form action="updatecomment.php" method="POST">';
	printf("<TEXTAREA cols='100' rows='15' name='updatecomment'> %s </TEXTAREA>",$updatecomment);
		
	
	echo '<br><input type="submit" value="submit">';
        echo '<input type="reset" value="reset">';
        echo '</form>';    
    }
        $stmt->close();
    
?>
</body>
</html>


