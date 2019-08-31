<?php
    require_once('handler.php');

    if (!empty($_POST['getAllEvent'])){
        $sql = $handler->query("SELECT * FROM events ORDER BY eve_id DESC");

        while ($row = $sql->fetch(PDO::FETCH_OBJ)) {
            $result[] = array(
                'id' => $row->eve_id,
                'title' => $row->eve_title,
                'desc' => $row->eve_desc,
                'eveDate' => $row->eve_date,
                'location' => $row->eve_location,
                'img' => $row->eve_img 
            );
        }

        echo json_encode($result);
    }

?>