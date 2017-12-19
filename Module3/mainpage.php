<!DOCTYPE html>

<html>

    <head>

        <title>This is main page</title>

    </head>
	<style type="text/css">
        div{
            text-align:center;
            font-size: 30px;
            font-weight: bold;
        }
	main{
		text-align:right;
	}
    </style>
    <body>

        <table border = "1">

            <tr>

                <div>Wustl News</div>

            </tr>

            <tr>

                <td>Category </td>

                <td>Title </td>

                <td>Introduction</td>

                <td>date</td>


            </tr>

            <?php
		session_start();
		$username = (string)$_SESSION['username'];
		if(!($username==null))
		{
		printf("welcome %s !",htmlspecialchars($username));
		echo '<br><br>Search title: <form action="search.php" method="POST">
                <input type="text" name="search"/>&nbsp
                <input type="submit" name="submit" value="Search"/>';
		?>
			
                </form>
		
		<main>
		<form action="logout3.php" method="POST" style="display: inline">
                <input type="submit" value="logout"/>
                </form><br>
		</main>
		<?php
		}else{
		?>
		<main>
		<form action="newssitehomepage.php" method="POST" style="display: inline">
                <input type="submit" value="login"/>
                </form>


		<form method="POST" action="regist.php" style="display: inline">
        	<input type="submit" name="regist" value="regist">
        	</form>
		</main>
		<?php
		}			
                require 'connectingtodatabase.php';
                $stmt = $mysqli->prepare("select id, category, title, introduction, date from news order by id");

                if(!$stmt){

                    printf("Query Prep Failed: %s\n", $mysqli->error);

                    exit;

                }

                $stmt->execute();

                $stmt->bind_result($id, $category, $title, $introduction, $date);

                while($stmt->fetch()){

                printf("\t<tr> <td>");

		printf("<a href = 'category.php?category=%s'>",

                       htmlspecialchars($category));

		printf("%s", htmlspecialchars($category));

                echo '</a></td> <td>';

                printf("<a href = 'title.php?newsid=%s'>",

                       htmlspecialchars($id));
		printf("%s", htmlspecialchars($title));

                printf("</a></td> <td>%s</td> <td>%s</td>",

                        htmlspecialchars($introduction),

                        htmlspecialchars($date)

                );

            ?>


            <?php

                }

                $stmt->close();

            ?>

	<table>

		<?php //a href jump to the write story page?>
		<br><br><div><a href = 'writeyourstory.php'>CLICK HERE TO WRITE YOUR OWN STORY </a></div>
		<br><br><div>Most browsed news</div><br><br>
		<?php
		$stmt = $mysqli->prepare("select id, category, title, introduction, browse from news order by browse desc LIMIT 3");

		if(!$stmt){

                    printf("Query Prep Failed: %s\n", $mysqli->error);

                    exit;

                }

                $stmt->execute();

                $stmt->bind_result($id, $category, $title, $introduction, $browse);

                while($stmt->fetch()){

                printf("\t<tr> <td>");

                printf("<a href = 'category.php?category=%s'>",

                       htmlspecialchars($category));

                printf("%s", htmlspecialchars($category));

                echo '</a></td> <td>';

                printf("<a href = 'title.php?newsid=%s'>",

                       htmlspecialchars($id));
                printf("%s", htmlspecialchars($title));

                printf("</a></td> <td>%s</td> <td>%s</td>",

                        htmlspecialchars($introduction),

                        htmlspecialchars($browse)

                );

            ?>

                <td>browsed </td></tr>

            <?php

                }

                $stmt->close();

            ?>

		
   </body>

</html>



