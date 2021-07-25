<?php 
	include 'include/header.php';
?>

<?php 
	if(!isset($_GET['category_id']) || $_GET['category_id']== null){
		header("Location: 404.php");
	}
	else
	{
		$cat_id= $_GET['category_id'];
	}
?>

<div id="content_section">
	<main>
		<?php
		   $id= Session::get("id");
		   $userlogin= Session::get("login");
		   
	    ?>
		<?php 

			$format= new Format();

			$result= $format->getCategoryPost($cat_id);

			if($result)
			{
				foreach ($result as $key => $value) 
			{

		?>
			<div id="inside_main_section">
				<h3><a 
					<?php if($userlogin==true)
	   					{ 
	   				?>
						href="post.php?id=<?php echo $value['id']; ?>"><?php echo $value['title']; ?>
							
					</a></h3>

					<?php  } 
				
						else 
							{ 
					?>

						<a	onclick="return confirm('You need to log-in first.');"  href="#"> <?php echo $value['title']; ?>

					<?php } ?>

						</a></h3>

				<h4><?php echo $format->formatDate($value['date']); ?>, By 
					<a 
						<?php if($userlogin==true)
		   					{ 
		   				?>
							href="post.php?id=<?php echo $value['id']; ?>"><?php echo $value['author']; ?>
							
					</a></h4>

					<?php  } 
				
						else 
							{ 
					?>

						<a	onclick="return confirm('You need to log-in first.');"  href="#"> <?php echo $value['author']; ?>

					<?php } ?>

						</a></h4>

				<a 
					<?php if($userlogin==true)
	   					{ 
	   				?>
						href="post.php?id=<?php echo $value['id']; ?>"><img src="admin/<?php echo $value['image']; ?>" alt="Post_Logo">
				</a>

				<?php  } 
				
					else 
						{ 
				?>

					<a	onclick="return confirm('You need to log-in first.');"  href="#"> <img src="admin/<?php echo $value['image']; ?>" alt="Post_Logo">

				<?php } ?>

					</a>
					
				<?php echo $format->textShorten($value['body']); ?>

				<div id="read_more">
					<a 
						<?php if($userlogin==true)
		   					{ 
		   				?>
						href="post.php?id=<?php echo $value['id']; ?>">Continue...
					</a>

					<?php  } 
				
						else 
							{ 
					?>

						<a	onclick="return confirm('You need to log-in first.');"  href="#"> Continue...

					<?php } ?>

						</a>
				</div>
			</div>

		<?php }} else{ header("Location:404.php"); }?>

	</main>
		
		<?php include 'include/right_sidebar.php'; ?>

</div>

<?php include 'include/footer.php'; ?>