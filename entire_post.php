<?php 
include 'includes/header.php';

function get_entire_post(){
	GLOBAL $db;
	$id = $_GET['id'];
	$get_post = $db->query("SELECT id, title, category, body, imgName, imgType, created, updated FROM posts WHERE id = '$id'");
	if($get_post){
		while($row = $get_post->fetch_object()){
			echo '<br>
			<h2 class="post-title">',$row->title, '</h2>
			<p class="category-name"><em>',$row->category,'</em></p>
			<div class="entire-post-content">
				<img class="post-image" src="img/',$row->imgName,'">',
				$row->body,'
			</div><br>
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
?>

<div class="wrapper">
	<div class="content-wrap">
		<?php get_entire_post();?>
	</div>

	<div id="categories">
		<h2>Categories</h2>
		<ul class="category-list">
			<li class="category-item-all"><a href="index.php">All Categories</a></li>
			<?php get_categories();?>
		</ul>
	</div>
</div>
<?php include 'includes/footer.php';
