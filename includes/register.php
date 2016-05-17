<?php

	require_once 'head.php';
	require_once 'header.php';

?>


<body>

<div class="row">
	<div id="register-form" class="col-sm-6 col-sm-offset-3" style="margin-top: 40px; background-color: #c4c4c4;">
		<form class="form" action="register_process.php" method="post">
			<div class="form-group text-center">
			    <label for="exampleInputName2">Real Name</label>
			    <input type="text" class="form-control" id="realName" placeholder="Jane Doe" name="realName">
		  	</div>
		  	<div class="form-group text-center">
			    <label for="exampleInputName2">Username</label>
			    <input type="text" class="form-control" id="username" placeholder="Jane Doe" name="username">
		  	</div>
		  	<div class="form-group text-center">
			    <label for="exampleInputName2">Email Address</label>
			    <input type="email" class="form-control" id="email" placeholder="jane.doe@example.com" name="email">
		  	</div>
		  	<div class="form-group text-center">
			    <label for="exampleInputEmail2">Password</label>
			    <input type="password" class="form-control" id="password" placeholder="password" name="password">
		  	</div>
		  	<div class="form-group text-center">
			    <label for="exampleInputEmail2">Confirm Password</label>
			    <input type="password" class="form-control" id="password2" placeholder="password" name="password2">
		  	</div>
		  	<div class="form-group text-center">
		  		<button type="submit" class="btn btn-primary text-center">Submit</button>
		  	</div>
		</form>
	</div>
</div>

</body>