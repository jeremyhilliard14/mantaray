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
		$post_id = $decoded_json['idOfPost'];
		$vote_direction = $decoded_json['voteDirection'];

		$did_vote = DB::query("SELECT * FROM votes WHERE username = %s AND pid = %i", $_SESSION['username'], $post_id);

		if(DB::count() != 0){
			//we found a record.  this person has arlready voted on this post.
			//if they upvoted and have already upvoted
			if(($vote_direction == 1) && ($did_vote[0]['vote_direction'] == 1)){
				print 'Already Voted';
				exit;
				//if they downvoted and have aready downvoted
			}else if(($vote_direction == -1) && ($did_vote[0]['vote_direction'] == -1)){
				print 'Already Voted';
				exit;
			}else{
				DB::update('votes', array(
					'vote_direction' => ($vote_direction)
				 	), 'username=%s', 'pid=%i', $_SESSION['username'], $post_id);
				print 'Already Voted';
				exit;
			}
		}else{
			DB::insert('votes', array(
				'username' => $_SESSION['username'],
				'vote_direction' => $vote_direction,
				'pid' => $post_id
			));
		}

		$total_votes = DB::query("SELECT SUM(vote_direction) AS voteTotal FROM votes WHERE pid =".$post_id);

		$total_votes['voteTotal'];

		print json_encode(intval($total_votes[0]['voteTotal']));

	}





?>