<!DOCTYPE html>
<head>
<meta charset="utf-8"/>
<title>Matches</title>
<link rel="stylesheet" type="text/css" href="stylesheet2.css" />
</head>
<body>
	<div id="main">


<?php
	require 'databasept.php';
        
        $stmt = $mysqli->prepare("select name, species, weight, description, filename from pets");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
         
        $stmt->execute();
         
        $stmt->bind_result($name, $species, $weight, $description, $filename);
         
        //echo "<ul>\n";
        while($stmt->fetch()){

		printf("%s", htmlspecialchars($name));
		printf("%s", htmlspecialchars($email));
		printf("%s", htmlspecialchars($description));
		printf("%d", htmlspecialchars($age));
        //printf("<a href ='img.php?filename=%s/'>click for img</a></td>", htmlspecialchars($filename));
		$fullpath = sprintf("http://ec2-52-33-167-217.us-west-2.compute.amazonaws.com/img.php?filename=$filename/");
		//printf("<img src='$fullpath' alt='text' />");
           // printf("<img class = \"displayed\" src = \"%s\" >",$full_path);
		//printf("<img src="$fullpath" />");
		}
        //echo "</ul>\n";
         
        $stmt->close();
?>        </table>

</div>
</body>
</html>