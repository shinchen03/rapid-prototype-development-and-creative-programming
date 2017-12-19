<!DOCTYPE html>
<html>
	<head><title>Module two calculator</title></head>

	<body>
		<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
		<p>
			<label for="firstnum">firstnumber:</label>
			<input type="text" name="firstnum" id="firstnum" />
		</p>
		<p>
			<label for="secondnum">secondnumber:</label>
			<input type="text" name="secondnum" id="secondnum" />
		</p>
		<p>
			<input type="submit" value="Print result" />
		</p>
		</form>
		<?php
		
		$n1 = $_POST['firstnum'];
		$n2 = $_POST['secondnum'];
		function add($x, $y){
			return $x + $y;
		}
		 
		$result = add($n1, $n2); 
		echo $result;
		if(isset($_POST['name'])){
		printf("<p><strong>%d</strong></p>\n",
		htmlentities($_POST['result'])
			);
			
		}

		?>
	</body>
</html>