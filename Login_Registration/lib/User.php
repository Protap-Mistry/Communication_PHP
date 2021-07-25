<?php 
include_once 'Session.php';
include 'Database.php';
class User
{
	private $db;
	private $table= "front_user";

	public function __construct()
	{
		$this->db= new dbConnection();
	}
	//show title-slogan
	public function showTitleSlogan(){

		$sql="select * from title_slogan where id=1";
		$result= dbConnection::myPrepareMethod($sql);
		$result->execute();
		return $result->fetchAll();
	}

	public function userRegistration($data)
	{
		$name= $data['name'];
		$username= $data['username'];
		$email= $data['email'];
		$password= $data['password'];

		if($name=="" || $username=="" || $email=="" || $password==""){

			$msg= "<div class='alert alert-danger'> <strong> Error!!! </strong> Field must not empty.</div>";
			return $msg;
		}
		if(preg_match('/[^A-Za-z0-9 ._-]+/i', $name)){

			$msg= "<div class='alert alert-danger'> <strong> Error!!! </strong> Name must only contain alphanumerical, dashes and underscore.</div>";
			return $msg;
		}
		if(preg_match('/[^A-Za-z0-9 ._-]+/i', $username)){

			$msg= "<div class='alert alert-danger'> <strong> Error!!! </strong> Username must only contain alphanumerical, dashes and underscore.</div>";
			return $msg;
		}elseif (strlen($username)<3) {
				
			$msg= "<div class='alert alert-danger'> <strong> Error!!! </strong> Username is too short </div>";
			return $msg;
		}
		if(filter_var($email, FILTER_VALIDATE_EMAIL)==false){

			$msg= "<div class='alert alert-danger'> <strong> Error!!! </strong>The email address is not valid. Please put like name@gmail.com </div>";
			return $msg;
		}
		$email_chk= $this->emailCheck($email);

		if($email_chk==true){

			$msg= "<div class='alert alert-danger'> <strong> Error!!! </strong> The email address already exist </div>";
			return $msg;
		}
		if(strlen($password)<6){
			$msg= "<div class='alert alert-danger'> <strong> Error!!! </strong> Password is too short. It must be greater than 5 values </div>";
			return $msg;
		}

		$password= md5($data['password']);
		
		$sql= "insert into $this->table(name, username, email, password) values(:name, :username, :email, :password)";
		$query= dbConnection::myPrepareMethod($sql);
		$query->bindValue(':name', $name);
		$query->bindValue(':username', $username);
		$query->bindValue(':email', $email);
		$query->bindValue(':password', $password);
		
		if($query->execute())
		{
			$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>
			Thank You, you have been registered </div>";
			return $msg;
		}
		else
		{
			$msg= "<div class='alert alert-danger'> <strong> Error! </strong>
			Sorry, there has been problem to insert your details  </div>";
			return $msg;
		}
	}

