<?php

	
	// print '{
	// 	idIGot:' .$_POST['idOfPost'].',
	// 	voteDirectionYouSent: '.$_POST['voteDirection'].'
	// }';
	session_start();
	require_once 'includes/meekrodb.2.3.class.php';
	DB::$user = 'x';
	DB::$password = 'x';
	DB::$dbName = 'mantaray';
	DB::$host = '127.0.0.1';

	if(!isset($_SESSION['username'])){
		print "notLoggedIn";
		exit;
	}else{
		$json_received = file_get_contents('php://input');
		$decoded_json = json_decode($json_received, true);
		$poster_username = $decoded_json['poster'];
		$followMethod = $decoded_json['followMethod'];
		if($followMethod == 'follow'){
			DB::insert('following', 
				array(
					'follower' => $_SESSION['username'],
					'poster' => $poster_username
				)
			);
			print 'following';
			exit;
		}else if($followMethod == 'unfollow'){
			DB::delete('following', "follower=%s AND poster=%s", $_SESSION['username'], $poster_username);
			print 'unfollowing';
			exit;
		}
	}
	print 'Nothing Happened';

?>