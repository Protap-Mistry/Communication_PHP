<?php 
	include 'include/header.php';
?>

<?php 
	if(!isset($_POST['search']) || $_POST['search']== null){
		header("Location: 404.php");
	}
	else
	{
		$search= $_POST['search'];
	}
?>

<div id="content_section">
	<main>
		<?php 

			$format= new Format();

			$search_result= $format->searchPost($search);

			if($search_result)
			{
				foreach ($search_result as $key => $value) 
			{

		?>
			<div id="inside_main_section">
				<h3><a href="post.php?id=<?php echo $value['id']; ?>"><?php echo $value['title']; ?></a></h3>
				<h4><?php echo $format->formatDate($value['date']); ?>, By <a href="post.php"><?php echo $value['author']; ?></a></h4>
				<a href="post.php"><img src="admin/<?php echo $value['image']; ?>" alt="Post_Logo"></a>

				<?php echo $format->textShorten($value['body']); ?>

				<div id="read_more">
					<a href="post.php?id=<?php echo $value['id']; ?>">Continue...</a>
				</div>
			</div>

		<?php }} else{ echo "Ooops!!! Sorry, Your Mind Not Found."; }?>

	</main>
		
		<?php include 'include/right_sidebar.php'; ?>

</div>

<?php include 'include/footer.php'; ?>