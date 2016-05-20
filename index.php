<?php

	require_once 'includes/head.php';
	require_once 'includes/header.php';
	// require_once 'includes/register.php';

	$posts = DB::query("SELECT posts.*, COALESCE(SUM(votes.vote_direction), 0) as aggregateVotes
		FROM posts
		LEFT JOIN votes ON posts.id = votes.pid 
		GROUP BY posts.id ORDER BY timestamp DESC; ");

	// print "<pre>";
	// print_r($posts);
	// print "</pre>";
	// exit;

?>

<body ng-app="mantaApp">

<div class="container">
	<!-- <div class="row">
		<div id="header" class="col-sm-12">
			<div id="header-left" class="col-sm-6">
				<a href="local-mantaray.com"><button class="btn btn-primary">Home</button></a>
			</div>
			<div id="header-right" class="col-sm-6">
				
				<a href="register.php"><button class="btn btn-warning">Register</button></a>
				<a href="login.php" id="login">Login</a>
			</div>
		</div>
	</div> -->

	<div class="row">
		<div id="main-photo" class="col-sm-12 text-center">
			<h1>Save the Manta Rays!</h1>
		</div>
	</div>

	<div class="row">
		<div id="mission" class="col-sm-8 col-sm-offset-2">
			<h1>Our Mission</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			
		</div>
	</div>
	<div class="row">
		<div id="post" class="col-sm-8 col-sm-offset-2">
			<h1>Make a Post</h1>
			<?php if($_SESSION['username']): ?>
				<div id="post-form" class="col-sm-12" style="margin-top: 40px;">
					<form action="post_process.php" method="post">
					  	<div class="form-group">
						    <label for="post-text">Your Manta Ray Post</label>
						    <textarea id="post-text" name="post_text" style="width: 100%;min-height: 100px;"></textarea>
					  	</div>
					  	<div class="form-group">
					  		<button type="submit" class="btn btn-primary text-center">Post</button>
					  	</div>
					</form>

					<?php else: ?>
						<h3>Please log in or register to post</h3>
					<?php endif; ?>
				</div>
		</div>
	</div>
	<div class="row" ng-controller="mantaController">
		<div id="recent-posts" class="col-sm-8 col-sm-offset-2">
			<h1>Recent Posts</h1>
			<a href='follow.php'>Follow a User</a>
				<?php foreach ($posts as $post): ?> 

					<?php
						date_default_timezone_set('America/New_York');
						$timestamp_as_unix = strtotime($post['timestamp']);
					
						$formatted_date = date('D F j, Y, H:i', $timestamp_as_unix);
						?>

					<div class="posts">
						<div class="left-container">
							<div class="user"><?php print $post['username']; ?></div>
							<div class="text"><?php print $post['postText']; ?></div>
							<div class="date"><?php print $formatted_date; ?></div>
						</div>

						<div class="right-container" id="<?php print $post['id']; ?>">
							<div class="message"></div>
							<div class="arrow-up" ng-click="upVote($event, 1)">Upvote</div>
							<div class="vote-count"><?php print $post['aggregateVotes']; ?></div>
							<div class="arrow-down" ng-click="downVote($event, -1)">Downvote</div>
						</div>
					</div>
				<?php endforeach; ?>	
				
		</div> 
	</div>
</div>
</body>
</html>
