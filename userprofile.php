<!--picturethis written by Basia Bowens-->

<html>
<title> User Profile </title>
<body style="background-color:0066cc;">
<font color="white">
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<font face="arial">

<?php 

include "include.php";
$title=" Displaying User Profile ";
$myFile = "PBLog.txt";
$fh = fopen($myFile, 'a');
fwrite( $fh, $title);


if(isset($_SESSION["id"]))
{
	if( $stmt= $mysqli->prepare("select fname,lname from person where id=?"))
	{
		$query="select fname,lname from person where id=?";
		fwrite($fh,$query);
		$stmt->bind_param("s", $_SESSION["id"]);
		$stmt->execute();
		$stmt->bind_result($fname,$lname);
		$stmt->fetch();
		$first= htmlspecialchars($fname);
		$last= htmlspecialchars($lname);
		$stmt->close();
		
		$id= htmlspecialchars($_SESSION["id"]);
		echo '<center><h3><font color="black">This is the profile of:</font> </h3></center><br>';
		echo '<face"verdana"><center><h1>';
		echo  $first;
		echo " ";
		echo $last;
		echo "</h1></center></font>";
		echo '<center><font color="black">ID Number: </font>';
		echo $id; 
		echo "</center>";
		
		echo "                                     ";
		echo "<center>";
		echo '<b><h3><font color="black">Online Status</font></b>:<font color="white">ONLINE!</h3></font>';
		echo "                           ";
		
		echo '<font face="Comic Sans" color="black" size="14">';
		echo $first;
		if($stmt = $mysqli->prepare("select p_id from photo where owner_id = ?"))
		{
			$query2="select p_id from photo where owner_id = ?";
			fwrite($fh,$query2);
			fclose($fh);
			$stmt->bind_param("s",$_SESSION["id"]);
			$stmt->execute();
			$stmt->bind_result($p_id);
			echo " Photos: <br></font>";
			
			while($stmt->fetch())
			{
				$p_id = htmlspecialchars($p_id);
				echo '<font color="black">PHOTO ID: </font>';
				echo $p_id;
				echo '<font color="black"> owned by: </font>';
				echo $_SESSION["email"];
				echo "<br>";
			}
			$stmt->close();
		}
		
		echo '</center>';
		
	}
	
	echo '<center><br /><a href="homepage.php"><font color="FFCCOO">GO BACK</font></a></center>';
}

?>
</font>
</font>
</body>
</html>