<?php
    session_start();
    include ("connect.php");
    if ($_SESSION)
    {
        $user = $_SESSION['Username'];
    }
        $total_items_per_page = 10;
        //get current page.
        if (isset($_GET['page']))
        {
            $page_no = $_GET['page'];
        }
        else
        {
            $page_no = 1;
        }
        //Set the offset for the query
        $offset = ($page_no - 1) * $total_items_per_page;
        $statement = $conn->query("SELECT Image, Username FROM camagru.images LIMIT $offset, $total_items_per_page");
        $items_array = $statement->fetchall();
        //var_dump($items_array);
        //get the total number of pages.
        $result_set = $conn->query("SELECT * FROM camagru.images");
        $array = $result_set->fetchall();
        $total_items = count($array);
        $total_pages = ceil($total_items / $total_items_per_page);
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
            a:link {
                text-decoration: none;
                font-family: monospace;
                font-size: 17px;
            }
            .post {
                font-size: 30px;
                color: #2f2e2f;
                position: relative;
                top: 12px;
                margin-left: 15px;
                float: left;
            }
            .cam {
                font-size: 30px;
                color: #2f2e2f;
                position: relative;
                top: 12px;
                margin-left: 15px;
                float: left;
            }
            .upload {
                margin-top: 120px;
                position: relative;
                left: -210px;
            }
            .upload_button {
                margin-top: 120px;
                margin-left: 10px;
                position: relative;
                left: -230px;
            }
            .gal {
                font-size: 30px;
                color: #2f2e2f;
                position: relative;
                top: 12px;
                margin-left: 15px;
                float: left;
            }
               .user_gal {
                font-size: 30px;
                color: #2f2e2f;
                position: relative;
                top: 12px;
                margin-left: 15px;
                float: left;
            }
        </style>
    </head>
    <body>
        <header class="heading">
            <img class="logo" src="Pictures/Untitled.png">
            <?php 
            if ($_SESSION)
            { ?>
            <a class="logout" href="log_user_off.php">logout</a>
            <?php }?>
        </header>
        <body>
            <nav>
                <?php if ($_SESSION) { ?>
                    <a class="cam" href="webcam.php">CAMERA</a>
                <a class="cam" href="pagination.php">GALLERY</a>
                <a class="gal" href="user_gallery.php">POST</a>
                <a class="user_gal" href="my_gallery.php">MY_GALLERY</a>
                <a class="user_gal" href="edit_info.php">Edit_Profile</a>
                <?php } else {?>
                <a class="gal" href="pagination.php">GALLERY</a>
                <a class="gal" href="sign_up.php">SIGNUP</a>
                <a class="gal" href="login.html">LOGIN</a>
                <?php }?>
            </nav>
            <main>
                <form action="pagination.php" method="get">
                    <?php
                    $x = 1;
                    while ($x <= $total_pages)
                    {?>
                    <input class="upload_button" type="submit" value='<?php echo $x?>' name="page"/>
                    <?php
                    $x++;
                    }?>
                </form>
                <?php
                    $y = 0;
                    while ($y < count($items_array))
                    {
                ?>
                <a href='comment_likes.php?pic=<?php echo $items_array[$y]['Image']?>' target='_self'><img style="padding: 1px;"width="160px" height="156px" src='<?php echo $items_array[$y]['Image'];?>'></a>
                <?php
                     $y++;
                    }
                ?>
            </main>
        </body>
    </body>
</html>