<!DOCTYPE HTML>
    <html>
        <head>
            <link rel="stylesheet" type="text/css" href="stylesheet2.css" />
            <title>Add New Pet</title>
        </head>
        <body>
            <h1>Add New Pet</h1>
            <form enctype="multipart/form-data" action="pet-submit.php" method="POST">
                <ul><li>
                <label for="petname">petname:</label>
                <input type="text" name = "petname" />
                </li>
                <br><br>
                <li>
                <label for="username">username:</label>
                <input type=text name= "username" />
                </li>
                <li>
                <br><br>
                <li>
                <label for ="species">select species:</label>
                <select name="species">
                <option value="cat">cat</option>
                <option value="dog">dog</option>
                <option value="chinchilla">chinchilla</option>
                <option value="snake">snake</option>
                <option value="rabbit">rabbit</option>
                </select></li>
                <br><br>
                <li>
                <label for="weight">weight</label>
                <input type="number" name = "weight" />
                </li>
                <br><br>
                <li>
                <label for ="description">Description here</label>
                <textarea name="description" cols="40" rows="4"></textarea>
                </li>
                <br><br>
                <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
                <label for="uploadfile_input">Choose a file to upload:</label>
                <input name="uploadedfile" type="file" id="uploadfile_input"/>
                <br><br>
                <input type ="submit" name="submit" value="Upload"/>
                </ul>      
            </form>
            <form enctype="multipart/form-data" action="pet-login.php" method="POST">
                <input type ="submit" name="login" value="login"/>
            </form>
            
            
            
        </body>
            
    </html>