<!--Basia Bowens referenced Raymond Mui-->
<html>

<body style="background-color:0066cc;">
<font color="white">
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<font face="arial">
<title>Registration</title>


<?php
$title= "  Registration  ";
$myFile = "PBLog.txt";
$fh = fopen($myFile, 'a');
fwrite($fh, $title);
// function that creates a random varchar id the user being created
function getrandvarchar(){
$letter = 'a';
$randomNum = mt_rand(0,2000);
$id = $letter . $randomNum;
return $id;	
};

include "include.php";

$id = getrandvarchar();
  //if the person has put all the values in the form, insert into person database
if(isset($_POST["email"]) && isset($_POST["password"])) 
  {

    //check if email already exists in database
    if ($stmt = $mysqli->prepare("select email from person where email = ?")) 
	{
	  $query= "select email from person where email = ?";
	  $one =" email: ";
      $stmt->bind_param("s", $_POST["email"]);
      $stmt->execute();
      $stmt->bind_result($email);
	  fwrite($fh, $query);
	  fwrite ($fh, $one);
	  fwrite($fwrite,$_POST["email"]);

        if ($stmt->fetch()) 
		{
          echo "That E-mail Address Already exists. ";
          echo "REDIRECTING to Homepage in 3 seconds...";
          header("refresh: 3; homepage.php");
        }
      $stmt->close();
    }
  
    //insert the person into database
	$password = md5($_POST["password"]);
	if ($stmt = $mysqli->prepare("insert into person(id,fname,lname,email,password) values (?,?,?,?,?)")) 
	{
	
	  $query2= "insert into person(id,fname,lname,email,password) values (?,?,?,?,?)";
	  $two= " id: ";
	  $three=" fname: ";
	  $four=" lname: ";
	  $five=" email: ";
	  $six=" password: ";
      $stmt->bind_param("sssss",$id ,$_POST["fname"],$_POST["lname"], $_POST["email"], $password);
      $stmt->execute();
      $stmt->close();
	  fwrite($fh, $query2);
	  fwrite($fh,$two);
	  fwrite($fh,$id);
	  fwrite ($fh,$three);
	  fwrite($fh,$_POST["fname"]);
	  fwrite($fh, $four);
	  fwrite($fh, $_POST["lname"]);
	  fwrite($fh, $five);
	  fwrite($fh,$_POST["email"]);
	  fwrite($fh, $password);
	  fclose($fh);
      echo 'Registration complete.<a href="homepage.php"> CLICK HERE</a> to return to homepage.';  
    }	  
  }
  //if not then display registration form
  else 
  {
    echo "Please fill out the following: <br /><br />\n";
    echo '<form action="registration.php" method="POST">';
    echo "\n";	
    echo 'First Name: <input type="text" name="fname" /><br />';
    echo "\n";
    echo 'Last Name: <input type="text" name="lname" /><br />';
    echo "\n";
    echo 'E-MAIL: <input type="text" name="email" /><br />';
    echo "\n";
	echo 'Password: <input type="password" name="password" /><br />';
    echo "\n";
	echo '<input type="submit" value="Submit" />';
    echo "\n";
	echo '</form>';
	echo "\n";
	echo '<br /><a href="homepage.php"><font color="FFCCOO">Go back</font></a>';

  }




?>
</font>
</font>
</body>


</html>