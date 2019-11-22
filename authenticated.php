<?php
    session_start();
    require_once ("connect.php");
    try {
        $_SESSION['Username'] = $_POST["Username"];
        $username = $_POST["Username"];
        $result = $conn->prepare("UPDATE camagru.users SET Status = 'Active' WHERE Username='$username'");
        $result->execute();
        $password_hash = hash("sha512", $_POST["Password"]);
        $statement = $conn->prepare("SELECT Username, Password, Status FROM users");
        $status = $conn->prepare("SELECT Status FROM camagru.users");
        $authenticate = array(
            $_SESSION['Username'],
            $password_hash
        );
        $index = 0;
        // header("location: Disconnected.html");
            if ($_SESSION['Username'] === $authenticate[0])
            {
                if (($password_hash === $authenticate[1]))
                {
                    header("location: user_gallery.php");
                }
            }
        // session_destroy();
    }
    catch(PDOException $e){
        print_r($e);
    }
?>