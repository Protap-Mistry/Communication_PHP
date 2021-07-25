
<aside>
			<div id="inside_aside_section">
				<h3>Categories</h3>
				<ul>
					<?php 
						$format= new Format();
						$category= $format->showPostCategory();
						if($category)
						{
							foreach ($category as $key => $value) 
							{

					?>

					<li><a href="post_category.php?category_id=<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></li>

					<?php }} else { ?>

					<li> Ooops!!! No Category Found.</li>

					<?php } ?>
				</ul>
			</div>
			<div id="inside_aside_section">
				<h3>Latest Articles</h3>
				<div id="popular">

					<?php
					   $id= Session::get("id");
					   $userlogin= Session::get("login");
					   
				    ?>

						<?php 						
							$latest_post= $format->showLatestPost();

							if($latest_post)
							{
								foreach ($latest_post as $key => $value) 
								{

						?>

							<h4> <a 
									<?php if($userlogin==true)
					   					{ 
					   				?>

					   					href="post.php?id=<?php echo $value['id']; ?>"> <?php echo $value['title']; ?>										
					   			</a></h4>

									<?php  } 
				
										else 
											{ 
									?>

								<a	onclick="return confirm('You need to log-in first.');"  href="#"> <?php echo $value['title']; ?>

									<?php } ?>

									</a></h4>

							<h5><?php echo $format->formatDate($value['date']); ?>, By 
								<a 
									<?php if($userlogin==true)
					   					{ 
					   				?>

										href="post.php?id=<?php echo $value['id']; ?>"><?php echo $value['author']; ?></a></h5>

									<?php  } 
				
										else 
											{ 
									?>

								<a	onclick="return confirm('You need to log-in first.');"  href="#"> <?php echo $value['author']; ?>

									<?php } ?>

								</a></h5>

							<a 
								<?php if($userlogin==true)
				   					{ 
				   				?>

									href="post.php?id=<?php echo $value['id']; ?>"><img src="admin/<?php echo $value['image']; ?>" alt="Post_Logo"></a>

								<?php  } 
				
										else 
											{ 
									?>

								<a	onclick="return confirm('You need to log-in first.');"  href="#"><img src="admin/<?php echo $value['image']; ?>" alt="Post_Logo">

									<?php } ?>

								</a>

						<?php echo $format->textShorten($value['body'], 200); ?>
						
						<?php }} else{ header("Location:404.php"); }?>


				</div>
			</div>
			
		</aside>