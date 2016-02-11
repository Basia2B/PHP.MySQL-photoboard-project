<html>
<center>
<body style="background-color:0066cc;">
<font color="white">
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<font face="arial">
<?php 

include "include.php";
$title="   Give A Friend Type A Certain Access  ";
$myFile = "PBLog.txt";
$fh = fopen($myFile, 'a');
fwrite($fh,$title);

if(isset($_POST["ftype"]))
{
	if($stmt=$mysqli->prepare("select viewer_id from friend_of where ftype= ?"))
	{
		$query="select viewer_id from friend_of where ftype= ?";
		fwrite($fh,$query);
		$stmt->bind_param("s",$_POST["ftype"]);
		$stmt->execute();
		$stmt->bind_result($viewer_id);
		$vi=0;
		while($stmt->fetch())
		{
			$viewers[$vi]= $viewer_id;
			$vi= $vi+1;
		}
		$stmt->close();
		
		for($i=0; $i < $vi; ++$i)
		{
		
			if($stmt= $mysqli->prepare("insert into accessible_to(p_id,id,level) values(?,?,?)"))
			{
				$query2="insert into accessible_to(p_id,id,level) values(?,?,?)";
				fwrite($fh,$query2);
				$stmt->bind_param("sss",$_POST["pid"],$viewers[$i],$_POST["level"]);
				$stmt->execute();
				$stmt->close();
			}
		}
		$ftype= htmlspecialchars($_POST["ftype"]);
		echo "Everyone in your ";
		echo $ftype;
		fclose($fh);
		echo " can now ";
		if($_POST["level"] == "T"){echo " TAG and View this photo!<br>"; }
		if($_POST["level"] == "V"){echo " View this photo!<br>"; }
		echo "REDIRECTING to HOMEPAGE in 5 secs.";
		header("refresh: 5;homepage.php");
	}
}
else
{
	echo "Enter your Friend Group, The level of viewing Access, and the Photo ID of the Photo you wish to allow access to: <br>";
	echo'<form action="ftypeaccess.php" method="POST">';
	echo 'Friend Group: <input type="text" name="ftype"><br>';
	echo 'Viewing Access (T for Tag, V for View only): <input type="text" name="level">';
	echo ' Photo ID: <input type="int" name="pid">';
	echo '<input type="submit" value="Submit">';
	echo '</form>';
	echo "\n";
	echo '<a href="homepage.php"><font color="FFCC00"> GO HOME </font></a>';
	
}
?>
</font>
</font>
</body>
</center>
</html>
