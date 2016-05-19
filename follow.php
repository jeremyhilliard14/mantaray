<?php	

	require_once 'includes/head.php';
	require_once 'includes/header.php';

	session_start();
	require_once 'includes/meekrodb.2.3.class.php';
	DB::$user = 'x';
	DB::$password = 'x';
	DB::$dbName = 'mantaray';
	DB::$host = '127.0.0.1';

	$following_array = DB::query("SELECT poster FROM following WHERE follower = %s", 
		$_SESSION['username']);

	$not_following_array = DB::query("SELECT * FROM users 
		WHERE username != %s AND username NOT IN ($following_array)", $_SESSION['username']);

	print "<pre>";
	print_r($all_users_array);
	print "</pre>";
	exit;

?>

<div class="container" ng-app="mantaApp">
	<div class="row" ng-controller="mantaController">
		<div class="col-sm-8 col-sm-offset-2">

			<?php foreach($not_following_array as $user): ?>
				<div class="col-sm-8 username text-center"> <?php print $user['username']; ?></div>
				<div class="col-sm-4 follow"><button class="btn btn-primary" ng-click="follow('<?php print $user['username']; ?>')">Follow</button></div>
			<?php endforeach; ?>

		</div>
	</div>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">

			<?php foreach($following_array as $user): ?>
				<div class="col-sm-8 username"> <?php print $user['username']; ?></div>
				<div class="col-sm-4 follow"><button class="btn btn-primary" ng-click="follow('<?php print $user['username']; ?>')">Follow</button></div>
			<?php endforeach; ?>

		</div>
	</div>

</div>