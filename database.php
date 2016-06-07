<?php 

session_start();

DEFINE ('HOST', 'localhost');
DEFINE ('USER', 'root');
DEFINE ('PASSWORD', '123');
DEFINE ('DATABASE', 'database');

$db = new mysqli(HOST, USER, PASSWORD, DATABASE);

if($db->connect_errno){
	
	die('Unable to connect to database');
}

function validateUpload(){
	GLOBAL $db;
	if($_FILES['image']['error'] == UPLOAD_ERR_OK){
		$maxFileSize = 1048576;
		$fileName = $_FILES['image']['name'];
		$fileType = $_FILES['image']['type'];
		//$fileData = $db->real_escape_string(file_get_contents($_FILES['image']['tmp_name']));
		$fileTmpName = $_FILES['image']['tmp_name'];
		$fileSize = $_FILES['image']['size'];
		$fileError = $_FILES['image']['error'];
		
		if($fileSize > $maxFileSize){
			echo "<script language='javascript'>window.alert(\"Maximum size: '".($maxFileSize/1024)."'Kb'\");
			window.location.href='admin.php';</script>";
			return false;
			
		}
		else if (substr($fileType, 0, 5) !== 'image'){
			echo "<script language='javascript'>window.alert('Only images are allowed!');
			window.location.href='admin.php';</script>";
			return false;
		}
		$fileInfo = array ($fileType, $fileName, $fileTmpName);
		return $fileInfo;
		}
	else
		return false;
}

function create_entry($category, $title, $body, $imageName = 'None', $imageType = 'None'){

	GLOBAL $db; 
	if($db->query("INSERT INTO posts (category, title, body, imgName, imgType, created, updated) VALUES ('$category', '$title', '$body', '$imageName', '$imageType', NOW(), NOW())")){
		echo "Record created!";
	}
	else{
		echo 'Fail: '. $db->error;
	}
}

function delete_entry($id){
	
	GLOBAL $db;
	$get_title = $db->query("SELECT title FROM posts WHERE id = $id");
	$db->query("DELETE FROM posts WHERE id = $id");
}

function update_entry($id, $category, $title, $body, $imageName, $imageType){
	
	GLOBAL $db;
	$get_id = $db->query("SELECT id FROM posts");
	while($row = $get_id->fetch_object()){
		if($row->id == $id){
			if($result = $db->query("UPDATE posts SET category = '$category', title = '$title', body = '$body', imgName = '$imageName', imgType = '$imageType', updated = NOW() WHERE id = $id")){
				echo "Record updated!";
			}
			else 
				echo "<br>Not updated<br>".$db->error;
		}
	}
}

function get_entries(){

	GLOBAL $db;
	if(isset($_GET['category'])){
		$category = $db->real_escape_string($_GET['category']);
		$get_post= $db->query("SELECT id, title, category, body, imgName, imgType, created, updated FROM posts WHERE category = '$category' ORDER BY updated DESC");
	}
	else{
		$get_post = $db->query("SELECT id, title, category, body, imgName, imgType, created, updated FROM posts ORDER BY updated DESC");
	}
	if($get_post){
		while($row = $get_post->fetch_object()){
			echo '<br>
			<h2 class="post-title">',$row->title, '</h2>
			<p class="category-name"><em>',$row->category,'</em></p>
			<div class="post-content">
				<img class="post-image" src="img/',$row->imgName,'">',
				$row->body,'
			</div><br>
			<a href="entire_post.php?id=',$row->id,'"><input class="read-more-btn" type="submit" name="submit" value="Read more"></a>
			<div class="post-info">
				<p><em>Created: '.$row->created,'</em></p> 
				<p><em>Updated: ',$row->updated,'</em></p>
				<p><em>ID: ',$row->id,'</em></p>
			</div>
			<br>
			<hr>';
		}
	}
	else{
		echo 'Nothing to return';
	}
}
function get_categories(){
	GLOBAL $db;
	if($get_categories = $db->query("SELECT distinct category FROM posts ORDER BY category")){
		while($row = $get_categories->fetch_object()){
			echo '<li class="category-item"><a href="index.php">'.$row->category.'</a></li>';
		}
	}	
}
?>