<!--picturethis written by Basia Bowens-->

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
$title="  Add A Friend   ";
$myFile = "PBLog.txt";
$fh = fopen($myFile, 'a');
fwrite($fh,$title);


if(isset($_POST["viewer"]) && isset($_POST["ftype"]))
{

	if($stmt= $mysqli->prepare("insert into friend_of(owner_id,viewer_id,ftype) values(?,?,?)"))
	{
		$query="insert into friend_of(owner_id,viewer_id,ftype) values(?,?,?)";
		fwrite($fh,$query);
		fclose($fh);
		$stmt->bind_param("sss", $_SESSION["id"], $_POST["viewer"], $_POST["ftype"]);
		$stmt->execute();
		echo "<h2>You have Added a NEW FRIEND!</h2><br>";
		$stmt->close();
		echo "REDIRECTING to HOMEPAGE in 7 seconds.";
		header("refresh: 7; homepage.php"); 
	}
	
	 
	

}
else
{
	echo "<br>Enter the Friend ID and friend category of Your new friend: <br>";
	echo '<form action="addfriend.php" method="POST">';
	echo 'Friend ID Number: <input type="text" name="viewer"><br>';
	echo 'Friend Category to Place in: <input type="text" name="ftype">';
	echo '<input type="submit" value="Submit">';
	echo '</form>';
	echo "\n";
	echo '<a href="homepage.php"><font color="FFCCOO">GO HOME </font></a>';

}


?>
</font>
</font>
</body>
</center>
</html>