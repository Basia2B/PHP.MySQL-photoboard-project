<html>
<title> HOMEPAGE </title>
<center>
<body style="background-color:0066cc;">
<font color="white">
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<font face="arial">

<?php

$myFile = "PBLog.txt";
$fh = fopen($myFile, 'a');
$title= " Displaying Homepage ";

fwrite($fh,$title);
fclose($fh);

include ("include.php");

if(!isset($_SESSION["email"]))
{
  echo "Welcome to PictureThis Photosharing Homepage! You're not logged in. <br><br> ";
  echo 'You can: <a href="login.php"><font color="FFCCOO"> LOG IN </font></a> or <a href="registration.php"><font color="FFCCOO"> JOIN </font></a><br><br>' ;
}

if(isset($_SESSION["email"])) 
{
  
  $user= htmlspecialchars($_SESSION["email"]);
  echo "Welcome "; 
  echo $user; 
  echo ". You are logged in.<br /><br />\n";
  echo '<tr><a href="userprofile.php"><font color="FFCCOO">Your Profile</font></a><br></tr>';
  echo '<a href="upload.php"><font color="FFCCOO"> Upload A Photo </font></a><br>';
  echo '<a href="searchphotos.php"><font color="FFCCOO">View Your Photos </font></a><br>';
  echo '<a href="searchtaggablephotos.php"><font color="FFCCOO">Your Viewable/Taggable Photos </font></a><br>';
  echo '<a href="searchpicsbynamespc.php"><font color="FFCCOO"> Search Photos by Tag </font></a><br>';
  echo '<a href="searchpicsbytagandnamespc.php"><font color="FFCCOO"> Search Photos by Owner and Tag </font></a><br>';
  echo ' <a href="tag.php"><font color="FFCCOO"> Tag A Photo </font></a><br>';
  echo '<a href="giveAccessV.php"><font color="FFCCOO"> Give A Friend Photo Viewing Access </font></a><br>';
  echo '<a href="giveAccessT.php"><font color="FFCCOO"> Give A Friend Photo Tagging/Viewing Access</font></a><br>';
  echo '<a href="ftypeaccess.php"><font color="FFCCOO"> Give A Group of Friends Specific Access to A Photo</font></a><br>';
  echo '<a href="addfriend.php"><font color="FFCCOO"> Add A Friend </font></a><br>';
  echo '<a href="unfriend.php"><font color="FFCCOO"> Unfriend A User </font></a><br>';
  echo '<a href="logout.php"><font color="FFCCOO">Logout</font></a>.';
  echo "\n";
}




?>

</center>
</font>
</font>
</body>


</html>