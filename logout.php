<!-- PictureThis written by Basia Bowens -->


<html>
<center>
<body style="background-color:0066cc;">
<font color="white">
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<font face="arial">
<title> LOGOUT </title>


<?php

$title="  Logging User Out   ";
$myFile = "PBLog.txt";
$fh = fopen($myFile, 'a');
fwrite($fh,$title);
fclose($fh);

session_start();
session_destroy();

echo "<br>Logout Complete.";

echo "Redirecting to Homepage in 3 seconds";
	header("refresh:3;homepage.php");

?>
</font>
</font>
</body>
</center>

</html>