<html>
<title>Give Tagging Access</title
<center>
<body style="background-color:0066cc;">
<font color="white">
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<font face="arial">
<?php 
$title="   Give Tagging Access  ";
$myFile = "PBLog.txt";
$fh = fopen($myFile, 'a');
fwrite($fh, $title);

include 'include.php';
$level= 'T';
if(isset($_POST["viewerid"]))
{

	if($stmt= $mysqli->prepare("insert into accessible_to(p_id,id,level) values(?,?,?)"))
	{
		$query="insert into accessible_to(p_id,id,level) values(?,?,?)";
		fwrite($fh,$query);
		fclose($fh);
		$stmt->bind_param("sss",$_POST["pid"],$_POST["viewerid"],$level);
		$stmt->execute();
		$stmt->close();
		$p_id = htmlspecialchars($_POST["pid"]);
		echo "<center>Your Friend now has Viewing and Tagging Access to your Photo with ID: ";
		echo $p_id;
		echo '<br><a href="homepage.php"><font color="FFCCOO"> GO HOME </font></a></center>';
	}
}

else
{
	echo "<center>Enter Friend ID, and the ID of the Photo you wish to allow viewing access: <br>";
	echo "\n";
	echo '<form action="giveAccessT.php" method="POST">';
	echo 'Friend ID: <input type="text" name="viewerid"/>';
	echo 'Photo ID: <input type="int" name="pid"/><br>';
	echo '<input type="submit" value="Submit"/>';
	echo '</form>';
	
	echo "\n";
	echo '<br><a href="homepage.php"><font color="FFCCOO"> GO HOME </font></a></center>';
	
	
}

?>
</center>
</font>
</font>
</body>
</html>