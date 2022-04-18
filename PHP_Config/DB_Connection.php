<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "brief4-retry-stock-management";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        echo "Connected Successfully";
    }

    // Close connection
//    $conn->close();