<?php
    include_once "db.php";

    $queryAllMenuOpts = "SELECT option FROM menu_opts";
    $resGetOpts = pg_query($queryAllMenuOpts);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New user</title>
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100vh;">
    <form action="./newUser.php" method="POST" style="display: flex; flex-direction: column; width:30%; gap: 15px; align-items: center; border: solid 1px #000; padding: 25px;">
        <input type="text" style="width: 100%; font-size: 12pt;" name="name" placeholder="Name" />
        <input type="text" style="width: 100%; font-size: 12pt;" name="lastname" placeholder="Last name" />
        <input type="password" style="width: 100%; font-size: 12pt;" name="password" placeholder="Password" />

        <div style="display: flex;">
            <input type="checkbox" id="radio" style="width: 100%; font-size: 12pt;" checked name="active" />
            <label for="radio">Active</label>
        </div>

        <div style="display: flex; flex-direction: column;">
            <h3>Options</h3>
            <?php 
                while ($row = pg_fetch_row($resGetOpts)){
                    $replaced = str_replace(" ", "_", $row[0]);
                    echo '
                        <div style="display: flex;">
                            <input type="checkbox" id="opt_' . $replaced . '" name="opt_' . $replaced . '" />
                            <label for="opt_' . $replaced . '">'. $row[0] .'</label>
                        </div>
                    ';
                }
            ?>
        </div>

        <input type="submit" style="width: fit-content"/>
    </form>
</body>
</html>