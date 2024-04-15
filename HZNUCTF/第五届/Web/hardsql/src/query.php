<?php
session_start();
// 指定数据库连接信息
// MYSQL_USER: root
// MYSQL_PASSWORD: asd222!!@332asc
$status = 0;

if (isset($_POST["host"])) {
  $host = $_POST["host"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $dbname = $_POST["dbname"];
  $status = 0;
} else {
  $host = $_SESSION["host"];
  $username = $_SESSION["username"];
  $password = $_SESSION["password"];
  $dbname = $_SESSION["dbname"];
  $status = 1;
}


// 连接数据库
$conn = new mysqli($host, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// $conn->options(MYSQLI_OPT_LOCAL_INFILE, true);

if ($status == 0) {
  $_SESSION["host"] = $_POST["host"];
  $_SESSION["username"] = $_POST["username"];
  $_SESSION["password"] = $_POST["password"];
  $_SESSION["dbname"] = $_POST["dbname"];

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Query</title>
</head>

<style>
  form {
    width: 600px;
    margin: 0 auto;
  }

  label {
    display: block;
    margin-bottom: 10px;
  }

  input,
  textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 20px;
  }

  #submit {
    background: #3498db;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
</style>

<body>
  <form method="post" action="query.php">

    <h2>Execute SQL</h2>

    <label for="sql">SQL Statement:</label>
    <input id="sql" name="sql"></input>

    <input type="submit" id="submit" value="Submit">

  </form>
</body>

</html>
<?php

if (isset($_POST["sql"])) {
  $result = $conn->query($_POST["sql"]);
  // var_dump($result);
  if ($result->num_rows > 0) {
    echo "<table>";
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      foreach ($row as $key => $val) {
        echo "<td>$key: $val</td>";
      }
      echo "</tr>";
    }
    echo "</table>";
  } else {
    if ($result == false) {
      echo "error: ". mysqli_error($conn);
    } else
      echo "Query executed successfully.";
  }

}
// 关闭连接
$conn->close();

?>