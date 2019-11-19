<?php
    require_once ("database.php");
    require_once ("connect.php");
    session_start();
    
    try
    {
        print_r($_POST);
        $check = $conn->prepare("SELECT Username, Email FROM camagru.users as u WHERE u.Username = ? OR u.Email = ?");
        $check->bindParam(1, $_POST['Username']);
        $check->bindParam(2, $_POST['Email']);
        $check->execute();
        $results = $check->rowCount();
        if ($results == 0)
        {
            $username = $_POST["Username"];
            $password_hash = hash("sha512", $_POST['Password']);
        
            $statement = $conn->prepare('INSERT INTO camagru.`users` (`Username`, `Password`, `Email`, `Token`) VALUES (?, ?, ?, ?)');
            $vkey = hash("sha512", $username . $_POST['Email']);
            $statement->execute(
                array(
                    $username,
                    $password_hash,
                    $_POST['Email'],
                    $vkey
                )
            );
            $to = $_POST['Email'];
            $subject = "Verification link";
            // TODO: Stop being a dodo and fix the link,
           $msg = "Click on the link below to verify email:\n ".$_SERVER['HTTP_HOST']."/verified.php?vkey=$vkey";
            mail($to, $subject, $msg);
            header("location: confirmation.php");
        }
        else
            header("location: lajsdjkasdjfa?error=UserInformationAlreadyExists");

    } catch(PDOException $e)
    {
        //FIXME: Fix me
        echo " I AM A DODO! <br/>";
        echo '<pre>';
        print_r($e);
        echo '</pre>';
    }
?>