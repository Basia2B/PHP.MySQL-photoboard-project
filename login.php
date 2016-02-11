<!--Basia Bowens referenced work of Raymond Mui-->

<html>
<body style="background-color:0066cc;">
<font color="white">
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<img src="http://www.sondersphotography.com/blog/wp-content/uploads/img_0390.jpg" width="300" height="220"/>
<font face="arial">
<center>
<title>LOGIN</title>

<?php

include ("include.php");

$myFile = "PBLog.txt";
$fh = fopen($myFile, 'a');
$usa= "log in occurred ";


if(isset($_SESSION["email"])) {
  echo "CURRENTLY LOGGED IN. \n";
  echo "REDIRECTING TO HOMEPAGE in 3 sec or <a href=\"homepage.php\"> CLICK HERE </a>.\n";
  header("refresh: 3; homepage.php");

}
else {
  //if the user have entered both entries in the form, check if they exist in the database
  if(isset($_POST["email"]) && isset($_POST["password"])) {
	
    //check if entry exists in database
    if ($stmt = $mysqli->prepare("select id,email,password from person where email = ? and password = ?")) {
     $temp = md5($_POST["password"]);
      $stmt->bind_param("ss", $_POST["email"], $temp);
      $stmt->execute();
      $stmt->bind_result($id, $email, $password);
	    //if there is a match set session variables and send user to homepage
        if ($stmt->fetch()) {
		  $_SESSION["id"] = $id;
		  $_SESSION["email"] = $email;
		  $_SESSION["password"] = $password;
		  $_SESSION["REMOTE_ADDR"] = $_SERVER["REMOTE_ADDR"]; 
		  fwrite($fh,$usa);
		  fwrite($fh,$id);
		  fclose($fh);
          echo "SUCCESSFULLY LOGGED IN. \n";

          echo 'REDIRECTING IN 3 SECONDS or <a href=\"homepage.php\"><font color="FFCCOO"> CLICK HERE </font></a>.';
          header("refresh: 3; homepage.php");
        }
		//if no match then tell them to try again
		else {
		  sleep(1); 

		  echo "Your e-mail and/or password is incorrect, <a href=\"login.php\"> CLICK HERE</a> to try again.";
		}
      $stmt->close();
    }  
  }
  //if not then display login form
  else {
    echo '<form action="login.php" method="POST">';
	echo "\n";
    echo 'E-MAIL: <input type="text" name="email" />';
	echo "\n";
    echo 'PASSWORD: <input type="password" name="password" /><br />';
	echo "\n";
    echo '<input type="submit" value="Submit" />';
	echo "\n";
    echo '</form>';
	echo "\n";

	
	echo '<br /><a href="homepage.php"><font color="FFCCOO">GO BACK</font></a>';
  }
}
?>

</center>
</font>
</font>
</body>

</html>