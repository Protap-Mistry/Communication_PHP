<?php 

	include 'include/header.php';

?>

<link rel="stylesheet" href="css/pages.css?v=<?php echo time()?>">

	<div id="content_section">
		<main>

            <?php 
                if(!isset($_GET['footer_page_id']) || $_GET['footer_page_id']== null){
                    header("Location: 404.php");
                }
                else
                {
                    $footer_page_id= $_GET['footer_page_id'];
                }
            ?>
            <?php
                $format= new Format();

                $select_page= $format->selectPageById($footer_page_id);

                if($select_page){
                    
            ?>
			<div id="junction">
				<h3><?php echo $select_page->name; ?></h3>
				<p><?php echo $select_page->body; ?></p>
			</div>

			<?php } else { header("Location: 404.php"); }?>

		</main>

		<?php include 'include/right_sidebar.php'; ?>
		
	</div>	

<?php include 'include/footer.php'; ?>