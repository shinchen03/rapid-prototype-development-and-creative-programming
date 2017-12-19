<!DOCTYPE html>
<html>
    <title>Content</title>    <style type="text/css">
        div#titale{
            text-align: center;
            font-size: 25px;
            font-weight: bold;
        }
	main{
	    text-align: center;
	    font-size: 20px;
	}
	div#read{
	    text-align: right;
	}
	
    </style>
    <body>
	<td><a href = mainpage.php>back to homepage</a>
                      

	<CENTER>
        <table border = "0.5">
            <?php
                session_start();
                $newsid = (int)$_GET['newsid'];
		if($newsid===null)
		{
		$newsid=(int)$_SESSION['newsid'];
		}
		$_SESSION['newsid'] = htmlspecialchars($newsid);
                $username = (string)$_SESSION['username'];
		//
                require 'connectingtodatabase.php';
		$stmt = $mysqli->prepare("select title, content, date, browse, users.name from news join users on(news.author_id=users.id) 
			where news.id = ?");

		$stmt->bind_param('i',$newsid);
                if(!$stmt){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                $stmt->execute();
                //$stmt->bind_result($title, $content, $date, $browse, $authorname);
                $stmt->bind_result($title, $content, $date, $browse, $authorname);
		while($stmt->fetch()){

		printf("\t<br><tr><div id='title'> %s</div></tr>", htmlspecialchars($title));
		printf("<tr><td><main> %s</main></td> </tr>", htmlspecialchars($date));
		printf("<tr><td><main> %s </main></td></tr>", htmlspecialchars($authorname));
		printf("<tr><td><div id='read'> Views %s </div></td></tr>", htmlspecialchars($browse));
		if($username == $authorname){
                printf("<td><center><a href = handlestory.php?commentid=$id&action=edit>edit</a>/
                       <a href = handlestory.php?commentid=$id&action=delete>delete</a></center></td>");
            	}
            	else
		{
                printf("<td></td>");
        	}
                printf("<tr><td><main> %s </main></td></tr><br><br>", htmlspecialchars($content));
		}
		$stmt = $mysqli->prepare("update news set browse = browse + 1 where id = ?");
		$stmt->bind_param('i',$newsid);
		$stmt->execute();
                $stmt->close();
		
            ?>
        </table></center>
	<br>
	<table border="1" width="800">
		<tr>All Comments:</tr>
	<?php
	    require 'connectingtodatabase.php';
            $stmt = $mysqli->prepare("select comment.id, users.name, users.country, content, date from comment JOIN users on 
	            (users.id=comment.user_id) where comment.news_id=?");
	    $stmt->bind_param('i',$newsid);
            if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
            }
            $stmt->execute();
            $stmt->bind_result($id, $name, $country, $content, $date);
            while($stmt->fetch()){
            	printf("\t<tr><td>%s (%s): %s</td>", htmlspecialchars($name),htmlspecialchars($country),htmlspecialchars($content));
            	printf("<td><center>%s</center></td>",htmlspecialchars($date));
            if($username == $name){
		 printf("<td><center><a href = handle.php?commentid=$id&action=edit>edit</a>/
	               <a href = handle.php?commentid=$id&action=delete>delete</a></center></td>"); 
            }
	    else{
		printf("<td></td>");
	    }
            echo '</tr>';
            }

            $stmt->close();
	?>
	</table>
	<br><br>
	<?php
	if($username!=null)
	{
	echo'<form action="newcomment.php" method="post">';
	echo'<TEXTAREA cols="100" rows="15" name="comment">Write your comment here</TEXTAREA><br>';
	echo'<input type="submit" value="submit">';
	echo'<input type="reset" value="reset">';
	echo'</form>';
	}
	?>
    </body>
</html>
