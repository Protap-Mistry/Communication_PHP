<div id="slider_section">
		 <div id="script_id">
		 	<?php 
		 		$format= new Format();
		 		$show= $format->showSlideList();
		 		if($show){
		 			foreach ($show as $key => $value) {
		 				# code...
		 		?>
	            <a href="#"><img src="admin/<?php echo $value['image']; ?>" alt="Slider Image"></a>

            <?php }	}?>

        </div>
	</div>
