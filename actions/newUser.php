<?php
    include_once "db.php";

    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $password = $_POST['password'];
    $active = @$_POST['active'] == 'on';
    $selectedOptions = [];

    $queryNewUser = "INSERT INTO users (name, lastname, password, active) VALUES ($1, $2, $3, $4) RETURNING user_id";
    $res = pg_query_params($conn, $queryNewUser, [$name, $lastname, $password, $active]);
    $user_id = pg_fetch_result($res, 0, 0);

    $queryAllMenuOpts = "SELECT * FROM menu_opts";
    $resGetOpts = pg_query($queryAllMenuOpts);

    $queryAddNewPermission = "INSERT INTO permissions (user_id, option_id) VALUES ";

    while ($row = pg_fetch_assoc($resGetOpts)){

        $replaced = str_replace(" ", "_", $row['option']);
        $selectedOpt = $_POST["opt_" . $replaced];

        if (isset($selectedOpt) && $selectedOpt == 'on')
            $queryAddNewPermission .= "($user_id, " . $row['option_id'] . "), ";
    }

    $queryAddNewPermission = substr_replace($queryAddNewPermission, ';', strrpos($queryAddNewPermission, ', '), 1);
    $resGetOpts = pg_query($queryAddNewPermission);

    header('Location: http://localhost:8087');
