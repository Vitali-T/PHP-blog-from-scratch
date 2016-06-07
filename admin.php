<?php 
include 'includes/header.php';

if(session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['username'])){
	echo <<<EOD
	<div class="wrapper">
		<div class="content-wrap">
			<h1>Administration panel</h1><br>
			<a href="logout.php"><button type="button" class="logout-btn">Log out</button></a><br>
			<a href="" class="show"><button type="button" class="new-post-btn">Add a new post</button></a><br><br>
			<div class="new-post">
				<h3>New Post: </h3>
				<form action="add_post.php" method="POST" onsubmit = "return validateNewPost(this);" enctype = "multipart/form-data">
					<label class="label-title">Title: </label><br><input type="text" name="title" class="new-post-title"><br>
					<label class="label-title">Category: </label><br>
					<input type="text" name="category" placeholder="New Category" class="new-post-title"><br>
					<label class="label-title">Text: </label><br><textarea name="postBody" cols="25" rows="10"></textarea><br>
					<label class="label-title">Image (max 1MB): </label><br><input name="image" type="file" class="upload-img"/><br><br>
					<input type="submit" name="submit" value="Submit" class="edit-btn">
				</form>
			</div>
			<a href="edit_post.php"><button class="edit-post-btn type="button">Edit a post</button></a><br><br>
			<div class="edit-post">
					<h2>Edit Post: </h2>
					<form action="edit_post.php" method="POST" onsubmit="return validateEditPost(this)" enctype = "multipart/form-data">
						<label class="label-title">ID: </label><br><input type="text" name="id" class="new-post-id"><br>
						<label class="label-title">Title: </label><br><input type="text" name="title" class="new-post-title"><br>
						<label class="label-title">Category: </label><br><input type="text" name="category" class="new-post-title"><br>
						<label class="label-title">Text: </label><br><textarea name="postBody" cols="25" rows="10"></textarea><br>
						<label class="label-title">Image (max 1MB): </label><br><input name="image" type="file" class="upload-img"/><br><br>
					<input type="submit" name="submit" value="Submit" class="edit-btn">
					</form>
			</div>
			<a href="delete_post.php"><button type="button" class="delete-post-btn">Delete a post</button></a><br><br>
			<div class="delete-post">
				<h2>Delete Post: </h2>
				<form action="delete_post.php" method="POST" onsubmit =  "return validateDeletePost(this) & confirm('Are you sure you want to delete this post?');">
				<label class="label-title">ID: </label><input type="text" name="ToDelete" class="delete-post-id"><br>
				<input type="submit" name="submit" value="Delete" class="delete-btn">
				</form>
			</div>
		</div
	</div>
</div>
EOD;
include_once 'includes/footer.php';
}
else
	header('Location:login.php');
?>
