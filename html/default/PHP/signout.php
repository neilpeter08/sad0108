<?php
	session_start();
	session_destroy();
	header("Location: http://localhost/sad0108/html/default/home.php");
?>