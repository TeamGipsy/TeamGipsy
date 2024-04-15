<?php
session_start();

include "connect.php";
function sqllogin()
{

   $username = mysql_real_escape_string($_POST["login_user"]);
   $password = mysql_real_escape_string($_POST["login_password"]);
   $sql = "SELECT * FROM users WHERE username='$username' and password='$password'";
   // print_r($sql);
   $res = mysql_query($sql) or die('harder!!!!');
   $row = mysql_fetch_row($res);
   // print_r($row);
   if ($row[1]) {
      return $row[1];
   } else {
      return 0;
   }

}


$login = sqllogin();
if (!$login == 0) {
   $_SESSION["username"] = $login;
   setcookie("Auth", 1, time() + 3600);
   header('Location: Logged.php');
}

?>

<html>

<head>
</head>

<body bgcolor="#000000">
   <script>
      <?php
      if (isset($_SESSION['username']) && $_SESSION['username'] == '') {
         print('alert("Login Sucess");window.location.href = "./Logged.php";');
      } else {
         print('alert("Password error!");window.location.href = "./index.php";');
      }
      ?>
      
   </script>
</body>

</html>