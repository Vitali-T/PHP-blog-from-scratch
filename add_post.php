<?php 
include 'includes/header.php';
if(isset($_POST['submit'])&&!empty($_POST['title']) && !empty($_POST['category']) && !empty($_POST['postBody'])){
	$title = $db->real_escape_string($_POST['title']);
	$category = $db->real_escape_string($_POST['category']);
	$body = $db->real_escape_string($_POST['postBody']);
	if(!empty($_FILES['image']) && $imageInfo = validateUpload()){
		$image = $imageInfo[0];
		$imageType = $imageInfo[1];
		$imageName = $imageInfo[2];
	}
	else {
		$imageName = 'None';
		$imageType = 'None';
		$image = NULL;
	}
	print_r ($_POST);
	echo '<br>';
	print_r ($_FILES['image']);
	create_entry($category, $title, $body, $imageName, $imageType, $image);
	header('Location:admin.php');
}
?>