<?php
    require_once('handler.php');

    if (!empty($_POST['getMyEvent'])){
        $userId = $_POST['userId'];
        $sql = $handler->prepare("SELECT events.eve_id,events.eve_title,events.eve_desc,events.eve_date,events.eve_location,events.eve_img, participants.par_id
        FROM events INNER JOIN participants ON participants.eve_id = events.eve_id WHERE participants.mem_id = ?;");

        $sql->execute(array($userId));

        while ($row = $sql->fetch(PDO::FETCH_OBJ)) {
            $attend = 1;
            
            $result[] = array(
                'id' => $row->eve_id,
                'title' => $row->eve_title,
                'desc' => $row->eve_desc,
                'eveDate' => $row->eve_date,
                'location' => $row->eve_location,
                'img' => $row->eve_img,
                'attend' => $attend 
            );
        }

        echo json_encode($result);
    }

?>