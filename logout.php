<?php 
include 'includes/header.php';
if(session_status() == PHP_SESSION_ACTIVE){
	session_destroy();
	session_unset(); 
	header('Location:index.php');
}
else 
	echo 'No active sessions';
?>
