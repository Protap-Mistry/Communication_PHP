<?php 

	include 'include/header.php';

?>

<link rel="stylesheet" href="css/feedback.css?v=<?php echo time()?>">

	<div id="content_section">
		<main>
			<div id="opinion">
				<h3>Give Your Opinion(s)</h3>
				<form action="" method="POST">

					<?php
						
						$format= new Format();

						if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){

							$feedback= $format->userFeedback($_POST);
							
							if(isset($feedback)){
								echo $feedback;
							}
						}
					?>

					<table id="tbl">
						<tr>
							<td>Your First Name</td>
							<td><input type="text" name="firstname" placeholder="Put Your First Name..."></td>
						</tr>
						<tr>
							<td>Your Last Name</td>
							<td><input type="text" name="lastname" placeholder="Put Your Last Name..."></td>
						</tr>
						<tr>
							<td>Your E-mail Address</td>
							<td><input type="email" name="email" placeholder="Put Your E-mail Address..."></td>
						</tr>
						<tr>
							<td>Queries</td>
							<td><textarea name="body"> </textarea></td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="submit" name="submit" value="Send">
							</td>
						</tr>
				</table>
					
				</form>
			</div>
		</main>

		<?php include 'include/right_sidebar.php'; ?>

	</div>	
	
<?php include 'include/footer.php'; ?>