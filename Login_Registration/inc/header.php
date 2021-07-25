<?php
	$filepath= realpath(dirname(__FILE__));
	include_once $filepath.'/../lib/User.php';

?>
<?php
	$filepath= realpath(dirname(__FILE__));
	include_once $filepath.'/../lib/Session.php';
	Session::init();
?>
 <!DOCTYPE html>
 <html>
 <head>  
    <title> Login Register System PHP </title>
	
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<script src="js/bootstrap.min.js"></script>
	<script src="jquery/jquery.min.js"></script> <!-- google hosted jquery file -->

 </head>
 <?php
   if(isset($_GET['action']) && $_GET['action']=="logout")
   {
	   Session::destroy();
   }
 ?>
 <body>
    <div class="container">
	    <nav class="navbar navbar-default">
            <div class="container-fluid">
			    <div class="navbar-header">
				<?php 
					$user= new User();
					
					$title_slogan= $user->showTitleSlogan();                     
			        if($title_slogan)
			        {
			            foreach ($title_slogan as $key => $value) 
			            {

				?>
						
					<a href="../index.php"><img src="../admin/<?php echo $value['logo']; ?>" alt="Logo" style="height: 100px; width: 100px; border-radius: 150px;"></a>

				<?php } } ?>

				</div>
				
				<ul class="nav navbar-nav pull-right">
				  <?php
					   $id= Session::get("id");
					   $userlogin= Session::get("login");
					   if($userlogin==true)
					   {

				   ?>
					   <li> <a href="index.php"> Home </a> </li>
					   <li> <a href="profile.php?id=<?php echo $id; ?>"> Profile </a>  </li>
					   <li> <a href="?action=logout"> Logout </a> </li>
				   <?php  } 
				   		else 
				   { ?>
					   <li> <a href="login.php"> Login </a> </li>
					   <li> <a href="register.php"> Register </a> </li>
                   <?php } ?>
				</ul>
			</div>
		</nav>
	</body>
</html>