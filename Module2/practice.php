<!DOCTYPE HTML>
<head><title> simple calculator</title></head>
<body>
        <form action="htmlFormActionGet.php" method="POST">
        First number: <input type="text" name="num1"/>
        Second number: <input type="text" name="num3"/>
        <p>
                <strong>method:</strong>
                <input type="radio" name="method" value="multiple" id="multiple"/> <label>Multiple</label> &nbsp;
                <input type="radio" name="method" value="plus" id="plus"/> <label>Plus</label> &nbsp;
                <input type="radio" name="method" value="minus" id="minus"/> <label>Minus</label> &nbsp;
                <input type="radio" name="method" value="divide" id="divide"/> <label>Divide</label>
        </p>
        <p>
                <input type="submit" value="Submit" />
                <input type="reset"/>
        </p>
        </form>

</body>
