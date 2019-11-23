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
                left: -322px;
            }
            .upload_button {
                margin-top: 120px;
                margin-left: 10px;
                position: relative;
                left: -350px;
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
            <script language = "Javascript">
                function GetFile(e){
                    var FormInput = document.getElementById('up_img');
                    var fileReader = new FileReader();
                    fileReader.readAsDataURL(FormInput.files[0]);
                    fileReader.onloadend = function (e){
                        var string = e.target.result;
                        //var listElem = document.getElementById('string');
                        var ImgElem = document.getElementById('ImageFile');
                        ImgElem.src = string;
                        // ImgElem.setAttribute("width", "400px");
                        // ImgElem.setAttribute("heigh", "400px");
                    }

                }
            </script>
    </head>
    <body>
        <header class="heading">
            <img class="logo" src="Pictures/Untitled.png">
            <a class="logout" href="log_user_off.php">logout</a>
        </header>
        <body>
            <nav>
            <a class="cam" href="webcam.php">CAMERA</a>
                <a class="cam" href="pagination.php">GALLERY</a>
                <a class="gal" href="user_gallery.php">POST</a>
                <a class="user_gal" href="my_gallery.php">MY_GALLERY</a>
                <a class="user_gal" href="edit_info.php">Edit_Profile</a>
            </nav>
            <main>
                <form action="upload.php" method="post" enctype="multipart/form-data">              <!--Create a second page that will take the picture you have just selected and gives it the filters options-->
                    <input class="upload" type="file" id = "up_img" onchange="GetFile(event)" name="image">
                    <!-- <input class="upload_button" type="submit" name="submit"> -->
                </form>
                <div style="position: relative; top: 100px; left: 20px;">
                    <form action="process_img.php" method="post" onsubmit="upload_img();">
                        <input id="img_sub" name="img" type="hidden" value="">
                         <input id="img_upload" type="submit" value="Upload">
                     </form>
                    <form action="process_tmp_img.php" method="post" onsubmit="tmp_upload();">
                        <input  id="tmp_img" name="s1" type="hidden" value="">
                        <input type="submit" value="sticker_1">
                    </form>
                    <form action="process_tmp_img.php" method="post" onsubmit="tmp_u2();">
                        <input  id="tmp_i2" name="s2" type="hidden" value="">
                        <input type="submit" value="sticker_2">
                    </form>
                    <form action="process_tmp_img.php" method="post" onsubmit="tmp_u3();">
                        <input  id="tmp_i3" name="s3" type="hidden" value="">
                        <input type="submit" value="sticker_3">
                    </form>
                </div>
            </main>
            <li name="string" id="string" style="display:none;"></li>
            <img src="" id="ImageFile" width="400px" height="400px">
        </body>
    </body>
</html>
