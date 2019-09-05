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
                'img' => $row->eve_img,
                'userId' => $_POST['userId'] 
            );
        }

        echo json_encode($result);
    }elseif (isset($_POST['eventId'])) {
        $sql = $handler->prepare("INSERT INTO participants(
            `mem_id`,
            `eve_id`,
            `par_indate`) 
            VALUES(
                :userId,
                :eventId,
                now()
            )");

        $sql->execute(array(
            'userId' => isset($_POST['userId']) ? $_POST['userId'] : null , 
            'eventId' => isset($_POST['eventId']) ? $_POST['eventId'] : null
        ));

        echo $_POST['eventId'];
    }

?>