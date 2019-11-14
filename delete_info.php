<?php
    //nclude ("connect.php");
    function delete_image($image_name)
    {
        $result_set = $db->prepare("DELETE FROM user_images WHERE Image=?");
        $result_set->bindValue(1, $image_name);
        $result_set->execute();
    }
?>