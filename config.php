<?php

// Connection details for MS SQL Server
$serverName = "hahaserver88.database.windows.net"; // Replace with your SQL Server's name or IP address
$connectionOptions = array(
    "Database" => "foodorder", // Replace with your database name
    "Uid" => "yaoyao", // Replace with your SQL Server username
    "PWD" => "Qq0989260287" // Replace with your SQL Server password
);

// Establish a connection to MS SQL Server
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Check the connection
if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

?>
