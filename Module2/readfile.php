<?php
$h = fopen("file_with_lines.txt", "r");
 
$linenum = 1;
echo "<ul>\n";
while( !feof($h) ){
	printf("\t<li>Line %d: %s</li>\n",
		$linenum++,
		fgets($h)
	);
}
echo "</ul>\n";
 
fclose($h);
?>