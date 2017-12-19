<!DOCTYPE HTML>
<head><title>pet-login</title></head>
<body>
        <strong>Please login</strong>
<?php
        session_start();
        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
        $username = $_SESSION['username'];
        if($username===null)
{
?>


        <form action="loginpet2.php" method="POST">
        USERNAME: <input type="text" name="username"/>
        PASSWORD: <input type="password" name="password"/>

        <p>
                <input type="submit" value="Submit" />
                <input type="reset"/>
        </p>
        </form>
               <form action="registpet.php" method="POST">

                <input type="submit" value="regist" />

        </form>

<?php
        }

?>
</body>
