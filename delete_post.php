<?php

include 'database.php';

if(isset($_POST['submit']) && !empty($_POST['ToDelete'])){
	$id = $_POST['ToDelete'];
	if(is_nan($id)){
		exit('Only numbers are allowed!');
	}
	else{
		$get_post= $db->query("SELECT title FROM posts WHERE id= $id");
		if($db->affected_rows>0){
			delete_entry ($id);
			header('Location:admin.php');
		}
		else{
			echo "<script language='javascript'>window.alert('This ID doesn\'t exist');
		window.location.href='admin.php';</script>";
		}
	}
}
?>
