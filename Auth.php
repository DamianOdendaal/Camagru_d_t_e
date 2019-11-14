<?php
    session_start();
    include ("connect.php");
    $_SESSION["Username"] = $_POST["Username"];
    $_SESSION["Password"] = $_POST["Password"];
    $password_hash = hash("whirlpool", $_POST["Password"]);
    $statement = $db->query("SELECT Username, Password, Status FROM users");
    $authenticate = $statement->fetchall();
    $x = 0;
    header("location: Disconnected.html");
    while ($x < count($authenticate))
    {
        if ($_SESSION["Username"] === $authenticate[$x]["Username"])
        {
            if (($password_hash === $authenticate[$x]["Password"]) && ($authenticate[$x]["Status"] === "Active"))
            {
                $statement_2 = $db->prepare("UPDATE users SET Connection='Online' WHERE Username=?");
                $statement_2->bindValue(1, $_SESSION["Username"]);
                $statement_2->execute();
                header("location: user_gallery.php");
            }
        }
        $x++;
    }
?>