	public function emailCheck($email)
	{
		$sql= "select * from $this->table where email= :email";
		$query= dbConnection::myPrepareMethod($sql);
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
	public function getLoginUser($email, $password)
	{
		$sql= "select * from $this->table where email= :email and password= :password limit 1";
		$query= dbConnection::myPrepareMethod($sql);
		$query->bindValue(':email', $email);
		$query->bindValue(':password', $password);
		$query->execute();
		
		return $query->fetch(PDO::FETCH_OBJ);
		
	}
	public function userLogin($data)
	{
		$email= $data['email'];
		$password= ($data['password']);
				
		if($email== "" OR $password== "")
		{
			$msg= "<div class='alert alert-danger'> <strong> Error! </strong>
			Field must not be empty </div>";
			return $msg;
		}
		if(filter_var($email, FILTER_VALIDATE_EMAIL)== false)
		{
		
			$msg= "<div class='alert alert-danger'> <strong> Error! </strong>
			The email address is not valid. Please put like name@gmail.com </div>";
			return $msg;
	
		}
		$chk_email= $this->emailCheck($email);

		if($chk_email== false)
		{
			$msg= "<div class='alert alert-danger'> <strong> Error! </strong>
			The email address is not matching </div>";
			return $msg;
		}
		if(strlen($password)<6)
		{
			$msg= "<div class='alert alert-danger'> <strong> Error! </strong>
			Password is too short. It must be greater than 5 values </div>";
			return $msg;
		}
		$password= md5($data['password']);

		$result= $this->getLoginUser($email, $password);

		if($result)
		{
			Session::init();
			Session::set("login", true);
			Session::set("id", $result->id);
			Session::set("name", $result->name);
			Session::set("username", $result->username);
			Session::set("loginmsg", "<div class='alert alert-success'> <strong>Successfull! </strong>
			You are logged in... </div>");
			header("Location: index.php");
		}
		else
		{
			$msg= "<div class='alert alert-danger'> <strong> Error! </strong>
			Data not found ! </div>";
			return $msg;
		}
	}
	public function getUserData()
	{
		$sql= "select * from $this->table order by id desc";
		$query= dbConnection::myPrepareMethod($sql);		
		$query->execute();
		
		$result= $query->fetchAll();
		return $result;
	}
	public function getUserById($id)
	{
		$sql= "select * from $this->table where id= :id limit 1";
		$query= dbConnection::myPrepareMethod($sql);
		$query->bindValue(':id', $id);
		$query->execute();
		
		$result= $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}
	public function updateUserData($id, $data)
	{
		$name= $data['name'];
		$username= $data['username'];
		$email= $data['email'];
		
		if($name=="" || $username=="" || $email==""){

			$msg= "<div class='alert alert-danger'> <strong> Error!!! </strong> Field must not empty.</div>";
			return $msg;
		}
		if(preg_match('/[^A-Za-z0-9 ._-]+/i', $name)){

			$msg= "<div class='alert alert-danger'> <strong> Error!!! </strong> Name must only contain alphanumerical, dashes and underscore.</div>";
			return $msg;
		}
		if(preg_match('/[^A-Za-z0-9 ._-]+/i', $username)){

			$msg= "<div class='alert alert-danger'> <strong> Error!!! </strong> Username must only contain alphanumerical, dashes and underscore.</div>";
			return $msg;
		}elseif (strlen($username)<3) {
				
			$msg= "<div class='alert alert-danger'> <strong> Error!!! </strong> Username is too short </div>";
			return $msg;
		}
		if(filter_var($email, FILTER_VALIDATE_EMAIL)==false){

			$msg= "<div class='alert alert-danger'> <strong> Error!!! </strong>The email address is not valid. Please put like name@gmail.com </div>";
			return $msg;
		}

		$sql= "update $this->table set name= :name, username= :username, email= :email where id= :id";
		$query= dbConnection::myPrepareMethod($sql);
		$query->bindValue(':name', $name);
		$query->bindValue(':username', $username);
		$query->bindValue(':email', $email);
		$query->bindValue(':id', $id);
		
		if($query->execute())
		{
			$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>
			User data updated successfully </div>";
			return $msg;
		}
		else
		{
			$msg= "<div class='alert alert-danger'> <strong> Error! </strong>
			Sorry, User data not updated !!!  </div>";
			return $msg;
		}
	}
	public function checkPassword($id, $old_pass)
	{
		$password= md5($old_pass);
		$sql= "select password from $this->table where id= :id  and  password= :password";
		$query= dbConnection::myPrepareMethod($sql);
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
		$new_pass= $data['password'];

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
		if(strlen($new_pass)<=5)
		{
			$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Password length is too short. You have put at least 6 values </div>";
			return $msg;
		}

		$password=md5($new_pass);

		$sql= "update $this->table set password= :password where id= :id";
		$query= dbConnection::myPrepareMethod($sql);
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
	//recovery password by sending email
	public function passwordRecover($data){
		$email= $data['email'];

		if($email == ""){
			$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Field must not be empty </div>";
			return $msg;
		}
		if(filter_var($email, FILTER_VALIDATE_EMAIL)==false){

			$msg= "<div class='alert alert-danger'> <strong> Error!!! </strong>The email address is not valid. Please put like name@gmail.com </div>";
			return $msg;		
		}
		$email_chk= $this->emailCheck($email);

		if($email_chk==true)
		{
			

			$new_generate= substr($email, 0, 3);
			$random= rand(10000, 99999);
			$combine= "$new_generate$random";
			$new_pass= md5($combine);

			$sql= "update front_user set password= :p where email= :email";
			$query= dbConnection::myPrepareMethod($sql);

			$query->bindValue(':p', $new_pass);
			$query->bindValue(':email', $email);
			$query->execute();

			$to= "$email";
			$from= "pro.cse4.bu@gmail.com";

			$headers= "From: $from\n";
			$headers.= "MIME-Version: 1.0"."\r\n";
			$headers.= "Content-type: text/html; charset=iso-8859-1"."\r\n";

			$subject= "Your New Password";

			$message= "Your new password is ".$combine.". Please visit our website to login";

			$send_email= mail($to, $subject, $message, $headers);

			if($send_email)
			{
				$msg= "<div class='alert alert-success'> <strong> Successfull! </strong>Please check your email for getting new password.</div>";
				return $msg;
			}
			else
			{
				$msg= "<div class='alert alert-danger'> <strong> Error! </strong>Sorry, User password not recovered !!!  </div>";
				return $msg;
			}							
		}
		else
		{
			$msg= "<div class='alert alert-danger'> <strong> Error!!! </strong> The email address doesn't exist. </div>";
			return $msg;
		}
	}
}
?>