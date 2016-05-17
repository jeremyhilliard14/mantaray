<?php

	require_once 'meekrodb.2.3.class.php';
	DB::$user = 'x';
	DB::$password = 'x';
	DB::$dbName = 'mantaray';
	DB::$host = '127.0.0.1';
	DB::$error_handler = false; // since we're catching errors, don't need error handler
	DB::$throw_exception_on_error = true;

	//check to see if the username is already in the database
	$result = DB::query("SELECT * FROM users WHERE username = %s", $_POST['username']);
	if(!$result){
		$can_register = true;
	}else{
		$can_register = false;
	}

	
	if($can_register && ($_POST['password'] == $_POST['password2'])){
			//they can register.  Passwords are equal and username is not taken.
		
		$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

		try{
			DB::insert('users', array(
				'username' => $_POST['username'],
				'password' => $hashed_password,
				'email' => $_POST['email'],
				'realName' => $_POST['realName']
			));
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['email'] = $_POST['email'];
			header('Location: index.php?welcome=yes');
			exit;
		}catch(MeekroDBException $e){
			header('Location: /register.php?');
			exit;
		};

	}else{
		header('Loaction: /register.php?error=usernameexits');
	}

?>