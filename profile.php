<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'aose';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT icciitii, naannoo FROM galmee WHERE iddoo= ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['iddoo']);
$stmt->execute();
$stmt->bind_result($icciitii, $naannoo);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Piroofayilii fuula</title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Fuula Weebisayiitii </h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Piroofaayilii</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>bahiinsa</a>
			</div>
		</nav>
		<div class="content">
			<h2>piroofayilii keessaan</h2>
			<div>
				<p>piroofayilii keessaan kanaadha:</p>
				<table>
					<tr>
						<td>Fayyadamaa:</td>
						<td><?=$_SESSION['maqaa']?></td>
					</tr>
					<tr>
						<td>Icciitii-darbinsaa:</td>
						<td><?=$icciitii?></td>
					</tr>
					<tr>
						<td>naannoo:</td>
						<td><?=$naannoo?></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>