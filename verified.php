<?php
    include ("connect.php");
    session_start();
    $username = $_SESSION["Username"];
    $vkey =  $_GET['vkey'];
    $result = $db->query("SELECT Token FROM users WHERE Username='$username'");
    $db_vkey = $result->fetch();
    if ($db_vkey['Token'] === $vkey)
    {
        $statemnet = $db->prepare("UPDATE users SET Status='Active', Token='Done' WHERE Username=?");
        $statemnet->bindValue(1, $username);
        $statemnet->execute();
    }
    //Dont forget to destroy sessions.
?>
<html>
    <head>
        <title>Verified</title>
        <link rel="stylesheet" href="stylesheet.css">
        <style>
            .confirm {
                font-family: monospace;
                color: aliceblue;
                background-color: aqua;
                border: 2px solid cyan;
                width: 450px;
                height: 120px;
                margin: auto;
                border-radius: 20px;
                margin-top: 120px;
            }
            .text {
                font-size: 30px;
                margin-left: 150px;
            }
            .text_2 {
                font-size: 20px;
                margin-left: 20px;
            }
        </style>
    </head>
    <body>
        <header>
            <span class="header">CAMAGRU</span>
        </header>
        <section class="confirm">
            <span class="text">Success!</span>
            <p class="text_2">Congratulations. You have successfully verified your Email.</p>
        </section>
    </body>
</html>