<?php 


	session_start();
	require_once 'includes/meekrodb.2.3.class.php';
	DB::$user = 'x';
	DB::$password = 'x';
	DB::$dbName = 'mantaray';
	DB::$host = '127.0.0.1';