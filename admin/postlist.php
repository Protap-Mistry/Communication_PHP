<?php 
    include 'include/header.php'; 
    include 'include/sidebar.php'; 
?>

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Post List</h2>
            <div class="block">

        		<!--delete portion -->
				<?php
					$format= new Format();

					if(isset($_GET['post_id']))
					{
						$id= $_GET['post_id'];

						$delete_post= $format->deletePost($id);
						
						if($delete_post){
							echo $delete_post;
						}
					}
				?>

                <table class="data display datatable" id="example">
				<thead>
					<tr>
						<th width="2%">Serial</th>
						<th width="10%">Post Title</th>
						<th width="5%">Category</th>
						<th width="5%">Image</th>
						<th width="20%">Description</th>
						<th width="10%">Tags</th>
						<th width="5%">Author</th>
						<th width="10%">Date</th>
						<th width="13%">Actions</th>
					</tr>
				</thead>
				<tbody>

					<?php 
						$post= $format->showPostList();						
						if($post){
							$i=0;
							foreach ($post as $key => $value) {
								$i++;
					
					?>

					<tr class="odd gradeX">
						<td><?php echo $i; ?></td>
						<td><?php echo $value['title']; ?></a></td>
						<td><?php echo $value['name']; ?></td>
						<td><img src="<?php echo $value['image']; ?>" height="40px" width="60px"/></td>
						<td><?php echo $format->textShorten($value['body'], 200); ?></td>
						<td><?php echo $value['tags']; ?></td>
						<td><?php echo $value['author']; ?></td>
						<td><?php echo $format->formatDate($value['date']); ?></td>

						<td>
							<a href="view_post.php?post_id=<?php echo $value['id']; ?>">View</a>

							<?php 
								if(Session::get('id') == $value['userid'] || Session::get('role') == '0')
								{
							?>

								|| <a href="edit_post.php?post_id=<?php echo $value['id']; ?>">Update</a> || 		
								<a onclick="return confirm('Are u sure to delete?');" href="?post_id=<?php echo $value['id']; ?>">Delete</a>

							<?php } ?>

						</td>
					</tr>
					
					<?php }} ?>

				</tbody>
			</table>

           </div>
        </div>
    </div>

	<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
    </script>
        
<?php include 'include/footer.php'; ?>