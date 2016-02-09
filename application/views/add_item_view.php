<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="/assets/styles.css">
	<meta charset="utf-8">
	<title>Create Item</title>
</head>
<body>
	<a href="/profile"><p>Home</p></a>
	<a href="/logins/logout_user"><p>Logout</p></a>
	<div id="wrapper">
		<h1>Create a New Wishlist Item</h1>
		<div>
			<form action="/adds/add_new_item" method="post">
				<p>Item/Product: <input type="text" name="item"></p>
				<input type="hidden" name="added_by" value="<?= $this->session->userdata('id') ?>">
				<input type="submit" value="Add">
			</form>
		</div>
		<div id="errors">
			<?= $this->session->flashdata("errors"); ?>
		</div>
	</div>
</body>
</html>