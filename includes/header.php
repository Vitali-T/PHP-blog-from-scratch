<?php 
include 'database.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="stylesheets/style.css" rel='stylesheet' type='text/css'>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="js/functions.js"></script>
</head>
<body>

<div class="nav-default">
	<a href="index.php" id="home"><img src="img/home.png"></a>
	<p class="access"><?php if(isset($_SESSION['username']))echo 'Logged in as: '.ucfirst($_SESSION['username']) ?></p>
	<a href="admin.php"><img class="admin" src="img/control_panel.png"></a>
	<div class="welcome-msg">
		<h1>My blog</h1>
		<h2>Thoughts | Impresions | Ideas</h2>
	</div>
</div>
