<?php
    session_start();
    include ("connect.php");
    include ("database.php");
    // $username = $_SESSION["Username"];                   // ask why this is here
    try {
        $db = new PDO("mysql:host=localhost", $DB_USER, $DB_PASSWORD);
    }
    catch (exception $e)
    {
        echo "An error has occured";
    }
    $db->exec("CREATE DATABASE IF NOT EXISTS camagru_users");
    $db->exec("CREATE TABLE IF NOT EXISTS camagru_users.users (ID INT AUTO_INCREMENT, Username VARCHAR(255), Password VARCHAR(255), Email VARCHAR(255), Token TEXT(8), Status VARCHAR(10), Connection VARCHAR(20), PRIMARY KEY(ID))");
?> 