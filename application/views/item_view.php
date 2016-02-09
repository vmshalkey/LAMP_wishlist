<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="/assets/styles.css">
	<meta charset="utf-8">
	<title><?= $item['name'] ?></title>
</head>
<body>
	<a href="/profile"><p>Home</p></a>
	<a href="/logins/logout_user"><p>Logout</p></a>
	<div id="wrapper">
		<h1><?= $item['name'] ?></h1>
		<h3>Users who added this product/item under their wishlist:</h3>
		<div>
			<? foreach($wishers as $wisher) { ?>
				<p><?= $wisher['name'] ?></p>
        	<?php } ?>
		</div>
	</div>
</body>
</html>