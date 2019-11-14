<?php
    session_start();
    include ("connect.php");
    $_SESSION["Email_P"] = $_POST["Email"];
    $to = $_SESSION["Email_P"];
    $subject = "Password Reset Link";
    $msg = "Click on the link below to reset password:\n http://localhost:8081/pass_reset.php";
    mail($to, $subject, $msg);
    header("location: link_pass.php");
?>