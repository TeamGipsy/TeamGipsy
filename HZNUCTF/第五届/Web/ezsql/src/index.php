<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ezsql</title>
    <style>
        form {
            width: 400px;
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
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: lightblue;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <form method="post" action="query.php">

        <label for="host">Host:</label>
        <input type="text" id="host" name="host">

        <label for="username">Username:</label>
        <input type="text" id="username" name="username">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password">

        <label for="dbname">Database:</label>
        <input type="text" id="dbname" name="dbname">

        <input type="submit" value="Submit">

    </form>
</body>

</html>