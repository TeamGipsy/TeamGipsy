<?PHP
session_start();
if (isset($_SESSION['username']) && isset($_COOKIE['Auth'])) {
   header('Location: Logged.php');
}
?>


<?php
include "connect.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" >
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<title>FLAG is sent after login~</title>
</head>
<body bgcolor="#FFFFFF">

<div style="text-align:center">
<form name="login" method="POST" action="login.php">

<h2 style="text-align:center;background-image:url('./images/3.jpg');background-repeat:no-repeat;background-position:center center">
<div style="padding-top:2000px;text-align:center;color:#000000;"><?php echo "FLAG is in sqli-labs"; ?></div>
</h2>

<div align="center">
<table style="margin-top:80px;">
<tr>
<td style="text-align:right">
<font size="15" color="#FF0000">
<strong>Username:</strong>
</td>
<td style="text-align:left">
<style>
  #login_user {
    width: 300px; /* 设置宽度为150像素 */
    height: 30px; /* 设置高度为50像素 */
  }
</style>
<input name="login_user" id="login_user" type="text" value="" />
</td>
</tr>
<tr>
<td style="text-align:right">
<font size="15" color="#FF0000">
<strong>Password:</strong>
</td>
<td style="text-align:left">
<style>
  #login_password {
    width: 300px; /* 设置宽度为150像素 */
    height: 30px; /* 设置高度为50像素 */
  }
</style>
<input name="login_password" id="login_password" type="password" value="" />
</td>
</tr>
<tr>
<td colspan="2" style="text-align:right">
<style>
  #mysubmit {
    width: 600px; /* 设置宽度为150像素 */
    height: 50px; /* 设置高度为50像素 */
  }
</style>
<input name="mysubmit" id="mysubmit" type="submit" value="Login"/><br/><br/>

<font size="15" color="#FF0000">
<a style="font-size:.8em;color:#000000" href="register.php">Register!</a>
</td>
</tr>

</table>
</div>
</form>
</div>
</body>
</html>
