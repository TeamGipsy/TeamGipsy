<?PHP
session_start();
if (!isset($_COOKIE["Auth"]))
{
	if (!isset($_SESSION["username"]))
	{
   		header('Location: index.php');
	}
	header('Location: index.php');
}
?>

<html>
<head>
</head>
<body bgcolor="#000000">
<?php
error_reporting(0);
include "connect.php";


if (isset($_POST['submit']))
{
	$username= $_SESSION["username"];
	$curr_pass= mysql_real_escape_string($_POST['current_password']);
	$pass= mysql_real_escape_string($_POST['password']);
	$re_pass= mysql_real_escape_string($_POST['re_password']);

	if($pass==$re_pass)
	{
		$sql = "UPDATE users SET PASSWORD='$pass' where username='$username' and password='$curr_pass' ";
		$res = mysql_query($sql) or die('harder!!!');
		$row = mysql_affected_rows();
		echo '<font size="3" color="#FFFF00">';
		echo '<center>';
		if($row==1)
		{
			?>
            <script>
                alert("Password successfully updated");
                window.location.href = "./Logged.php";
            </script>

	        <?php
		}
		else
		{
            ?>
            <script>
                alert("Password error!");
                window.location.href = "./Logged.php";
            </script>

            <?php
		}
	}
	else
	{
        ?>
        <script>
            alert("Make sure New Password and Retype Password fields have same value!");
            window.location.href = "./Logged.php";
        </script>

        <?php
	}
}
?>
<?php
if(isset($_POST['submit1']))
{
	session_destroy();
	setcookie('Auth', 1 , time()-3600);
	?>
        <script>
            window.location.href = "./index.php";
        </script>

    <?php
}
?>

</center>
</body>
</html>
