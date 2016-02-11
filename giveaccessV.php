<html>
<title>Give Viewing Access</title>
<body style="background-color:0066cc;">
<font color="white">
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<font face="arial">
<center>
<?php
$title="   Giving Viewing Access  ";
$myFile = "PBLog.txt";
$fh = fopen($myFile, 'a');
fwrite($fh,$title);

include 'include.php';
$level= 'V';
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
		echo '<font face="Comic Sans" color="black">Your Friend now has Viewing Access to your Photo with ID: </font>';
		echo $p_id;
		echo '<br><a href="homepage.php"><font color="FFCCOO"> GO HOME </font></a>';
	}
}

else
{
	echo '<font face="Arial" color="black" size="5">Enter Friend ID, and the ID of the Photo you wish to allow viewing access:</font> <br>';
	echo "\n";
	echo '<form action="giveAccessV.php" method="POST">';
	echo '<font color="black">Friend ID: </font><input type="text" name="viewerid"/><br>';
	echo '<font color="black">Photo ID: </font><input type="int" name="pid"/><br>';
	echo '<input type="submit" value="Submit"/>';
	echo '</form>';
	
	echo "\n";
	echo '<br><a href="homepage.php"> <font color="FFCCOO">GO HOME</font> </a>';
	
	
}
 ?>
 </font>
 </font>
 </body>
</center> 
</html>