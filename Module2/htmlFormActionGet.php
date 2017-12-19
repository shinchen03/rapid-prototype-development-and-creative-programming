<!DOCTYPE html>
<head><title>Result</title></head>
<?php
$num1 = $_POST["num1"];
$num2 = $_POST["num2"];
if(isset($_POST['method'])&& $_POST['method']=="plus")
{
	$sum = $num1 + $num2;
	echo "$num1 + $num2 = $sum";
}
if(isset($_POST['method'])&& $_POST['method']=="multiple")
{
	$result = $num1*$num2;
	echo "$num1 * $num2 = $result";
}
if(isset($_POST['method'])&& $_POST['method']=="minus")
{
	$result = $num1-$num2;
	echo "$num1 - $num2 = $result";
}
if(!isset($_POST['method']))
{
	echo "please select a method";
}
if(isset($_POST['method'])&& $_POST['method']=="divide")
{
	if($num2==0)
	echo "no result";
	else
	{
		$result = $num1/$num2;
		echo "$num1 ÷ $num2 = $result";
	}
}

?>