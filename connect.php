<?php
    try {
        $db = new PDO("mysql:host=localhost;dbname=camagru_users", "root", "Mark444");
    }
    catch (exception $e){
        echo "An error as occurred";
    }
?>