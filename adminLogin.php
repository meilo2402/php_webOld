<?php

require_once('dbconn.php');
session_start();


function adminLogin()
{

	//ERROR Message Variable definieren 
	$errorMessage = '';
	if (!empty($_POST["login"]) && $_POST["email"] != '' && $_POST["password"] != '') {
		$email = $_POST['email'];
		$password = $_POST['password'];
		$sqlQuery = "SELECT * FROM users WHERE email='" . $email . "' AND password='" . md5($password) . "' AND status = 'active' AND type = 'Admin'";
		$resultSet = mysqli_query($db, $sqlQuery);
		$isValidLogin = mysqli_num_rows($resultSet);
		if ($isValidLogin) {
			$userDetails = mysqli_fetch_assoc($resultSet);
			$_SESSION["adminUserid"] = $userDetails['id'];
			$_SESSION["admin"] = $userDetails['first_name'] . " " . $userDetails['last_name'];
			header("location: dashboard.php");
		} else {
			$errorMessage = "Invalid login!";
		}
	} else if (!empty($_POST["login"])) {
		$errorMessage = "Enter Both user and password!";
	}
	return $errorMessage;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>


	<style>
        body {
            font-family: 'Gowun Dodum', sans-serif;
            background-color: #EAEDF8;
            margin: 0;
        }

        /* mit flex werden die beiden divs im main-div nebeneinander angezeigt */
        .main {
            display: flex;
        }

        .content {
            width: 70%;
            margin-top: 80px;
            margin-right: 32px;
            background-color: white;
            border-radius: 8px;
            padding: 16px;
            box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>


	<div class="main">
		<?php include('layouts/header.php'); ?>
		<div class="content">
			<?php
			if (isset($_GET["action"]) == "login") {
			?>
				<h3 align="center">Admin Login</h3>
				<br />
				<form method="post">
					<label>Username</label>
					<input type="text" name="username" class="form-control" />
					<br />

					<label>Enter Password</label>
					<input type="password" name="password" class="form-control" />
					<br />

					<input type="submit" name="login" value="Login" class="btn btn-info" />
					<br />

					<p align="center"><a href="signup.php?action=login">User Login</a></p>

				</form>

			<?php
			}
			?>
		</div>
	</div>
	<?php
	include "layouts/footer.php";
	?>
</body>

</html>