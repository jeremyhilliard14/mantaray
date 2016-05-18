<?php
session_start();
session_destroy();
require_once 'includes/head.php';
require_once 'includes/header.php';
	print '<div class="col-sm-12 text-center">
				<h2 id="thanks">Thank you for your support of the Manta Ray!</h2>
			</div>';
require_once 'includes/footer.php';


?>