<?php
    session_start();
    include ("connect.php");
    include ("database.php");
    // require_once 'connect.php';
    $conn->query("SELECT * FROM users");
    $check = $DB_NAME->query("SELECT Username, Email FROM users");
    $results = $check->fetchall();

    $username = $_POST["Username"];
    $password_hash = hash("whirlpool", $_POST["Password"]);

    $statement = $conn->prepare('INSERT INTO `users` (`Username`, `Password`, `Email`, `Token`, `Status`, `Connection`) VALUES (?, ?, ?, ?, ?, ?)');
    $statement->bindValue(1, $username);
    $_SESSION["Username"] = $username;
    $statement->bindValue(2, $password_hash);
    $_SESSION["Password"] = $_POST["Password"];
    $statement->bindValue(3, $_POST["Email"]);
    $_SESSION["Email"] = $_POST["Email"];
    $str = "1234567890abcdefghigjlmnopqrstuvwxyzABCDEFGHIJKLMNOPRSTUVWXYZ";
    $vkey = substr(str_shuffle($str), 0, 8);
    $statement->bindValue(4, $vkey);
    $_SESSION["Token"] = $vkey;
    $statement->bindvalue(5, "Inactive");
    $_SESSION["Status"] = "Inactive";
    $statement->bindValue(6, "Offline");
    $_SESSION["Connection"] = "Offline";
    $statement->execute();
    $to = $_SESSION["Email"];
    $subject = "Verification link";
    $msg = "Click on the link below to verify email:\n http://localhost:8081/verified.php?vkey=$vkey";
    mail($to, $subject, $msg);
    header("location: confirmation.php");
    $x = 0;
    while ($x < count($results))
    {
        if ($results[$x]["Username"] === $_POST["Username"])
        {
            header("location: signup_02.html");
        }
        else if ($results[$x]["Email"] === $_POST["Email"])
        {
            header("location: signup_03.html");
        }
        $x++;
    }
?>