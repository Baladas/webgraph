<?php
	session_start();
	session_destroy(); //Destroy session = logout
	header('Location: webgraph.php');
	exit;
?>