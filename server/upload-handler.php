<?php
    require_once('handler.php');
    header('Access-Control-Allow-Origin: *');
    $new_image_name = urldecode($_FILES["file"]["name"]);
    move_uploaded_file($_FILES["file"]["tmp_name"], "../img/".$new_image_name);

    $sql = $handler->prepare("UPDATE participants SET par_status=1,par_img=? WHERE eve_id=? AND mem_id=?");
    $sql->execute(array($new_image_name,$_POST['value1'], $_POST['value2']));

    echo 1;
?>