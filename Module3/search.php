<!DOCTYPE HTML>
<html>
<body>
<a href = mainpage.php>back to homepage</a><br>
<?php
	$search_value=$_POST["search"];
	require 'connectingtodatabase.php';
        $stmt=$mysqli->prepare("select title, id from news where title like '%$search_value%'");
	if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
        }
        $stmt->execute();
        $stmt->bind_result($title, $newsid);
        while($stmt->fetch()){
		printf("<a href = 'title.php?newsid=%s'> %s </a><br>",htmlspecialchars($newsid), htmlspecialchars($title));
		if(newsid===null){
			echo'no result';
		}
	}  
	$stmt->close();     
?>
</body>
</html>
