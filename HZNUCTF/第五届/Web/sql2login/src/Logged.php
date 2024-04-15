<?PHP
session_start();
if (!isset($_COOKIE["Auth"])) {
	if (!isset($_SESSION["username"])) {
		header('Location: index.php');
	}
	header('Location: index.php');
}
?>
<html>

<head>
	<title>
	</title>
</head>

<body bgcolor="#000000">
	<center>
		<font size="5" color="#FFFFFF"><strong>
				<?php
				echo "YOU ARE LOGGED IN AS";
				?>
				</br>
				<font size="7" color="#FFFF00"><strong>
						<?php
						echo $_SESSION["username"];
						?>

						</br>

						<font size="7" color="#FF0000"><strong>
								<?php
								include "flag.php";
								echo "YOUR FLAG:";
								if ($_SESSION["username"] == "admin") {
									echo $FLAG;
								} else {
									echo "not_FLAG!";
								}
								?>

							</strong>
							</br>
							</br>
							<font size="5" color="#00FF00">
								You can change your password~


								<form name="mylogin" method="POST" action="PasswdChange.php">
									<table style="margin-top:50px;">
										<tr>
											<td style="text-align:right">
												<font size="3" color="#00FFFF">
													<strong>Original password:</strong>
												</font>
											</td>
											<td style="text-align:left">
												<input name="current_password" id="current_password" type="text"
													value="" />
											</td>
										</tr>
										<tr>
											<td style="text-align:right">
												<font size="3" color="#00FFFF">
													<strong>New Password:</strong>
												</font>
											</td>
											<td style="text-align:left">
												<input name="password" id="password" type="password" value="" />
											</td>
										</tr>

										<tr>
											<td style="text-align:right">
												<font size="3" color="#FF0000">
													<strong>Retype Password:</strong>
												</font>
											</td>
											<td style="text-align:left">
												<input name="re_password" id="re_password" type="password" value="" />
											</td>
										</tr>




										<tr>
											<td colspan="2" style="text-align:right">
												<input name="submit" id="submit" type="submit"
													value="Change password" />

											</td>
										</tr>

										<tr>
											<td colspan="2" style="text-align:right">
												<input name="submit1" id="submit1" type="submit"
													value="Logout" /><br /><br />
											</td>
										</tr>

									</table>
									<img src="./images/6.jpg">
	</center>
</body>

</html>