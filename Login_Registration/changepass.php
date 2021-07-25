<?php
  include 'inc/header.php';
  Session::checkSession();
?>
<?php 
	if(isset($_GET['id']))
	{
		$userid= (int) $_GET['id']; 
		$sesid= Session::get("id");

		if($userid!=$sesid)
		{
			header("Location: index.php");
		}				
	}	
	$user= new User();

	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['updatepass']))
	{
		$updatepass= $user-> updatePassword($userid, $_POST);
	}
?>
		<div class="panel panel-default">
		    <div class="panel-heading">
			    <h2 class="text-center"> ...Change Password... <span class="pull-right">
				<a class="btn btn-primary" href="profile.php?id=<?php echo $userid; ?>"> Back </a>
				</span> 
				</h2>
			</div>
			
			<div class="panel-body">
				<div style="max-width:600px; margin:0 auto">
					<?php
					    if(isset($updatepass))
						{
							echo $updatepass;
						}
					?>
					
					<form action="" method="POST">
		                <div class="form-group">
						    <label for="old_pass">Old_password</label>
							<input type="password" id="old_pass" name="old_pass" class="form-control"/ >
						</div>
						<div class="form-group">
						    <label for="password">New_password</label>
							<input type="password" id="password" name="password" class="form-control" / >
						</div>
										
						<button type="submit" name="updatepass" class="btn btn-success">Update</button>
						<button type="reset" name="clear" class="btn btn-warning">Clear</button>						
		            </form>				
	            </div>		    
			</div>
		</div>
