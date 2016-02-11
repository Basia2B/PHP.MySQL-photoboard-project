<!-- picturethis written by Basia Bowens-->

<html>
<title>Search Photos by Tag</title>
<body style="background-color:0066cc;">
<font color="white">
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<font face="arial">
<center>
<?php 
$title= " Search Photos by Tag ";
$myFile = "PBLog.txt";
$fh = fopen($myFile, 'a');
fwrite($fh, $title);

include "include.php";

if(isset($_POST["namespc"]))
{
	if($stmt= $mysqli->prepare("select t_id from tag where namespc= ? and pred = ? and val= ? "))
	{
		$query="select t_id from tag where namespc= ? and pred = ? and val= ? ";
		$one=" namepc: ";
		$two=" pred: ";
		$three=" val: ";
		$stmt->bind_param("sss", $_POST["namespc"],$_POST["pred"],$_POST["val"]);
		$stmt->execute();
		$stmt->bind_result($tid);
		fwrite($fh, $query);
		fwrite($fh,$one);
		fwrite($fh, $_POST["namespc"]);
		fwrite($fh,$two);
		fwrite($fh, $_POST["pred"]);
		fwrite($fh, $three);
		fwrite($fh,$_POST["val"]);
		$stmt->fetch();
		$stmt->close();
	}
	if($tid != '')
	{
		if($stmt=$mysqli->prepare("select p_id from tagged where t_id= ? "))
		{
			$query2 =" select p_id from tagged where t_id= ? ";
			fwrite($fh,$query2);
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
				$query3="select p_id from accessible_to where p_id=? and id=?";
				fwrite($fh, $query3);
				fclose($fh);
				for($i=0;$i<$photos;++$i)
				{
					$stmt->bind_param("ss",$photos[$i],$_SESSION["id"]);
					$stmt->execute();
					$stmt->bind_result($p_id);
					if($stmt->fetch())
						{
							$p= htmlspecialchars($p_id);
							echo "PHOTO ID: ";
							echo $p;
							echo " has that tag!<br>";
						}
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
	echo "Enter Tag Information: <br><br>";
	echo '<form action="searchpicsbynamespc.php" method="POST">';
	echo 'Namespace: <input type="text" name="namespc">';
	echo 'Pred: <input type="text" name="pred">';
	echo 'Value: <input type="text" name="val">';
	echo '<input type="submit" value="Submit">';
	echo '</form>';
	echo "\n";
	echo '<a href="homepage.php"><font color="FFCCOO"> GO HOME </font></a>';
}

?>
</center>
</font>
</font>
</body>
</html>