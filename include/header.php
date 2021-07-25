<?php
	$filepath= realpath(dirname(__FILE__));
	include $filepath.'/../helper/format.php';

?>

<?php
	$filepath= realpath(dirname(__FILE__));
	include_once $filepath.'/../Login_Registration/lib/Session.php';
	Session::init();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="description" content="It's a website about communication">

	<?php 
		define("keywords", "Facebook, What'sapp, Instagram, Twitter");
	?>
	<?php 
       	if(isset($_GET['id']))
		{ 
			$post_id= $_GET['id'];

			$format= new Format();

            $select_post= $format->selectPostById($post_id);

            if($select_post)
            {
    ?>

    <meta name="keywords" content="<?php echo $select_post->tags; ?>">

	<?php }}else{ ?>

	<meta name="keywords" content="<?php echo keywords; ?>">

	<?php } ?>

	<meta name="author" content="Protap">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=none">

	<?php 
        if(isset($_GET['footer_page_id']))
        {
            $footer_page_id= $_GET['footer_page_id'];

            $format= new Format();

            $select_page= $format->selectPageById($footer_page_id);

            if($select_page)
            {
    ?>

    <title><?php echo $select_page->name; ?></title>

    <?php 
		} } 
		elseif(isset($_GET['id']))
		{ 
			$post_id= $_GET['id'];

			$format= new Format();

            $select_post= $format->selectPostById($post_id);

            if($select_post)
            {	
	?>

	<title><?php echo $select_post->author; ?></title>

	<?php } }else{ ?>

    <title>
    	<?php 

	    	$format= new Format();

	    	echo $format->pageTitle();
    	?>
    		
    </title>	
    
    <?php } ?>

	<!--<script language="javascript" type="text/javascript">
		function clearText(field)
		{
    		if (field.defaultValue == field.value) field.value = '';
    		else if (field.value == '') field.value = field.defaultValue;
		}
	</script> -->

	<link rel="stylesheet" href="css/style.css?v=<?php echo time()?>">
	<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css?v=<?php echo time()?>">

	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
	<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

	<script type="text/javascript">
		$(window).load(function() {
			$('#script_id').nivoSlider({
				effect:'random',
				slices:10,
				animSpeed:500,
				pauseTime:5000,
				startSlide:0, //Set starting Slide (0 index)
				directionNav:false,
				directionNavHide:false, //Only show on hover
				controlNav:false, //1,2,3...
				controlNavThumbs:false, //Use thumbnails for Control Nav
				pauseOnHover:true, //Stop animation while hovering
				manualAdvance:false, //Force manual transitions
				captionOpacity:0.8, //Universal caption opacity
				beforeChange: function(){},
				afterChange: function(){},
				slideshowEnd: function(){} //Triggers after all slides have been shown
			});
		});
	</script>
		
</head>

<body>
	<header>
		
		<?php 
			$format= new Format();
			
			$title_slogan= $format->showTitleSlogan();                     
	        if($title_slogan)
	        {
	            foreach ($title_slogan as $key => $value) 
	            {

		?>

		<div id="logo">
			<a href="index.php"><img src="admin/<?php echo $value['logo']; ?>" alt="Logo"></a>
			<h3><?php echo $value['title']; ?></h3>
			<p><?php echo $value['slogan']; ?></p>
		</div>

		<?php } } ?>

		<?php 
			
			$social= $format->showSocial();                     
	        if($social)
	        {
	            foreach ($social as $key => $value) 
	            {
    
		?>

		<div id="social_logo">
			<a href="<?php echo $value['fb']; ?>" target="_blank" title="Facebook"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
			<a href="<?php echo $value['wapp']; ?>" target="_blank" title="Whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
			<a href="<?php echo $value['twtr']; ?>" target="_blank" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
			<a href="<?php echo $value['email']; ?>" target="_blank" title="E-mail"><i class="fa fa-envelope-open" aria-hidden="true"></i></a>
		</div>

		<?php }} ?>

	</header>
	<nav>

		<?php 
			$path= $_SERVER['SCRIPT_FILENAME'];
			$current_page= basename($path,'.php');
		?>

		<ul>
			<li><a 
					<?php 
						if($current_page == 'index')
						{
							echo 'id="navbar_active"';
						}
					?>
					href="index.php">Abode
				</a>
			</li>

			<?php
			   $id= Session::get("id");
			   $userlogin= Session::get("login");
			   if($userlogin==true)
			   {

		    ?>
		   		<li><a href="Login_Registration/index.php">Profile</a></li>

		    <?php  } 
				
				else 
			{ ?>

				<li><a href="Login_Registration/register.php">Sign-up</a></li>
				<li><a href="Login_Registration/login.php">Log-in</a></li>

			<?php } ?>

			<li class="searchbtn">
				
				<form action="search.php" method="POST">
					<input type="text" name="search" placeholder="Search Your Mind..."/>
					<input type="submit" name="submit" value="Inquiry"/>
				</form>
			
			</li>
		</ul>
	</nav>