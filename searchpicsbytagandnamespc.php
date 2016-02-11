<!-- picturethis written by Basia Bowens-->

<html>
<title> Search Photos by tag and Owner </title>
<body style="background-color:0066cc;">
<font color="white">
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<font face="arial">
<center>
<?php 
$title="   Search Photos by Tag and Owner   ";
$myFile = "PBLog.txt";
$fh = fopen($myFile, 'a');
fwrite($fh, $title);

include "include.php";

if(isset($_POST["namespc"]))
{
	if($stmt= $mysqli->prepare("select t_id from tag where namespc= ? and pred = ? and val= ? "))
	{
		$query="select t_id from tag where namespc= ? and pred = ? and val= ? ";
		fwrite($fh,$query);
		$stmt->bind_param("sss", $_POST["namespc"],$_POST["pred"],$_POST["val"]);
		$stmt->execute();
		$stmt->bind_result($tid);
		$stmt->fetch();
		$stmt->close();
	}
	
	if($tid != '')
	{
	
		if($stmt=$mysqli->prepare("select p_id from tagged where t_id= ? "))
		{
			$query2="select p_id from tagged where t_id= ? ";
			fwrite($fh, $query2);
			$ph=0;
			$stmt->bind_param("s",$tid);
			$stmt->execute();
			$stmt->bind_result($pid);
			while($stmt->fetch())
			{
				$photos[$ph]=$pid;
				$ph=$ph+1;
			}
			$stmt->close();
		}
			
			set_time_limit(5);
			echo "<h2>Photos with this Tag:</h2><br>";
		if($stmt= $mysqli->prepare("select p_id from accessible_to where p_id=? and id=?"))
			{
				$query3= "select p_id from accessible_to where p_id=? and id=?";
				fwrite($fh,$query3);
				fclose($fh);
				for($i=0;$i<$photos;++$i)
				{
					$stmt->bind_param("ss",$photos[$i],$_POST["vid"]);
					$stmt->execute();
					$stmt->bind_result($p_id);
					if($stmt->fetch())
						{
							$p= htmlspecialchars($p_id);
							echo "PHOTO ID: ";
							echo $p;
							echo " has that tag!<br>";
						}
					echo '<a href="homepage.php"><font color="FFCCOO">GO HOME</font></a>';	
						
				}
				$stmt->close();
			}
	}
		if($tid == '')
	{
		echo '<center>That tag does not exist';
		echo '<a href="homepage.php"><font color="FFCCOO"> GO HOME </font></a></center>';
	}
			
}
else
{
	echo '<font face="Arial" color="black" size="5">Enter Tag Information:</font> <br><br>';
	echo '<form action="searchpicsbynamespc.php" method="POST">';
	echo '<font color="black">User ID:</font> <input type="text" name="vid"><br>';
	echo '<font color="black"> Namespace:</font> <input type="text" name="namespc"><br>';
	echo '<font color="black"> Pred: </font><input type="text" name="pred"><br>';
	echo '<font color="black"> Value: </font><input type="text" name="val"><br>';
	echo '<input type="submit" value="Submit">';
	echo '</form>';
	echo "\n";
	echo '<a href="homepage.php"><font color="FFCCOO"> GO HOME </font></a>';
}

?>
</font>
</font>
</body>
</center>
</html>