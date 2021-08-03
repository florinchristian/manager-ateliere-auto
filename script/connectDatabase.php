<?php
    $server = 'localhost';
    $admin = 'root';
    $pwd = '';
    $dbname = 'test';
  
    $conn = new mysqli($server, $admin, $pwd, $dbname);
    if ($conn->connect_error) {
        die('cant_connect');
    }
?>