<?php
    include ("connect.php");
   // include ("delete_info.php");
    session_start();
    $_SESSION['pic_loc'] = $_GET['pic'];
    if (isset($_POST['comment']))
    {
        $result = $db->prepare("INSERT INTO `user_comments` (`Comment`, `Username`, `Image`) VALUES (?, ?, ?)");
        $result->bindValue(1, $_POST['comment']);
        $result->bindValue(2, $_SESSION['Username']);
        $result->bindValue(3, $_GET['pic']);
        $result->execute();
    }
    $img = $_GET['pic'];
    $result_01 = $db->query("SELECT * FROM user_likes WHERE Image='$img'");
    $amount = $result_01->fetchall();
    $likes = count($amount);
    if (isset($_POST['like']))
    {
        $result_00 = $db->prepare("INSERT INTO `user_likes` (`Username`, `Image`) VALUES (?, ?)");
        $result_00->bindValue(1, $_SESSION['Username']);
        $result_00->bindValue(2, $_GET['pic']);
        $result_00->execute();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            .heading {
                border-bottom: 1px solid #cac6c6;
                background-color: white;
            }
            body {
                background-color: #f3f2f2;
                margin: 0px;
            }
            .logo {
                margin-left: 20px;
                width: 90px;
            }
            .user_name {
                float: right;
                margin-top: 35px;
                margin-right: 30px;
            }
            .logout {
                float: right;
                margin-top: 35px;
                margin-right: 45px;
            }
            .gallery {
                width: 40px;
                position: relative;
                left: 75px;
                top: -23px;
            }
        </style>
    </head>
    <body>
        <header class="heading">
            <img class="logo" src="Pictures/Untitled.png">
            <?php if ($_SESSION) {?>
            <a class="logout" href="log_user_off.php">logout</a>
            <?php }?>
        </header>
        <main >
            <img witdh="350px" height="350px" src='<?php echo $_GET['pic']?>'>
            <?php 
            if ($_SESSION) {
            ?>
            <form action="" method="post">
                <input type="text" name="comment" placeholder="Enter a comment" style="float: left; width: 270px;">
            </form>
            <?php if ($_SESSION)
            { 
                $image_path = $_GET['pic'];
                $result_set = $db->query("SELECT Username FROM user_images WHERE Image='$image_path'");
                $array = $result_set->fetchall();
                if (count($array) > 0)
                {
                    var_dump($array);
                    if ($_SESSION['Username'] == $array[0]['Username'])
                    {
                ?>
                <form action="my_gallery.php" method="post">
                    <input type="submit" name="delete" value="delete">
                </form>
                <?php
                    }
                    else {
                        echo "Page invalid";
                    }
                }
            }?>
            <form action="" method="post">
                <input type="submit" name="like" value="like" style="margin-left: 20px; width: 60px;">
                
                <span><?php 
                        if($likes != 0)
                        {
                            echo $likes;
                        }
                       ?>
                </span>
            </form>
            <?php 
            }?>
        </main>
    </body>
</html>
<?php
    if ($_SESSION)
    {
        $image = $_GET['pic'];
        $result_01 = $db->query("SELECT Comment, Username FROM user_comments WHERE Image = '$image'");
        $array = $result_01->fetchall();
        echo '<html>';
        echo '<textarea rows="4" cols="60" style="margin-top: 5px;" readonly>';
                    $x = 0;
                    while ($x < count($array))
                    {
                        echo $array[$x]['Username'].": ".$array[$x]['Comment'];
                        echo "\n";
                        $x++;
                    }
        echo '</textarea>';
        echo '';
        echo '</html>';
    }
?>