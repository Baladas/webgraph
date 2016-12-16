<?php
require_once("utils_webgraph.php");


//Checking to see if the user inputted all the required info and the passwords match, if they do insert into database, if not, give user a message and make retry registering
if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password2"]) ) {
  if($_POST["password"] === $_POST["password2"]) {
    $db = new PDO('mysql:localhost;port=3306;dbname=muistilista;charset=utf8', 'xx', 'xx');

	$username = $_POST["username"];
    $password = $_POST["password"];
	$hash = password_hash($password, PASSWORD_BCRYPT); //Using the best practice method of $password_hash

    $stmt = $db->prepare("INSERT INTO userinfo(username, pwhash) VALUES(:username, :pwhash)");

	$stmt->bindParam(':username', $username, PDO::PARAM_STR); //bindParam is used to protect ourselves from SQL-injection
	$stmt->bindParam(':pwhash', $hash, PDO::PARAM_STR);
    $stmt->execute();
	
	$db = null;


    print "<p>User created.</p>";
	header("Location: webgraph.php");
	exit();

  }
  else {
    print "<p>Passwords don't match!</p>";
	header("Location: register_webgraph.php");

  }

}
else {
print <<<REGISTERFORM

<form action="register_webgraph.php" method="post">
<input type="text" name="username" placeholder="Username" />
<input type="password" name="password" placeholder="Password" />
<input type="password" name="password2" placeholder="Password again" />
<input type="text" name="realname" placeholder="Full name" />
<input type="submit" value="Register" />

</form>
REGISTERFORM;
}
?>
