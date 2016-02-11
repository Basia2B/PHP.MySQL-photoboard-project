<!--PictureThis written by Basia Bowens-->

<html>
<title> Search Photos </title>
<body style="background-color:0066cc;">
<font color="white">
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<font face="arial">
<center>

<?php 
$title=" Search User Photos   ";
$myFile = "PBLog.txt";
$fh = fopen($myFile, 'a');
fwrite($fh,$title);

include "include.php";

if(isset($_SESSION["id"]))
{

	if($stmt = $mysqli->prepare("select p_id from photo where owner_id = ?"))
	{
		$query="select p_id from photo where owner_id = ?";
		fwrite($fh,$query);
		fclose($fh);
		$stmt->bind_param("s",$_SESSION["id"]);
		$stmt->execute();
		$stmt->bind_result($p_id);
		echo '<font face="Arial" color="black" size="12"> Your Photos: <br></font>';
		
		while($stmt->fetch())
		{
			$p_id = htmlspecialchars($p_id);
			echo '<font color="black">PHOTO ID:</font> ';
			echo $p_id;
			echo '<font color="black"> owned by: </font>';
			echo $_SESSION["email"];
			echo "<br>";
		}
		
		echo '<a href="homepage.php"><font color="FFCCOO">GO HOME</font></a>';
	}
}






?>
</font>
</font>
</body>
</center>
</html>