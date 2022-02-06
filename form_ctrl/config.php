<?php


    // send to DB    
    $the_directory = substr(dirname(__FILE__), 0, strpos(dirname(__FILE__), 'wp-content'));
    require_once $the_directory . 'wp-config.php';
    $servername = "localhost";
    $username = DB_USER;
    $password = DB_PASSWORD;
    $DBName = DB_NAME."_lightfusion";
    $conn = new mysqli($servername, $username, $password, $DBName);
    $conn -> set_charset("utf8");
    if($conn->connect_error) die("connection failed: ".$conn->connect_error);



?>