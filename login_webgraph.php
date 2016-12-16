<?php
require_once("utils_webgraph.php");

//Checking to see if the username and password have been given by the user
if(isset($_POST["username"]) && isset($_POST["password"])) {


	  $db = new PDO('mysql:localhost;port=3306;dbname=muistilista;charset=utf8', 'root', 'virtanen30');
		
	  $username = $_POST["username"];
	  $password = $_POST["password"];

	  $stmt = $db->prepare('SELECT * FROM userinfo WHERE username = :username LIMIT 1;'); //Get info from row based on the username
	  
	  $stmt->bindParam(':username', $username, PDO::PARAM_STR);
	  $stmt->execute();
	  
	  $resultarray = array();
	  $row = $stmt->fetch();
	  
	  $verified = false;
	  
	  if($row != false){
		  $hash = $row["pwhash"];
		  var_dump($hash);
		  
		  if (password_verify($password, $hash)) { //Using the password_verify to check that the hashes match
				$verified = true;
				$_SESSION["username"] = $username;
				print "<p style='color:red;'> Login successful!</p>";

		  }
	  }
	  
	
	  $db = null;

	  if($verified) {
		  header('Location: webgraph.php');
	  }
	  else {
		print "<p> Check login information </p>";
		header("Location: login_webgraph.php");
	  }
}

else {
print <<<LOGINFORM

<form action="login_webgraph.php" method="post">
<input type="text" name="username" placeholder="Username" />
<input type="password" name="password" placeholder="Password" />
<input type="submit" value="Login" />

</form>
LOGINFORM;
}

?>