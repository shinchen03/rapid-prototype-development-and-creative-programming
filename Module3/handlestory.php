<!DOCTYPE html>
<html>
<head></head>
<body>
<?php
    session_start();
    $newsid = $_SESSION['newsid'];

    $_SESSION['commentid'] = $commentid;
    $userid = $_SESSION['userid'];
    $action = $_GET['action'];
    $newsid = $_SESSION['newsid'];
    require 'connectingtodatabase.php';
    if($action === 'delete'){
         $stmt = $mysqli->prepare("DELETE FROM news WHERE id = $newsid");

    } else if ($action == 'edit'){
        $stmt = $mysqli->prepare("SELECT content, introduction, title from news WHERE id = $newsid");

    }
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->execute();
    if($action == "delete"){
        $stmt->close();
        header("Location: mainpage.php");
        exit();
    } else if ($action == 'edit'){
        $stmt->bind_result($content, $introduction, $title);
        echo "\n";
        while($stmt->fetch()){
        $updatecontent = htmlspecialchars($content);
	$updateintroduction = htmlspecialchars($introduction);
	$updatetitle = htmlspecialchars($title);
	}        
        echo '<link rel="stylesheet" type="text/css" href="stylesheet.css" />';
        echo '<br><br>';
        echo '<div id = "title">EDIT YOUR STORY</div>';
        echo '<br><br>';
        echo '<form action="editstory.php" method="post">';
        echo '<label for="Title">Title:</label>';
        printf("<TEXTAREA cols='100' rows='2' name='title'>%s</TEXTAREA><br>",$updatetitle);
        echo '<label for="Category">Category:</label>';
        echo '<select name="category">';
        echo '<option value="OWN STORY">OWN STORY</option>';
        echo '<option value="TECHNOLOGY">TECHNOLOGY</option>';
        echo '<option value="ENTERTAINMENT">ENTERTAINMENT</option>';
        echo '</select><br>';
        echo '<label for="Introduction">Introduction:</label>';
        printf("<TEXTAREA cols='100' rows='5' name='introduction'>%s</TEXTAREA><br>",$updateintroduction);
        echo '<label for="Story">Story:</label>';
        printf("<TEXTAREA cols='100' rows='30' name='content'>%s</TEXTAREA>",$updatecontent);
        echo '<div id="sub">';
        echo '<input type="submit" value="submit" style="height:40px;width:100px;">';
        echo '<input type="reset" value="reset" style="height:40px;width:100px;">';
        echo '</div>';
        echo '</form>';
        $stmt->close();
	}

?>
</body>
</html>

