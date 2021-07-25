<?php 
	
$filepath= realpath(dirname(__FILE__));
include_once $filepath.'/../database/db.php';
	
	class Format{

		private $db;

		public function __construct()
		{
			$this->db= new databaseClass();
		}

		public function formatDate($d){

			return date('F j, Y, g:i a', strtotime($d));
		}
		public function textShorten($text, $limit= 400){

			$text1= $text." ";
			$text2= substr($text1, 0, $limit);
			$text3= substr($text2, 0, strrpos($text2, " "));
			$text4= $text3."...";
			return $text4;
		}
		//to show posts
		public function getPost($track_start_page, $show_per_page){

			$sql= "select * from post limit $track_start_page, $show_per_page";
			$result= databaseClass::ourPrepareMethod($sql);
			$result->execute();

			return $result->fetchAll();
		}
		//pagination
		public function pagination(){

			$sql= "select count(id) from post";
			$result= databaseClass::ourPrepareMethod($sql);
			$result->execute();

			$total_rows= $result->fetchColumn();
			return $total_rows;
		}
		//show a post
		public function showSpecificPost($id){

			$sql="select * from post where id=:id";
			$result= databaseClass::ourPrepareMethod($sql);
			$result->bindValue(':id', $id);
			$result->execute();
			return $result->fetchAll();
		}
		//show related post
		public function showRelatedPost($id){

			$sql="select * from post where category_id=:id limit 4";
			$result= databaseClass::ourPrepareMethod($sql);
			$result->bindValue(':id', $id);
			$result->execute();
			return $result->fetchAll();
		}
		//show categories
		public function showPostCategory(){

			$sql="select * from category";
			$result= databaseClass::ourPrepareMethod($sql);
			$result->execute();
			return $result->fetchAll();
		}
		//get category post
		public function getCategoryPost($id){

			$sql="select * from post where category_id=:id";
			$result= databaseClass::ourPrepareMethod($sql);
			$result->bindValue(':id', $id);
			$result->execute();
			return $result->fetchAll();
		}
		//show latest post
		public function showLatestPost(){

			$sql="select * from post order by id desc limit 3";
			$result= databaseClass::ourPrepareMethod($sql);
			$result->execute();
			return $result->fetchAll();
		}
		//search post
		public function searchPost($search){

			$sql="select * from post where title like '%$search%' or body like '%$search%'";
			$result= databaseClass::ourPrepareMethod($sql);
			$result->execute();
			return $result->fetchAll();
		}

		//for admin portion

		public function validation($data){

			$data= trim($data);
			$data= stripslashes($data);
			$data= htmlspecialchars($data);
			
			return $data;
		}
		//for admin login
		public function getLoginUser($username, $password)
		{
			$sql= "select * from user where username= :username and password= :password";
			$query= databaseClass::ourPrepareMethod($sql);
			$query->bindValue(':username', $username);
			$query->bindValue(':password', $password);
			$query->execute();
			
			return $query->fetch(PDO::FETCH_OBJ);
			
		}
		public function userLogin($data)
		{
			$username= $data['username'];
			$password= $data['password'];
					
			if($username== "" OR $password== "")
			{
				$msg= "<div style='color:red;'> <strong> Error! </strong>Field must not be empty </div>";
				return $msg;
			}
			if(preg_match('/[^A-Za-z0-9 ._-]+/i', $username)){

			$msg= "<div style='color:red;'> <strong> Error!!! </strong> Username must only contain alphanumerical, dashes and underscore.</div>";
			return $msg;
			}elseif (strlen($username)<3) {
					
				$msg= "<div style='color:red;''> <strong> Error!!! </strong> Username is too short </div>";
				return $msg;
			}
			if(strlen($password)<5)
			{
				$msg= "<div style='color:red;'> <strong> Error! </strong>Password is too short. It must be greater than 4 values </div>";
				return $msg;
			}
			$password= md5($data['password']);

			$result= $this->getLoginUser($username, $password);

			if($result)
			{
				Session::init();
				Session::set("login", true);
				Session::set("id", $result->id);
				Session::set("name", $result->name);
				Session::set("username", $result->username);
				Session::set("email", $result->email);
				Session::set("details", $result->details);
				Session::set("role", $result->role);
				Session::set("loginmsg", "<div style='color:green;'> <strong>Successfull! </strong>
				You are logged in... </div>");
				header("Location: index.php");
			}
			else
			{
				$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Data not found ! </div>";
				return $msg;
			}
		}
		//insert category type
		public function addCategory($data){
			$name= $data['name'];

			if($name== "")
			{
				$msg= "<div style='color:red;'> <strong> Error! </strong>Field must not be empty </div>";
				return $msg;
			}
			if(preg_match('/[^A-Za-z0-9 ._-]+/i', $name)){

			$msg= "<div style='color:red;''> <strong> Error!!! </strong> Category name must only contain alphanumerical, dashes and underscore.</div>";
			return $msg;
			}

			$sql= "insert into category(name) values(:name)";
			$query= databaseClass::ourPrepareMethod($sql);
			$query->bindValue(':name', $name);
			
			if($query->execute())
			{
				$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>Thank You, you have been added a new category. </div>";
				return $msg;
			}
			else
			{
				$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, there has been problem to insert your category.  </div>";
				return $msg;
			}
		}
		//update category
		public function selectCategoryById($id)
		{
			$sql= "select * from category where id= :id limit 1";
			$query= databaseClass::ourPrepareMethod($sql);
			$query->bindValue(':id', $id);
			$query->execute();
			
			$result= $query->fetch(PDO::FETCH_OBJ);
			return $result;
		}
		public function updateCategory($id, $data)
		{
			$name= $data['name'];
			
			if($name==""){

				$msg= "<div class='alert alert-danger'> <strong> Error!!! </strong> Field must not empty.</div>";
				return $msg;
			}
			if(preg_match('/[^A-Za-z0-9 ._-]+/i', $name)){

				$msg= "<div class='alert alert-danger'> <strong> Error!!! </strong> Name must only contain alphanumerical, dashes and underscore.</div>";
				return $msg;
			}

			$sql= "update category set name= :name where id= :id";
			$query= databaseClass::ourPrepareMethod($sql);
			$query->bindValue(':name', $name);
			$query->bindValue(':id', $id);
			
			if($query->execute())
			{
				$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>User data updated successfully </div>";
				return $msg;
			}
			else
			{
				$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, User data not updated !!!  </div>";
				return $msg;
			}
		}
		//delete portion
		public function deleteCategory($id){

			$delete= "delete from category where id=:id";
			$result= databaseClass::ourPrepareMethod($delete);

			$result->bindValue(':id', $id);
			if($result->execute())
			{
				$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>Category deleted successfully. </div>";
				return $msg;
			}
			else
			{
				$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, Category not deleted.  </div>";
				return $msg;
			}
		}
		//create new post
		public function addPost($data){

			$cat_id= $data['category'];
			$title= $data['title'];
			$body= $data['body'];

			/*Image work start*/
			$permitted= array('jpg', 'jpeg', 'png', 'gif');
			$image_file_name= $_FILES['image']['name'];
			$file_size= $_FILES['image']['size'];
			$file_temp_name= $_FILES['image']['tmp_name'];

			$divided= explode('.', $image_file_name);
			$file_extension= strtolower(end($divided));
			$unique_image= substr(md5(time()), 0, 10).'.'.$file_extension;
			$uploaded_image= "upload/".$unique_image;
			/*Image work start*/

			$author= $data['author'];
			$hidden_userid= $data['userid'];
			$tags= $data['tags'];

			if($title== "" || $body== "" || $image_file_name== "" || $author== "" || $tags== "")
			{
				$msg= "<div style='color:red;'> <strong> Error! </strong>Field must not be empty </div>";
				return $msg;
			}
			if(preg_match('/[^A-Za-z0-9 ._-]+/i', $title)){

				$msg= "<div style='color:red;''> <strong> Error!!! </strong> Category name must only contain alphanumerical, dashes and underscore.</div>";
				return $msg;
			}elseif (strlen($title)<3) {
					
				$msg= "<div style='color:red;''> <strong> Error!!! </strong> Title is too short (Upto 3 characters)</div>";
				return $msg;
			}

			if($file_size>1048567){
				$msg= "<div style='color:red;'> <strong> Error! </strong>Image size should be less than 1 MB. </div>";
				return $msg;
			}elseif (in_array($file_extension, $permitted) === false) {
				$msg= "<div style='color:red;'> <strong> Error! </strong>You can upload only: ".implode(', ', $permitted)."</div>";
				return $msg;
			}else{
				move_uploaded_file($file_temp_name, $uploaded_image);
			}

			$sql= "insert into post(category_id, title, body, image, author, tags, userid) values(:c, :t, :b, :i, :a, :tags, :uid)";
			$query= databaseClass::ourPrepareMethod($sql);

			$query->bindValue(':c', $cat_id);
			$query->bindValue(':t', $title);
			$query->bindValue(':b', $body);
			$query->bindValue(':i', $uploaded_image);
			$query->bindValue(':a', $author);
			$query->bindValue(':uid', $hidden_userid);
			$query->bindValue(':tags', $tags);
			
			if($query->execute())
			{
				$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>Thank You, you have been added a new post. </div>";
				return $msg;
			}
			else
			{
				$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, there has been problem to create your post.  </div>";
				return $msg;
			}
		}
		//show posts
		public function showPostList(){

			$sql="select post.*, category.name from post inner join category on post.category_id= category.id order by post.id";
			$result= databaseClass::ourPrepareMethod($sql);
			$result->execute();
			return $result->fetchAll();
		}

		//update post
		public function selectPostById($id)
		{
			$sql= "select * from post where id= :id limit 1";
			$query= databaseClass::ourPrepareMethod($sql);
			$query->bindValue(':id', $id);
			$query->execute();
			
			$result= $query->fetch(PDO::FETCH_OBJ);
			return $result;
		}
		public function updatePost($id, $data)
		{
			$cat_id= $data['category'];
			$title= $data['title'];
			$body= $data['body'];

			/*Image work start*/
			$permitted= array('jpg', 'jpeg', 'png', 'gif');
			$image_file_name= $_FILES['image']['name'];
			$file_size= $_FILES['image']['size'];
			$file_temp_name= $_FILES['image']['tmp_name'];

			$divided= explode('.', $image_file_name);
			$file_extension= strtolower(end($divided));
			$unique_image= substr(md5(time()), 0, 10).'.'.$file_extension;
			$uploaded_image= "upload/".$unique_image;
			/*Image work start*/

			$author= $data['author'];
			$hidden_userid= $data['userid'];
			$tags= $data['tags'];

			if($title== "" || $body== "" || $author== "" || $tags== "")
			{
				$msg= "<div style='color:red;'> <strong> Error! </strong>Field must not be empty </div>";
				return $msg;
			}else
			{
				if(preg_match('/[^A-Za-z0-9 ._-]+/i', $title)){

				$msg= "<div style='color:red;''> <strong> Error!!! </strong> Category name must only contain alphanumerical, dashes and underscore.</div>";
				return $msg;
				}elseif (strlen($title)<3) {
						
					$msg= "<div style='color:red;''> <strong> Error!!! </strong> Title is too short (Upto 3 characters)</div>";
					return $msg;
				}

				if(!empty($image_file_name))
				{
					if($file_size>1048567){
						$msg= "<div style='color:red;'> <strong> Error! </strong>Image size should be less than 1 MB. </div>";
						return $msg;
					}
					elseif (in_array($file_extension, $permitted) === false) {
						$msg= "<div style='color:red;'> <strong> Error! </strong>You can upload only: ".implode(', ', $permitted)."</div>";
						return $msg;
					}else{
						move_uploaded_file($file_temp_name, $uploaded_image);
					}

					$sql= "update post set category_id= :c_id, title= :t, body= :b, image= :i, author= :a, tags= :tags, userid= :uid where id= :id";
					$query= databaseClass::ourPrepareMethod($sql);
					$query->bindValue(':c_id', $cat_id);
					$query->bindValue(':t', $title);
					$query->bindValue(':b', $body);
					$query->bindValue(':i', $uploaded_image);
					$query->bindValue(':a', $author);
					$query->bindValue(':uid', $hidden_userid);
					$query->bindValue(':tags', $tags);
					$query->bindValue(':id', $id);
					
					if($query->execute())
					{
						$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>User post updated successfully </div>";
						return $msg;
					}
					else
					{
						$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, User post not updated !!!  </div>";
						return $msg;
					}
				}else
				{
					$sql= "update post set category_id= :c_id, title= :t, body= :b, author= :a, tags= :tags, userid= :uid where id= :id";
					$query= databaseClass::ourPrepareMethod($sql);
					$query->bindValue(':c_id', $cat_id);
					$query->bindValue(':t', $title);
					$query->bindValue(':b', $body);
					$query->bindValue(':a', $author);
					$query->bindValue(':uid', $hidden_userid);
					$query->bindValue(':tags', $tags);
					$query->bindValue(':id', $id);
					
					if($query->execute())
					{
						$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>User post updated successfully </div>";
						return $msg;
					}
					else
					{
						$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, User post not updated !!!  </div>";
						return $msg;
					}
				}
			}
			
		}
		//delete post
		public function deletePost($id){

			$delete= "delete from post where id=:id";
			$result= databaseClass::ourPrepareMethod($delete);

			$result->bindValue(':id', $id);
			if($result->execute())
			{
				$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>Post deleted successfully. </div>";
				return $msg;
			}
			else
			{
				$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, Post not deleted.  </div>";
				return $msg;
			}
		}
		//show title-slogan
		public function showTitleSlogan(){

			$sql="select * from title_slogan where id=1";
			$result= databaseClass::ourPrepareMethod($sql);
			$result->execute();
			return $result->fetchAll();
		}
		public function updateTitleSlogan($data)
		{
			$title= $data['title'];
			$slogan= $data['slogan'];

			/*Image work start*/
			$permitted= array('jpg', 'jpeg', 'png', 'gif');
			$image_file_name= $_FILES['logo']['name'];
			$file_size= $_FILES['logo']['size'];
			$file_temp_name= $_FILES['logo']['tmp_name'];

			$divided= explode('.', $image_file_name);
			$file_extension= strtolower(end($divided));
			$fixed= 'logo'.'.'.$file_extension;
			$uploaded_image= "upload/".$fixed;
			/*Image work start*/

			if($title== "" || $slogan== "")
			{
				$msg= "<div style='color:red;'> <strong> Error! </strong>Field must not be empty </div>";
				return $msg;
			}else
			{
				if(preg_match('/[^A-Za-z0-9 ._-]+/i', $title)){

				$msg= "<div style='color:red;''> <strong> Error!!! </strong> Category name must only contain alphanumerical, dashes and underscore.</div>";
				return $msg;
				}elseif (strlen($title)<3) {
						
					$msg= "<div style='color:red;''> <strong> Error!!! </strong> Title is too short (Upto 3 characters)</div>";
					return $msg;
				}

				if(!empty($image_file_name))
				{
					if($file_size>1048567){
						$msg= "<div style='color:red;'> <strong> Error! </strong>Image size should be less than 1 MB. </div>";
						return $msg;
					}
					elseif (in_array($file_extension, $permitted) === false) {
						$msg= "<div style='color:red;'> <strong> Error! </strong>You can upload only: ".implode(', ', $permitted)."</div>";
						return $msg;
					}else{
						move_uploaded_file($file_temp_name, $uploaded_image);
					}

					$sql= "update title_slogan set title= :t, slogan= :s, logo= :l where id= 1";
					$query= databaseClass::ourPrepareMethod($sql);
					$query->bindValue(':t', $title);
					$query->bindValue(':s', $slogan);
					$query->bindValue(':l', $uploaded_image);


					if($query->execute())
					{
						$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>Title-slogan updated successfully </div>";
						return $msg;
					}
					else
					{
						$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, Title-slogan not updated !!!  </div>";
						return $msg;
					}
				}else
				{
					$sql= "update title_slogan set title= :t, slogan= :s where id=1";
					$query= databaseClass::ourPrepareMethod($sql);
					$query->bindValue(':t', $title);
					$query->bindValue(':s', $slogan);

					
					if($query->execute())
					{
						$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>Title-slogan updated successfully </div>";
						return $msg;
					}
					else
					{
						$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, Title-slogan not updated !!!  </div>";
						return $msg;
					}
				}
			}
		}
		//show social link
		public function showSocial(){

			$sql="select * from social where id=1";
			$result= databaseClass::ourPrepareMethod($sql);
			$result->execute();
			return $result->fetchAll();
		}
		//update social link
		public function updateSocial($data)
		{
			$fb= $data['fb'];
			$wapp= $data['wapp'];
			$twitter= $data['twtr'];
			$email= $data['email'];
			
			if($fb== "" || $wapp== "" || $twitter== "" || $email== "")
			{
				$msg= "<div style='color:red;'> <strong> Error! </strong>Field must not be empty </div>";
				return $msg;
			}
			else
			{
				$sql= "update social set fb= :f, wapp= :w, twtr= :t, email= :e where id=1";
				$query= databaseClass::ourPrepareMethod($sql);
				$query->bindValue(':f', $fb);
				$query->bindValue(':w', $wapp);
				$query->bindValue(':t', $twitter);
				$query->bindValue(':e', $email);
				
				if($query->execute())
				{
					$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>Social portion updated successfully </div>";
					return $msg;
				}
				else
				{
					$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, Social portion not updated !!!  </div>";
					return $msg;
				}
			}	
		}
		//show footer copyright
		public function showFooterCopyright(){

			$sql="select * from footer where id=1";
			$result= databaseClass::ourPrepareMethod($sql);
			$result->execute();
			return $result->fetchAll();
		}
		//update footer copyright
		public function updateFooterCopyright($data)
		{
			$text= $data['copyright'];
			
			if($text== "")
			{
				$msg= "<div style='color:red;'> <strong> Error! </strong>Field must not be empty </div>";
				return $msg;
			}
			else
			{
				$sql= "update footer set text= :t where id=1";
				$query= databaseClass::ourPrepareMethod($sql);
				$query->bindValue(':t', $text);
				
				if($query->execute())
				{
					$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>Footer copyright updated successfully </div>";
					return $msg;
				}
				else
				{
					$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, Footer coppyright not updated !!!  </div>";
					return $msg;
				}
			}	
		}
		//create new page
		public function addPage($data){

			$name= $data['name'];
			$body= $data['body'];


			if($name== "" || $body== "")
			{
				$msg= "<div style='color:red;'> <strong> Error! </strong>Field must not be empty </div>";
				return $msg;
			}
			else
			{
				
			
				$sql= "insert into page(name, body) values(:n, :b)";
				$query= databaseClass::ourPrepareMethod($sql);
				$query->bindValue(':n', $name);
				$query->bindValue(':b', $body);
				
				if($query->execute())
				{
					$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>Thank You, you have been added a new page. </div>";
					return $msg;
				}
				else
				{
					$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, there has been problem to create your page.  </div>";
					return $msg;
				}
			}
		}
		//show pages
		public function showPages(){

			$sql="select * from page";
			$result= databaseClass::ourPrepareMethod($sql);
			$result->execute();
			return $result->fetchAll();
		}
		//update page
		public function selectPageById($id)
		{
			$sql= "select * from page where id= :id limit 1";
			$query= databaseClass::ourPrepareMethod($sql);
			$query->bindValue(':id', $id);
			$query->execute();
			
			$result= $query->fetch(PDO::FETCH_OBJ);
			return $result;
		}
		public function updatePage($id, $data)
		{
			$name= $data['name'];
			$body= $data['body'];

			if($name== "" || $body== "")
			{
				$msg= "<div style='color:red;'> <strong> Error! </strong>Field must not be empty </div>";
				return $msg;
			}
			else
			{				
			
				$sql= "update page set name= :n, body= :b where id= :id";
				$query= databaseClass::ourPrepareMethod($sql);
				$query->bindValue(':n', $name);
				$query->bindValue(':b', $body);
				$query->bindValue(':id', $id);

				if($query->execute())
				{
					$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>Your page updated successfully. </div>";
					return $msg;
				}
				else
				{
					$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, there has been problem to update your page.  </div>";
					return $msg;
				}
			}						
		}
		//delete page
		public function deletePage($id){

			$delete= "delete from page where id=:id";
			$result= databaseClass::ourPrepareMethod($delete);

			$result->bindValue(':id', $id);
			if($result->execute())
			{
				$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>Page deleted successfully. </div>";
				return $msg;
			}
			else
			{
				$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, Page not deleted.  </div>";
				return $msg;
			}
		}
		//show current tab name highlighted
		public function pageTitle(){

			$path= $_SERVER['SCRIPT_FILENAME'];
			$title= basename($path,'.php');
			if($title == 'index'){
				$title= 'Home';
			}elseif($title == 'feedback') {
				$title= 'FAQ';
			}elseif($title == 'post_category') {
				$title= 'Category';
			}
			else
			{
				$title= 'Author';
			}
			return $title;
		}
		//User feedback
		public function userFeedback($data)
		{
			$firstname= $data['firstname'];
			$lastname= $data['lastname'];
			$email= $data['email'];
			$body= $data['body'];
					
			if($firstname== "" OR $lastname== "" OR $email== "" OR $body== "")
			{
				$msg= "<div style='color:red;'> <strong> Error! </strong>Field must not be empty </div>";
				return $msg;
			}
			if(preg_match('/[^A-Za-z0-9 ._-]+/i', $firstname)){

			$msg= "<div style='color:red;'> <strong> Error!!! </strong> Firstname must only contain alphanumerical, dashes and underscore.</div>";
			return $msg;
			}elseif (preg_match('/[^A-Za-z0-9 ._-]+/i', $lastname)) {
					
				$msg= "<div style='color:red;'> <strong> Error!!! </strong> Lastname error!!! </strong> Firstname must only contain alphanumerical, dashes and underscore.</div>";
				return $msg;
			}
			if(filter_var($email, FILTER_VALIDATE_EMAIL)==false){

				$msg= "<div style='color:red;'> <strong> Error!!! </strong>The email address is not valid. Please put like name@gmail.com </div>";
				return $msg;
			}

			$sql= "insert into feedback(firstname, lastname, email, body) values(:f, :l, :e, :b)";
			$query= databaseClass::ourPrepareMethod($sql);
			$query->bindValue(':f', $firstname);
			$query->bindValue(':l', $lastname);
			$query->bindValue(':e', $email);
			$query->bindValue(':b', $body);
			
			if($query->execute())
			{
				$msg= "<div style='color:#00FFFF;'> <strong> Successfull! </strong> Thank You, your queries accepted by author.</div>";
				return $msg;
			}
			else
			{
				$msg= "<div style='color:red;'> <strong> Error! </strong> Sorry, there has been problem to send your queries. </div>";
				return $msg;
			}
		}
		//show feedbacks into the admin panel
		public function showFeedbackList(){

			$sql="select * from feedback where status='0' order by id";
			$result= databaseClass::ourPrepareMethod($sql);
			$result->execute();
			return $result->fetchAll();
		}
		//view feedbacks
		public function viewFeedbackById($id)
		{
			$sql= "select * from feedback where id= :id limit 1";
			$query= databaseClass::ourPrepareMethod($sql);
			$query->bindValue(':id', $id);
			$query->execute();
			
			$result= $query->fetch(PDO::FETCH_OBJ);
			return $result;
		}
		//reply feedbacks by sending email
		public function feedReply($id, $data)
		{
			$to= $data['toemail'];
			$from= $data['fromemail'];
			$subject= $data['subject'];
			$reply= $data['reply'];

			if($to== "" || $from== "" || $subject== "" || $reply== "")
			{
				$msg= "<div style='color:red;'> <strong> Error! </strong>Field must not be empty </div>";
				return $msg;
			}
			if(preg_match('/[^A-Za-z0-9 ._-]+/i', $subject)){

				$msg= "<div style='color:red;'> <strong> Error!!! </strong> Subject must only contain alphanumerical, dashes and underscore.</div>";
				return $msg;
			}
			if(filter_var($from, FILTER_VALIDATE_EMAIL)==false){

				$msg= "<div style='color:red;'> <strong> Error!!! </strong>The email address is not valid. Please put like name@gmail.com </div>";
				return $msg;
			}

			$send_email= mail($to, $subject, $reply, $from);

			if($send_email)
			{
				$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>E-mail sent successfully. </div>";
				return $msg;
			}
			else
			{
				$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, E-mail not send. </div>";
				return $msg;
			}							
		}
		//update feedback status
		public function updateSeenFeedStatus($id)
		{
			
			$sql= "update feedback set status='1' where id= :id";
			$query= databaseClass::ourPrepareMethod($sql);

			$query->bindValue(':id', $id);

			if($query->execute())
			{

				Session::init();
				Session::set("feed_msg", "<div style='color:green;'> <strong>Successfull! </strong>
				Feed moves into trash successfully. </div>");
				echo "<script> window.location= 'inbox.php'; </script>";
			}
			else
			{
				$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, there has been problem to update your Feed status. </div>";
				return $msg;
			}						
		}
		//show seen feedbacks to delete after status updation
		public function showSeenFeedbackList(){

			$sql="select * from feedback where status='1' order by id";
			$result= databaseClass::ourPrepareMethod($sql);
			$result->execute();
			return $result->fetchAll();
		}
		//delete seen feedbacks
		public function deleteSeenFeeds($id){

			$delete= "delete from feedback where id=:id";
			$result= databaseClass::ourPrepareMethod($delete);

			$result->bindValue(':id', $id);
			if($result->execute())
			{
				Session::init();
				Session::set("feed_dlt_msg", "<div style='color:green;'> <strong>Successfull! </strong> Seen feedback deleted successfully. </div>");
				echo "<script> window.location= 'inbox.php'; </script>";

			}
			else
			{
				$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, Seen feedback isn't not deleted.  </div>";
				return $msg;
			}
		}
		//show notification number count
		public function notificationSymbol(){

			$sql="select count(id) from feedback where status='0' order by id";
			$result= databaseClass::ourPrepareMethod($sql);
			$result->execute();

			$total_zero_status_rows= $result->fetchColumn();
			return $total_zero_status_rows;
		}
		//check existence of email
		public function emailCheck($email)
		{
			$sql= "select * from user where email= :email";
			$query= databaseClass::ourPrepareMethod($sql);
			$query->bindValue(':email', $email);
			$query->execute();
			if($query->rowCount()>0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		//add users
		public function addUser($data){
			$username= $data['username'];
			$email= $data['email'];
			$password= $data['password'];
			$role= $data['role'];

			if($username== "" || $email== "" || $password== "" || $role== "")
			{
				$msg= "<div style='color:red;'> <strong> Error! </strong>Field must not be empty </div>";
				return $msg;
			}
			if(preg_match('/[^A-Za-z0-9 ._-]+/i', $username)){

				$msg= "<div style='color:red;''> <strong> Error!!! </strong> Username must only contain alphanumerical, dashes and underscore.</div>";
				return $msg;
			}
			if(filter_var($email, FILTER_VALIDATE_EMAIL)==false){

				$msg= "<div style='color:red;'> <strong> Error!!! </strong>The email address is not valid. Please put like name@gmail.com </div>";
				return $msg;		
			}
			$email_chk= $this->emailCheck($email);

			if($email_chk==true){

				$msg= "<div class='alert alert-danger'> <strong> Error!!! </strong> The email address already exist </div>";
				return $msg;
			}

			$password= md5($data['password']);

			$sql= "insert into user(username, email, password, role) values(:n, :e, :p, :r)";
			$query= databaseClass::ourPrepareMethod($sql);
			$query->bindValue(':n', $username);
			$query->bindValue(':e', $email);
			$query->bindValue(':p', $password);
			$query->bindValue(':r', $role);

			if($query->execute())
			{
				$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>Thank You, you have been added a new user. </div>";
				return $msg;
			}
			else
			{
				$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, there has been problem to insert your user.  </div>";
				return $msg;
			}
		}
		//recovery password by sending email
		public function passwordRecover($data){
			$email= $data['email'];

			if($email == ""){
				$msg= "<div style='color:red;'> <strong> Error! </strong>Field must not be empty </div>";
				return $msg;
			}
			if(filter_var($email, FILTER_VALIDATE_EMAIL)==false){

				$msg= "<div style='color:red;'> <strong> Error!!! </strong>The email address is not valid. Please put like name@gmail.com </div>";
				return $msg;		
			}
			$email_chk= $this->emailCheck($email);

			if($email_chk==true)
			{
				if($email_chk){
					foreach ((array)$email_chk as $key => $value) {
						$id= $value['id'];
						$username= $value['username'];
					}
				}

				$new_generate= substr($email, 0, 3);
				$random= rand(10000, 99999);
				$combine= "$new_generate$random";
				$new_pass= md5($combine);

				$sql= "update user set password= :p where id= :id";
				$query= databaseClass::ourPrepareMethod($sql);

				$query->bindValue(':p', $new_pass);
				$query->bindValue(':id', $id);
				$query->execute();

				$to= "$email";
				$from= "pro.cse4.bu@gmail.com";

				$headers= "From: $from\n";
				$headers.= "MIME-Version: 1.0"."\r\n";
				$headers.= "Content-type: text/html; charset=iso-8859-1"."\r\n";

				$subject= "Your New Password";

				$message= "Your username is".$username." and Password is ".$combine.". Please visit our website to login";

				$send_email= mail($to, $subject, $message, $headers);

				if($send_email)
				{
					$msg= "<div style='color: green'> <strong> Successfull! </strong>Please check your email for getting new password.</div>";
					return $msg;
				}
				else
				{
					$msg= "<div style='color: red'> <strong> Error! </strong>Sorry, User password not recovered !!!  </div>";
					return $msg;
				}							
			}
			else
			{
				$msg= "<div style='color: red'> <strong> Error!!! </strong> The email address doesn't exist. </div>";
				return $msg;
			}
		}
		//select users into profile
		public function selectUserByIdAndRole($id, $role)
		{
			$sql= "select * from user where id= :id and role=:r limit 1";
			$query= databaseClass::ourPrepareMethod($sql);
			$query->bindValue(':id', $id);
			$query->bindValue(':r', $role);
			$query->execute();
			
			$result= $query->fetch(PDO::FETCH_OBJ);
			return $result;
		}
		//update user profile
		public function updateUserProfile($id, $data)
		{
			$name= $data['name'];
			$username= $data['username'];
			$email= $data['email'];
			$details= $data['details'];

			if($name== "" || $username== "" || $email== "" || $details== "")
			{
				$msg= "<div style='color:red;'> <strong> Error! </strong>Field must not be empty </div>";
				return $msg;
			}
			if(preg_match('/[^A-Za-z0-9 ._-]+/i', $name)){

				$msg= "<div style='color:red;''> <strong> Error!!! </strong> Name must only contain alphanumerical, dashes and underscore.</div>";
				return $msg;
			}
			if(preg_match('/[^A-Za-z0-9 ._-]+/i', $username)){

				$msg= "<div style='color:red;''> <strong> Error!!! </strong> User name must only contain alphanumerical, dashes and underscore.</div>";
				return $msg;
			}elseif (strlen($username)<3) {
					
				$msg= "<div style='color:red;''> <strong> Error!!! </strong> Username is too short (Upto 3 characters)</div>";
				return $msg;
			}
			if(filter_var($email, FILTER_VALIDATE_EMAIL)==false){

				$msg= "<div style='color:red;'> <strong> Error!!! </strong>The email address is not valid. Please put like name@gmail.com </div>";
				return $msg;		
			}

			$sql= "update user set name= :n, username= :u, email= :e, details= :details where id= :id";
			$query= databaseClass::ourPrepareMethod($sql);

			$query->bindValue(':n', $name);
			$query->bindValue(':u', $username);
			$query->bindValue(':e', $email);
			$query->bindValue(':details', $details);
			$query->bindValue(':id', $id);
			
			if($query->execute())
			{
				$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>User profile updated successfully </div>";
				return $msg;
			}
			else
			{
				$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, User profile not updated !!!  </div>";
				return $msg;
			}			
		}
		//show users list
		public function showUserList(){

			$sql="select * from user order by id";
			$result= databaseClass::ourPrepareMethod($sql);
			$result->execute();
			return $result->fetchAll();
		}
		//delete page
		public function deleteUser($id){

			$delete= "delete from user where id=:id";
			$result= databaseClass::ourPrepareMethod($delete);

			$result->bindValue(':id', $id);
			if($result->execute())
			{
				$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>User deleted successfully. </div>";
				return $msg;
			}
			else
			{
				$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, User not deleted.  </div>";
				return $msg;
			}
		}
		//view users
		public function viewUserById($id)
		{
			$sql= "select * from user where id= :id limit 1";
			$query= databaseClass::ourPrepareMethod($sql);
			$query->bindValue(':id', $id);
			$query->execute();
			
			$result= $query->fetch(PDO::FETCH_OBJ);
			return $result;
		}
		//create new slide image
		public function addSlide($data){

			$title= $data['title'];

			/*Image work start*/
			$permitted= array('jpg', 'jpeg', 'png', 'gif');
			$image_file_name= $_FILES['image']['name'];
			$file_size= $_FILES['image']['size'];
			$file_temp_name= $_FILES['image']['tmp_name'];

			$divided= explode('.', $image_file_name);
			$file_extension= strtolower(end($divided));
			$unique_image= substr(md5(time()), 0, 10).'.'.$file_extension;
			$uploaded_image= "upload/slider/".$unique_image;
			/*Image work start*/

			if($title== "" ||  $image_file_name== "")
			{
				$msg= "<div style='color:red;'> <strong> Error! </strong>Field must not be empty </div>";
				return $msg;
			}
			if(preg_match('/[^A-Za-z0-9 ._-]+/i', $title)){

				$msg= "<div style='color:red;''> <strong> Error!!! </strong> Category name must only contain alphanumerical, dashes and underscore.</div>";
				return $msg;
			}elseif (strlen($title)<3) {
					
				$msg= "<div style='color:red;''> <strong> Error!!! </strong> Title is too short (Upto 3 characters)</div>";
				return $msg;
			}

			if($file_size>1048567){
				$msg= "<div style='color:red;'> <strong> Error! </strong>Image size should be less than 1 MB. </div>";
				return $msg;
			}elseif (in_array($file_extension, $permitted) === false) {
				$msg= "<div style='color:red;'> <strong> Error! </strong>You can upload only: ".implode(', ', $permitted)."</div>";
				return $msg;
			}else{
				move_uploaded_file($file_temp_name, $uploaded_image);
			}

			$sql= "insert into slider(title, image) values(:t, :i)";
			$query= databaseClass::ourPrepareMethod($sql);

			$query->bindValue(':t', $title);
			$query->bindValue(':i', $uploaded_image);			
			if($query->execute())
			{
				$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>Thank You, you have been added a new slider. </div>";
				return $msg;
			}
			else
			{
				$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, there has been problem to create your slider.  </div>";
				return $msg;
			}
		}
		//show sliders
		public function showSlideList(){

			$sql="select * from slider order by id limit 5";
			$result= databaseClass::ourPrepareMethod($sql);
			$result->execute();
			return $result->fetchAll();
		}
		//update post
		public function selectTheSlideById($id)
		{
			$sql= "select * from slider where id= :id limit 1";
			$query= databaseClass::ourPrepareMethod($sql);
			$query->bindValue(':id', $id);
			$query->execute();
			
			$result= $query->fetch(PDO::FETCH_OBJ);
			return $result;
		}
		public function updateTheSlide($id, $data)
		{
			$title= $data['title'];

			/*Image work start*/
			$permitted= array('jpg', 'jpeg', 'png', 'gif');
			$image_file_name= $_FILES['image']['name'];
			$file_size= $_FILES['image']['size'];
			$file_temp_name= $_FILES['image']['tmp_name'];

			$divided= explode('.', $image_file_name);
			$file_extension= strtolower(end($divided));
			$unique_image= substr(md5(time()), 0, 10).'.'.$file_extension;
			$uploaded_image= "upload/slider/".$unique_image;
			/*Image work start*/

			if($title== "")
			{
				$msg= "<div style='color:red;'> <strong> Error! </strong>Field must not be empty </div>";
				return $msg;
			}else
			{
				if(preg_match('/[^A-Za-z0-9 ._-]+/i', $title)){

				$msg= "<div style='color:red;''> <strong> Error!!! </strong> Category name must only contain alphanumerical, dashes and underscore.</div>";
				return $msg;
				}elseif (strlen($title)<3) {
						
					$msg= "<div style='color:red;''> <strong> Error!!! </strong> Title is too short (Upto 3 characters)</div>";
					return $msg;
				}

				if(!empty($image_file_name))
				{
					if($file_size>1048567){
						$msg= "<div style='color:red;'> <strong> Error! </strong>Image size should be less than 1 MB. </div>";
						return $msg;
					}
					elseif (in_array($file_extension, $permitted) === false) {
						$msg= "<div style='color:red;'> <strong> Error! </strong>You can upload only: ".implode(', ', $permitted)."</div>";
						return $msg;
					}else{
						move_uploaded_file($file_temp_name, $uploaded_image);
					}

					$sql= "update slider set title= :t, image= :i where id= :id";
					$query= databaseClass::ourPrepareMethod($sql);
					$query->bindValue(':t', $title);
					$query->bindValue(':i', $uploaded_image);					
					$query->bindValue(':id', $id);
					
					if($query->execute())
					{
						$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>The slide updated successfully </div>";
						return $msg;
					}
					else
					{
						$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, the slide is not updated !!!  </div>";
						return $msg;
					}
				}else
				{
					$sql= "update slider set title= :t where id= :id";
					$query= databaseClass::ourPrepareMethod($sql);
					$query->bindValue(':t', $title);
					$query->bindValue(':id', $id);
					
					if($query->execute())
					{
						$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>The slide updated successfully </div>";
						return $msg;
					}
					else
					{
						$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, The slide is not updated !!!  </div>";
						return $msg;
					}
				}
			}
			
		}
		//delete slide
		public function deleteSlide($id){

			$delete= "delete from slider where id=:id";
			$result= databaseClass::ourPrepareMethod($delete);

			$result->bindValue(':id', $id);
			if($result->execute())
			{
				$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>The slide deleted successfully. </div>";
				return $msg;
			}
			else
			{
				$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, The slide is not deleted.  </div>";
				return $msg;
			}
		}
		//show users list
		public function showFrontendUserList(){

			$sql="select * from front_user order by id";
			$result= databaseClass::ourPrepareMethod($sql);
			$result->execute();
			return $result->fetchAll();
		}
		//delete page
		public function deleteFrontendUser($id){

			$delete= "delete from front_user where id=:id";
			$result= databaseClass::ourPrepareMethod($delete);

			$result->bindValue(':id', $id);
			if($result->execute())
			{
				$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>Frontend User deleted successfully. </div>";
				return $msg;
			}
			else
			{
				$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, Frontend User not deleted.  </div>";
				return $msg;
			}
		}

		public function checkPassword($id, $old_pass)
		{
			$password= md5($old_pass);
			$sql= "select password from user where id= :id  and  password= :password";
			$query= databaseClass::ourPrepareMethod($sql);
			$query->bindValue(':id', $id);
			$query->bindValue(':password', $password);
			$query->execute();
			if($query->rowCount()>0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		public function updatePassword($id, $data)
		{
			$old_pass= $data['old_pass'];
			$new_pass= $data['new_pass'];

			if($old_pass== "" OR $new_pass== "")
			{
				$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Field must not be empty!!! </div>";
				return $msg;
			}
			$chk_pass= $this->checkPassword($id, $old_pass);
			
			if($chk_pass== false)
			{
				$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Old password not exist!!! </div>";
				return $msg;
			}
			if(strlen($new_pass)<5)
			{
				$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Password length is too short. You have put at least 6 values </div>";
				return $msg;
			}

			$password=md5($new_pass);

			$sql= "update user set password= :password where id= :id";
			$query= databaseClass::ourPrepareMethod($sql);
			$query->bindValue(':password', $password);		
			$query->bindValue(':id', $id);
			
			if($query->execute())
			{
				$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>Password updated successfully </div>";
				return $msg;
			}
			else
			{
				$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, Password not updated !!!  </div>";
				return $msg;
			}
		}
	}
?>