
<?php 

	include 'include/header.php';
	include 'include/slider.php';
?>

	<div id="content_section">
		<main>
			<!--pagination part-1 start-->
			<?php 

				$show_per_page= 5;
				
				if(isset($_GET['page'])){

					$page= $_GET['page'];
				}
				else{
					$page= 1;
				}

				$track_start_page= ($page-1)*$show_per_page;
			?>
			<!--pagination part-1 end-->
			<?php
			   $id= Session::get("id");
			   $userlogin= Session::get("login");
			   
		    ?>

			<?php 

				$format= new Format();

				$result= $format->getPost($track_start_page, $show_per_page);

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

			<?php } ?>
			<!--pagination part-2 start-->
			<?php

				$pagination_result= $format->pagination();

				$total_pages= ceil($pagination_result/$show_per_page);

				echo "<span class='pagination'> 
						<a href='index.php?page=1'>Start</a>";

						for ($i=1; $i <=$total_pages ; $i++) { 
							
							echo "<a href='index.php?page=$i'>$i</a>";
						}

						echo "<a href='index.php?page=$total_pages'>End</a> 
					</span>";
			?>
			<!--pagination part-2 end-->
			<?php } else{ header("Location:404.php"); }?>

		</main>
		
		<?php include 'include/right_sidebar.php'; ?>

	</div>

<?php include 'include/footer.php'; ?>