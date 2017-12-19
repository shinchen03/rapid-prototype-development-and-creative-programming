<!DOCTYPE HTML>
<head><title> login page</title></head>
<body>
        <strong>Welcome to wustl news!<br>Please login or browse as a guest click <a href = 'mainpage.php'> HERE </a></strong>
        <?php
        session_start();
        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
        $username = $_SESSION['username'];
        if($username===null)
{
?>


        <form action="checkpassword.php" method="POST">
        USERNAME: <input type="text" name="user"/>
        PASSWORD: <input type="password" name="passwd"/>

        <p>
                <input type="submit" value="Submit" />
                <input type="reset"/>
        </p>
        </form>
               <form action="regist.php" method="POST">

                <input type="submit" value="regist" />

        </form>

<?php
        }

?>
</body>
