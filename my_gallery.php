<?php
    session_start();
    include ("connect.php");
    if (isset($_POST['delete']))
    {
        $result_set = $conn->prepare("DELETE FROM camagru.images WHERE Image=?");
        $result_set->bindValue(1, $_SESSION['pic_loc']);
        $result_set->execute();
        $new_path = explode('/', $_SESSION['pic_loc']);
        rename($_SESSION['pic_loc'], "Trash/$new_path[1]");
    }
    $user = $_SESSION['Username'];
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
    $statement = $conn->query("SELECT Image FROM camagru.images WHERE Username='$user'");
    $items_array = $statement->fetchall();
?><!DOCTYPE html>
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
            <a class="logout" href="log_user_off.php">logout</a>
        </header>
        <body>
            <nav>
                <!-- <a class="post" href="user_gallery.php">POST</a> -->
                <a class="cam" href="webcam.php">CAMERA</a>
                <a class="cam" href="pagination.php">GALLERY</a>
                <a class="gal" href="user_gallery.php">POST</a>
                <a class="user_gal" href="my_gallery.php">MY_GALLERY</a>
                <a class="user_gal" href="edit_info.php">Edit_Profile</a>
            </nav>
            <main style="position: relative; top: 60px; left: 10px">
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