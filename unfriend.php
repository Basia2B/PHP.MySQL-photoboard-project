<!--picturethis written by Basia Bowens-->

<html> 
<title>UnFriend A Friend</title>
<body style="background-color:0066cc;">
<font color="white">
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<font face="arial">
<center>
<?php 
include "include.php";
$title= "  UnFriend ";
$myFile = "PBLog.txt";
$fh = fopen($myFile, 'a');
fwrite($fh,$title);

if( isset($_POST["viewer"]))
{
	if($stmt= $mysqli->prepare("delete from friend_of where owner_id=? and viewer_id=?"))
	{
		$query="delete from friend_of where owner_id=? and viewer_id=?";
		fwrite($fh,$query);
		$stmt->bind_param("ss", $_SESSION["id"],$_POST["viewer"]);
		$stmt->execute();
		$stmt->close();
	}
	if($stmt= $mysqli->prepare("select fname from person where id= ?"))
	{
		$query2="select fname from person where id= ?";
		fwrite($fh,$query2);
		fclose($fh);
		$stmt->bind_param("s",$_POST["viewer"]);
		$stmt->execute();
		$stmt->bind_result($fname);
		while ($stmt->fetch())
		{
			echo " You are no longer Friends with ";
			$first = htmlspecialchars($fname);
			echo $first;
			echo " on PictureThis anymore.<br><br>";
		}
		$stmt->close();
		echo "REDIRECTING to HOMEPAGE in 7 seconds.";
		header("refresh: 7; homepage.php"); 
	}
}
else
{
	echo " Enter the ID of the User You wish to UnFriend: <br>";
	echo ' <form action="unfriend.php" method="POST">';
	echo ' User to UnFriend ID: <input type="text" name="viewer">';
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