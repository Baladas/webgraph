<?php

session_start();

function siteHeader() {

  ?>
  <!DOCTYPE html>
  <html>
    <body>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
      <div id="page">
      <header id="mainHeader">
        <?php if(isset($_SESSION["username"])) { //If session is valid, print the user's username, if not inform there is no valid session
	
        print "<p style='color:green;'>You are logged in as: {$_SESSION['username']}</p>";
		}
		else {
		print "<p style='color:red;'>Please log in via the Login button</p>";
		}
        ?>
      </header>
	  </div>

<?php
}


