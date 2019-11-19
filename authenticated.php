<?php
    session_start();
    include ("connect.php");
    $Username = $_POST["Username"];
    $Password = $_POST["Password"];
    $password_hash = hash("", $_POST["Password"]);
    $statement = $db->query("SELECT Username, Password, Status FROM camagru.users");
    $authenticate = $statement->fetchall();
    $index = 0;
    // header("location: Disconnected.html");
    while ($index < count($authenticate))
    {
        if ($_SESSION["Username"] === $authenticate[$index]["Username"])
        {
            if (($password_hash === $authenticate[$index]["Password"]) && ($authenticate[$index]["Status"] === "Active"))
            {
                $statement_2 = $db->prepare("UPDATE users SET Connection='Online' WHERE Username=?");
                $statement_2->bindValue(1, $_SESSION["Username"]);
                $statement_2->execute();
                header("location: user_gallery.php");
            }
        }
        $index++;
    }
?>