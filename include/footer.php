	<footer>

		<?php 
			$path= $_SERVER['SCRIPT_FILENAME'];
			$current_page= basename($path,'.php');
		?>

		<div id="inside_footer">
			<a 
				<?php 
					if($current_page == 'about')
					{
						echo 'id="footer_active"';
					}
				?>
				href="about.php">About</a>
			
			<a
				<?php 
					if($current_page == 'feedback')
					{
						echo 'id="footer_active"';
					}
				?> 
				href="feedback.php">Feedback</a>

			<?php
                $format= new Format();               

                $pages= $format->showPages();                     
                if($pages)
                {
                    foreach ($pages as $key => $value)
                    {   
                    
            ?>
			<a 
				<?php 
					if(isset($_GET['footer_page_id']) && $_GET['footer_page_id'] == $value['id'])
					{
						echo 'id="footer_active"';
					}
				?>
				href="pages.php?footer_page_id=<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a>

			<?php } } ?>

		</div>


		<?php 
			
			$footer= $format->showFooterCopyright();                     
	        if($footer)
	        {
	            foreach ($footer as $key => $value) 
	            {

		?>

		<p>&copy; <?php echo $value['text']; ?><?php echo " ".date('Y'); ?></p>

		<?php } } ?>

	</footer>

	<?php 
		
		$social= $format->showSocial();                     
        if($social)
        {
            foreach ($social as $key => $value) 
            {

	?>

	<div id="fixed_icon">
		<a href="<?php echo $value['fb']; ?>" title="Facebook" target="_blank"><img src="images/social_logo/recent/facebook.png" alt="Facebook"></a>
		<a href="<?php echo $value['email']; ?>" title="Google" target="_blank"><img src="images/social_logo/recent/google.png" alt="Google"></a>
		<a href="<?php echo $value['twtr']; ?>" title="Twitter" target="_blank"><img src="images/social_logo/recent/twitter.png" alt="Twitter"></a>
	</div>

	<?php } } ?>

	<script type="text/javascript" src="js/top_up.js"></script>
	<script id="dsq-count-scr" src="//communication-6.disqus.com/count.js" async></script>

</body>
</html>