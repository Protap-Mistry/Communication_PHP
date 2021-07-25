<?php 
    include 'include/header.php'; 
    include 'include/sidebar.php'; 
?>
<?php 
    if(!isset($_GET['post_id']) || $_GET['post_id']== null){
        
        echo "<script> window.location= 'postlist.php'; </script>";
    }
    else
    {
        $post_id= $_GET['post_id'];
    }
?>

    <div class="grid_10">
	
        <div class="box round first grid">
            <h2>View Post</h2>
           <div class="block copyblock"> 
             <form action="" method="POST">

                <?php 
                    $format= new Format();
                    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){

                        echo "<script> window.location= 'postlist.php'; </script>";
                      
                    }

                    $post= $format->selectPostById($post_id);

                    if($post){
                        
                ?>
                <table class="form">					
                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input readonly="" type="text" value="<?php echo $post->title; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" readonly="">
                                

                                 <?php 

                                    $category= $format->showPostCategory();                     
                                    if($category){
                                        foreach ($category as $key => $value) {
                                
                                ?>

                                <option 
                                    <?php 
                                        if($post->category_id == $value['id'])
                                        { 
                                    ?>
                                        selected="selected";    
                                       
                                    <?php  } ?>

                                    value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>

                                <?php }} ?>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Post Image</label>
                        </td>
                        <td>
                            <img src="<?php echo $post->image; ?>" height="100px" width="200px" alt="post_logo">
                        </td>
                    </tr>              
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" readonly="">
                                <?php echo $post->body; ?>
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>
                            <input type="text" readonly="" value="<?php echo Session::get('username'); ?>" class="medium" />
                            <input type="hidden" readonly="" value="<?php echo Session::get('id'); ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tag(s)</label>
                        </td>
                        <td>
                            <input type="text" readonly="" value="<?php echo $post->tags; ?>" class="medium" />
                        </td>
                    </tr>
					<tr> 
                        <td></td>
                        <td>
                            <input readonly="" type="submit" name="submit" Value="Done" />
                        </td>
                    </tr>
                </table>

                <?php } ?>

                </form>
            </div>
        </div>
    </div>
        
<?php include 'include/footer.php'; ?>
