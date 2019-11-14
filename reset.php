<?php
    session_start();
    include ("Connect.php");
    $email = $_SESSION["Email_P"];
    $statement = $db->query("SELECT Password FROM users WHERE Email='$email'");
    $pass = $statement->fetch();
    $result = $db->prepare("UPDATE users SET Password=? WHERE Email='$email'");
    $result->bindValue(1, $_POST["Newpass"]);
    $result->execute();
    header("location: index.php"); 
?>