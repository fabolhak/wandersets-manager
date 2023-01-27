<?php
    define('DB_SERVER', 'some-server');
    define('DB_USERNAME', 'some-user');
    define('DB_PASSWORD', 'some-secret-password');
    define('DB_NAME', 'some-database-name');

    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if ($conn === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
?>

