<?php
    session_start();
    include ("connect.php");
    $statement = $conn->prepare("UPDATE users SET Connection='Offline' WHERE Username=?");
    $statement->bindValue(1, $_SESSION["Username"]);
    $statement->execute();
    session_destroy();
    header("location: http://localhost:8081/index.php");
?>