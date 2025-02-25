<?php

$dbservername = "localhost";
$dbusername = "postgres";
$dbname = "pt";
$dbpass = "root";
$port = "5432";

$conn = pg_connect("host=$dbservername port=$port dbname=$dbname user=$dbusername password=$dbpass");