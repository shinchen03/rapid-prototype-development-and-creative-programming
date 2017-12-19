<!DOCTYPE HTML>
<html>
        <body>
        <link rel="stylesheet" type="text/css" href="stylesheet.css" />
        <br><br>
        <div id = "title">WRITE YOUR OWN STORY</div>
        <br><br>
        <form action="newstory.php" method="post">
        <label for="Title">Title:</label>
        <TEXTAREA cols=100" rows="2" name="title"></TEXTAREA><br>
        <label for="Category">Category:</label>
        <select name="category">
        <option value="OWN STORY">OWN STORY</option>
	<option value="NEWS">NEWS</option>
        <option value="TECHNOLOGY">TECHNOLOGY</option>
        <option value="ENTERTAINMENT">ENTERTAINMENT</option>
        </select><br>
        <label for="Introduction">Introduction:</label>
        <TEXTAREA cols="100" rows="5" name="introduction"></TEXTAREA><br>
        <label for="Story">Story:</label>
        <TEXTAREA cols="100" rows="30" name="newstory"></TEXTAREA>
        <div id="sub">
        <input type="submit" value="submit" style="height:40px;width:100px;">
        <input type="reset" value="reset" style="height:40px;width:100px;">
        </div>
        </form>
        </body>
</html>
