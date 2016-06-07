<?php 

include 'database.php';

if(isset($_POST['submit'])&& !empty($_POST['id'])) {
	$id = $db->real_escape_string($_POST['id']);
	if(is_nan($id)){
		exit('Only numbers are allowed!');
	}
	else{
		$get_post= $db->query("SELECT category, title, body, imgName, imgType FROM posts WHERE id= $id");
		if($db->affected_rows>0){	
			if(!empty($_POST['title']) && !empty($_POST['category']) && !empty($_POST['postBody']) && !empty($_POST[
'image']) && $imageInfo = validateUpload()){
				$title = $db->real_escape_string($_POST['title']);
				$category = $db->real_escape_string($_POST['category']);
				$body = $db->real_escape_string($_POST['postBody']);
				$imageType = $imageInfo[0];
				$imageName = $imageInfo[1];
			}
			else {
					while($row = $get_post->fetch_object()){
						if (empty($_POST['title'])){
							$title = $row->title;
						}
						else $title = $db->real_escape_string($_POST['title']);
						if (empty($_POST['category'])){
							$category = $row->category;
						}
						else $category = $db->real_escape_string($_POST['category']);
						if (empty($_POST['postBody'])){
							$body = $row->body;
						}
						else $body = $db->real_escape_string($_POST['postBody']);
						if($_FILES['image']['error'] == UPLOAD_ERR_NO_FILE || !(validateUpload())){
							$imageType = $row->imgType;
							$imageName = $row->imgName;
						}
						else{
							$imageInfo = validateUpload();
							$imageType = $imageInfo[0];
							$imageName = $imageInfo[1];
							$fileTmpName = $imageInfo[2];
							$img = "img/";
							move_uploaded_file($fileTmpName, "$img/$imageName");
						}
					}
				}
			
			update_entry($id, $category, $title, $body, $imageName, $imageType);
			header('Location:admin.php');
		}
		else {
			echo "<script language='javascript'>window.alert('This ID doesn\'t exist');
		window.location.href='admin.php';</script>";
		}
	}
}
else echo 'Not submited';

?>

