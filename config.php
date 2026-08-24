<?php

$host = "mysql-3ac8eab-soumyaseeree-b20d.b.aivencloud.com";
$user = "avnadmin";
$password = "AVNS_9eD7ubCuGxgHtma8ggE";
$database = "defaultdb";
$port = 19271;

$con = mysqli_init();

mysqli_ssl_set(
    $con,
    null,
    null,
    null,
    null,
    null
);

if (!mysqli_real_connect(
    $con,
    $host,
    $user,
    $password,
    $database,
    $port
)) {
    die("Database connection failed: " . mysqli_connect_error());
}

echo "Database connected successfully!";
?>
