<?php

include_once "db.php";

$name = $_POST['name'];
$password = $_POST['password'];

if ($conn) {
    $queryAuth = "SELECT user_id FROM users WHERE name=$1 AND password=$2 AND active limit 1";

    $res = pg_query_params($conn, $queryAuth, [$name, $password]);
    if (pg_num_rows($res) == 0) header('Location: http://localhost:8087');

    $user_id = pg_fetch_result($res, 0, 0);

    $queryGetPermissions = "SELECT mo.option FROM permissions p INNER JOIN menu_opts mo ON p.option_id = mo.option_id WHERE p.user_id = $user_id";
    $resGetPermissions = pg_query($queryGetPermissions);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File</title>
</head>
<body>
    <h1>File</h1>
    <form action="./createUser.php">
        <input type="submit" value="New user" />
    </form>
    <?php 
        while ($row = pg_fetch_row($resGetPermissions))
            echo "<hr/><button onclick=\"alert('" . $row[0] ."')\">" . $row[0] . "</button>";
    ?>
</body>
</html>