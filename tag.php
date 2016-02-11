<html>

<body style="background-color:0066cc;">
<font color="white">
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/><br>
<font face="arial">
</title>Tag A Photo</title>
<center>
<?php
$title= " Tag A Photo: ";
$myFile = "PBLog.txt";
$fh = fopen($myFile, 'a');
fwrite($fh, $title);


include "include.php";

if(isset($_POST["pid"]))
{
	//insert tag into database
	if($stmt= $mysqli->prepare("insert into tag(namespc,pred,val) values(?, ?, ?)"))
	{
		$query="insert into tag(namespc,pred,val) values(?, ?, ?)";
		fwrite($fh,$query);
		$stmt->bind_param("sss", $_POST["namespc"],$_POST["pred"],$_POST["val"]);
		echo " Creating Tag... <br>";
		$stmt->execute();
		echo " Creating Tag... <br>";
		echo" Tag created! Now tagging photo. <br>";
		$stmt->close();
	}
	//gather tag identification
	if($stmt= $mysqli->prepare("select t_id from tag where val= ?"))
	{
		$query2="select t_id from tag where val= ?";
		fwrite($fh,$query2);
		$stmt->bind_param("s", $_POST["val"]);
		$stmt->execute();
		$stmt->bind_result($t_id);
		$stmt->fetch();
		$tid=$t_id;
		$stmt->close();
	}
	if($stmt= $mysqli->prepare("insert into tagged(t_id,p_id,id) values (?,?,?)"))
	{
			$query3="insert into tagged(t_id,p_id,id) values (?,?,?)";
			fwrite($fh,$query3);
			fclose($fh);
			$stmt->bind_param("sss",$tid,$_POST["pid"], $_SESSION["id"]);
			$stmt->execute();
			$stmt->close();
			echo " Photo ID ";
			$p_id = htmlspecialchars($_POST["pid"]);
			echo $p_id;
			echo " has been tagged! ";
			
			echo '<a href="homepage.php"><font color="FFCCOO">GO HOME</font></a>';
			
	}
}

else
{
	echo '<font size="5" face="Arial" color="black"> Enter Photo ID, and Tag Specifications:</font> <br>';
	echo '<form action="tag.php" method="POST">';
	echo "\n";
	echo '<font color="black"> Photo ID Number:</font> <input type="int" name="pid"/>';
	echo '<font color="black"> Namespace: </font><input type="text" name="namespc"/>';
	echo '<font color="black"> Pred: </font><input type="text" name="pred">';
	echo '<font color="black"> Value: </font><input type="text" name="val"/>';
	echo '<input type="submit" value="Submit"/>';
	echo "\n";
	echo '</form>';
	echo "<br><br>";
	
	echo '<a href="homepage.php"><font color="FFCCOO"> GO BACK TO HOMEPAGE</font> </a>';
	
	
	
}



 
?>
</font>
</font>
</body>
</center>
<html>