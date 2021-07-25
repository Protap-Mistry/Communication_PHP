<div class="grid_2">
            <div class="box sidemenu">
                <div class="block" id="section-menu">
                    <ul class="section menu">
                       <li><a class="menuitem">Site Option</a>
                            <ul class="submenu">
                               
                                <li><a href="titleslogan.php">Title & Slogan</a></li>
                                <li><a href="social.php">Social Media</a></li>
                                <li><a href="copyright.php">Copyright</a></li>
                                
                                
                            </ul>
                        </li>
						
                         <li><a class="menuitem">Pages</a>
                            <ul class="submenu">
                                <li><a href="addpage.php">Add New Page</a></li>

                                <?php
                                    $format= new Format();
                                   

                                    $pages= $format->showPages();                     
                                    if($pages)
                                    {
                                        foreach ($pages as $key => $value)
                                        {   
                                        
                                ?>

                                <li><a href="pages.php?page_id=<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></li>

                                <?php }} ?>

                            </ul>                           
                        </li>
                        <li><a class="menuitem">Slider Option</a>
                            <ul class="submenu">                       
                                <li><a href="addslide.php">Add Slide</a> </li>
                                <li><a href="slidelist.php">Slide List</a> </li>
                            </ul>
                        </li>
                        <li><a class="menuitem">Category Option</a>
                            <ul class="submenu">
                                <li><a href="addcat.php">Add Category</a> </li>
                                <li><a href="catlist.php">Category List</a> </li>
                            </ul>
                        </li>
                        <li><a class="menuitem">Post Option</a>
                            <ul class="submenu">                       
                                <li><a href="addpost.php">Add Post</a> </li>
                                <li><a href="postlist.php">Post List</a> </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>