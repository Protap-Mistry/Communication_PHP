<?php 
	include 'inc/header.php';

	Session::init();
	Session::checkLogin();
?>
<div class="panel panel-default">
    <div class="panel-heading">
	    <h2 class="text-center"> ...User Password Recovery... </h2>
	</div>
	<div class="panel-body">
		<div style="max-width:600px; margin:0 auto">
		
			<form action="" method="POST">

				<?php
					$user= new User();

					if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){

						$pass_recover= $user->passwordRecover($_POST);
						
						if(isset($pass_recover)){
							echo $pass_recover;
						}
					}
				?>

				 <div class="form-group">
				    <label for="email">Email Address</label>
					<input type="text" id="email" name="email" class="form-control"/ >
				</div>
				<div>
					<button type="submit" name="submit" class="btn btn-success">Send E-mail</button>
					<a href="login.php" style="text-decoration: none; font-size: 16px; font-weight: bold; float: right;">Log-in</a>
				</div>
			</form>
		</div>		    
	</div>
</div>
