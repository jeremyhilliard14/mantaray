<?php

	
	// print '{
	// 	idIGot:' .$_POST['idOfPost'].',
	// 	voteDirectionYouSent: '.$_POST['voteDirection'].'
	// }';
	session_start();
	require_once 'includes/meekrodb.2.3.class.php';


	if(!isset($_SESSION['username'])){
		print ('notLoggedIn');
	}else{


		DB::$user = 'x';
		DB::$password = 'x';
		DB::$dbName = 'mantaray';
		DB::$host = '127.0.0.1';


		$json_received = file_get_contents('php://input');
		$decoded_json = json_decode($json_received, true);
		$poster_username = $decoded_json['username'];
		
		
		
		DB::insert('following', array(
			'follower' => $_SESSION['username'],
			'poster' => $poster_username
		));
		

		
		print 'success';

	}





?>