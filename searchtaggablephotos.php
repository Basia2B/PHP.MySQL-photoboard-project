<!--PictureThis written by Basia Bowens-->

<html>

<title> Search Photos You Can Tag </title>
<body style="background-color:0066cc;">
<font color="white">
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<font face="arial">
<center>
<title> Search Photos with Tag Access </title>

<?php 

$title= "  Search Photos with Tag Access  ";
$myFile = "PBLog.txt";
$fh = fopen($myFile, 'a');
fwrite($fh, $title);

include "include.php";

$level = 'T';
$leveldos= 'V';

	if($stmt = $mysqli->prepare("select p_id,level from accessible_to where id = ? and (level = ? or level = ?) "))
	{
		$query= "select p_id,level from accessible_to where id = ? and (level = ? or level = ?) ";
		$stmt->bind_param("sss",$_SESSION["id"], $level, $leveldos);
		$stmt->execute();
		$stmt->bind_result($p_id,$level);
		$one= " id: ";
		$two= " level: ";
		$three=" level: ";
		fwrite($fh,$query);
		fwrite($fh,$one);
		fwrite($fh, $_SESSION["id"]);
		fwrite($fh,$two);
		fwrite ($fh,$level);
		fwrite($fh, $three);
		fwrite($fh, $leveldos);
		fclose($fh);

		
		echo '<font face="Comic Sans" color="black" size="14">Your Photos: </font><br>';
		while($stmt->fetch())
		{
			echo '<font color="black">Photo ID:</font> ';
			$p_id= htmlspecialchars($p_id);
			echo $p_id;
			echo '<font color="black"> Access Level:</font> ';
			$level= htmlspecialchars($level);
			echo $level;
			echo "<br>";
		}
		
	

	}
	echo '<br /><a href="homepage.php"><font color="FFCCOO">GO BACK</font></a>';







?>
</center>
</font>
</font>
</body>
</html>