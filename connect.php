<?php
    include ("database.php");
    try {
        $db = new PDO("$DB_DSN, $DB_USER, $DB_PASSWORD);
    }
    catch (exception $e){
        echo "An error as occurred";
    }
?>