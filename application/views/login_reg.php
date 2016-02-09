<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="/assets/styles.css">
	<meta charset="utf-8">
	<title>Login and Registration</title>
</head>
<body>
	<div id="wrapper">
		<h1>Welcome!</h1>
		<div id="register">
			<h3>Register</h3>
			<form action="logins/register_user" method="post">
				<p>Name: <input type="text" name="name"></p>
				<p>Username: <input type="text" name="username"></p>
				<p>Password: <input type="password" name="password"></p>
					<h5>*Password should be at least 8 characters</h5>
				<p>Confirm Password: <input type="text" name="confirm_password"></p>
				<p>Date Hired: <input type="date" name="date_hired" min="2000-01-01" max="2016-01-01"></p>
				<input type="submit" value="Register">
			</form>
		</div>
		<div id="login">
			<h3>Login</h3>
			<form action="logins/login_user" method="post">
				<p>Username: <input type="text" name="username">
				<p>Password: <input type="password" name="password"></p>
				<input type="submit" value="Login">
			</form>
		</div>
		<div id="errors">
			<?= $this->session->flashdata("errors"); ?>
		</div>
	</div>
</body>
</html>