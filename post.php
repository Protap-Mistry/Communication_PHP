<?php 

	include 'include/header.php';
?>
<link rel="stylesheet" href="css/about.css?v=<?php echo time()?>">

<?php 
	if(!isset($_GET['id']) || $_GET['id']== null){
		header("Location: 404.php");
	}
	else
	{
		$id= $_GET['id'];
	}
?>

	<div id="content_section">
		<main>
			<div id="about">

				<?php 

					$format= new Format();

					$result= $format->showSpecificPost($id);

					if($result)
					{
						foreach ($result as $key => $value) 
						{

				?>

				<h3><?php echo $value['title']; ?></h3>
				<h4><?php echo $format->formatDate($value['date']); ?>, By <a href=""><?php echo $value['author']; ?></a></h4>
				<img src="admin/<?php echo $value['image']; ?>" alt="Post_Logo">
				
				<?php echo $value['body']; ?>

				<div id="back">
					<a href="index.php">Back</a>
				</div>
				<div id="related_post">
					<h2>Realated Articles</h2>

					<?php

						$category_id= $value['category_id'];

						$related_result= $format->showRelatedPost($category_id);

						if($related_result)
						{
							foreach ($related_result as $key => $value) 
							{
					?>

					<a href="post.php?id=<?php echo $value['id']; ?>"><img src="admin/<?php echo $value['image']; ?>" alt="Related Post Logo"></a>

					<?php }} else{ echo "No related post available"; }?>

				</div>

				<?php }} else{ header("Location:404.php"); }?>
				
				<div id="disqus_thread">
					
				</div>
				<script>
				    /**
				    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
				    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
				    /*
				    var disqus_config = function () {
				    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
				    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
				    };
				    */
				    (function() { // DON'T EDIT BELOW THIS LINE
				    var d = document, s = d.createElement('script');
				    s.src = 'https://communication-6.disqus.com/embed.js';
				    s.setAttribute('data-timestamp', +new Date());
				    (d.head || d.body).appendChild(s);
				    })();
				</script>
				<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a>
				</noscript>

			</div>
		</main>

		<?php include 'include/right_sidebar.php'; ?>

	</div>
		
<?php include 'include/footer.php'; ?>