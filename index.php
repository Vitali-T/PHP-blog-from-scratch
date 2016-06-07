<?php 

include 'add_post.php';

?>  
<div class="wrapper">
	<div class="content-wrap">
		<?php get_entries();?>
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