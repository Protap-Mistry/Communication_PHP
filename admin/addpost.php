<?php 
    include 'include/header.php'; 
    include 'include/sidebar.php'; 
?>

    <div class="grid_10">
	
        <div class="box round first grid">
            <h2>Add New Post</h2>
            <div class="block">

             <form action="" method="POST" enctype="multipart/form-data">

                <?php 
                    $format= new Format();
                    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){

                        $post= $format->addPost($_POST);

                        if(isset($post)){
                            echo $post;
                       }
                    }
                ?>
            
                <table class="form">
                   
                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
                        </td>
                    </tr>
                 
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="category">
                                <option>Select Category</option>

                                 <?php 

                                    $category= $format->showPostCategory();                     
                                    if($category){
                                        foreach ($category as $key => $value) {
                                
                                ?>

                                <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>

                                <?php }} ?>

                            </select>
                        </td>
                    </tr>
               
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input type="file" name="image"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>
                            <input type="text" name="author" value="<?php echo Session::get('username'); ?>" class="medium" />
                            <input type="hidden" name="userid" value="<?php echo Session::get('id'); ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tag(s)</label>
                        </td>
                        <td>
                            <input type="text" name="tags" placeholder="Enter Tag(s) Title. More than one also allow." class="medium" />
                        </td>
                    </tr>
					<tr>
                        <td></td>

                        <?php
 
                            if(Session::get('role') == '0' || Session::get('role') == '2')
                            {
                        ?>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>

                        <?php }else { ?>
                         
                            <div style="color:red; font-weight: bold;">
                                <?php echo "No create option available for *Author";} ?>
                            </div>
                    </tr>
                </table>
                </form>
            </div>
        </div>
    </div>

    <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
        
<?php include 'include/footer.php'; ?>