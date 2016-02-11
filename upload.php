

<html>
<title> Upload A Photo </title>
<body style="background-color:0066cc;">
<font color="white">
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<font face="arial">
<center>

<?php
$title= "   Upload A Photo   ";
$myFile = "PBLog.txt";
$fh = fopen($myFile, 'a');
fwrite($fh, $title);
include ("include.php");

$access= "T";
$nu= NULL;




if(isset($_POST["ext"])) 
{

	if ($stmt = $mysqli->prepare("insert into photo(ext,img,owner_id) values (?,?,?)"))
	{
		$query="insert into photo(ext,img,owner_id) values (?,?,?)";
		fwrite($fh,$query);
		$stmt->bind_param("sss",$_POST["ext"],$nu, $_SESSION["id"]);
		$stmt->execute();
		$stmt->close();
			echo " Photo POSTED!<br> ";
	}
	if ($stmt=$mysqli->prepare("select p_id from photo natural join person where id = ? and ext= ?)"))
	{
		$q2="select p_id from photo natural join person where id = ? and ext= ?)";
		fwrite($fh,$q2);
		$stmt->bind_param("ss", $_SESSION["id"], $_POST["ext"]);
		$stmt->execute();
		$stmt->bind_result($p_id);
		$stmt->fetch();
		$photo= $p_id;
	}
	if ($stmt = $mysqli->prepare("insert into accessible_to(p_id,id,level) values (?,?,?)"))
	{
		$q3="insert into accessible_to(p_id,id,level) values (?,?,?)";
		fwrite($fh,$q3);
		fclose($fh);
		$stmt->bind_param("sss",$photo, $_SESSION["id"],$access );
		$stmt->execute();
		$stmt->close();
		
	}
	
	echo 'REDIRECTING to HOMEPAGE in 3 secs or <a href=\"homepage.php\"><font color="FFCCOO"> CLICK HERE</font></a>.';
	header("refresh: 3; homepage.php");
		
}
else
{
	echo '<font face="Comic Sans" color="black" size="14">Upload Your Photo: </font><br><br> ';
	echo '<form action="upload.php" method="POST"><br>';
	echo '<font color="black"> Photo Extension:</font><input type="text" name="ext"/>';
	echo '<input type="submit" value="Submit" /><br><br>';
	
	echo '<a href="homepage.php"><font color="FFCCOO"> GO HOME </font></a>';

}





?>
</font>
</font>
</body>
</center>


</html>