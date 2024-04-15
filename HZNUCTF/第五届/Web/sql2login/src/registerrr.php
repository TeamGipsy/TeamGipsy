<html>
<head>
</head>
<body bgcolor="#000000">
<?PHP
session_start();
?>
<div align="center">
<font size="25" color="#FF0000">
<a style="font-size:.8em;color:#FF0000" href='index.php'></br>Back to main page</a>
</div>
<?php
@error_reporting(0);
include "connect.php";

if (isset($_POST['submit']))
{

	$username=  mysql_escape_string($_POST['username']) ;
	$pass= mysql_escape_string($_POST['password']);
	$re_pass= mysql_escape_string($_POST['re_password']);

	echo "<font size='3' color='#000000'>";
	$sql = "select count(*) from users where username='$username'";
	$res = mysql_query($sql) or die('harder!!!!');
  	$row = mysql_fetch_row($res);

	if (!$row[0]== 0) {
		?>
		<script>
            alert("The username Already exists, Please choose a different username ")
            window.location.href = "./register.php";
        </script>;
		<?php
		header('url=register.php');
	}
	else {
    	if ($pass==$re_pass)
		{

   			$sql = "insert into users ( username, password) values(\"$username\", \"$pass\")";
   			mysql_query($sql) or die('Error Creating your user account: '.mysql_error());
   			?>
            <script>
                alert('Registered successfully!')
                window.location.href = "./index.php";
            </script>
			<?php
		}
		else{
		?>
		<script>
            alert('Please make sure that password field and retype password match correctly')
            window.location.href = "./register.php";
        </script>
		<?php
		}
	}
}
?>

</body>
</html>
