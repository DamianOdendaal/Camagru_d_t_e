<?php
    session_start();
    require_once ("connect.php");
    try {
        $_SESSION['Username'] = $_POST["Username"];
        $username = $_POST["Username"];
        $result = $conn->prepare("UPDATE camagru.users SET Status = 'Active' WHERE Username='$username'");
        $result->execute();
        $password_hash = hash("sha512", $_POST["Password"]);
        $statement = $conn->query("SELECT Username, Password, Status FROM camagru.users");
        $status = $conn->prepare("SELECT Status FROM camagru.users");
        $authenticate = $statement->fetchall();
        // print_r($authenticate);
        // echo $authenticate[0][1];

        $index = 0;
            if ($_SESSION['Username'] === $authenticate[0][0])
            {
                if (($password_hash === $authenticate[0][1]))
                {
                    header("location: index_logged.php");
                    // echo "This should work!";
                }
                else
                    echo "Invalid Password";
            }
        // session_destroy();
    }
    catch(PDOException $e){
        print_r($e);
    }
?>