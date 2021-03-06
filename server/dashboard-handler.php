<?php
    require_once('handler.php');

    if (!empty($_POST['getAllEvent'])){
        $userId = $_POST['userId'];
        $sql = $handler->query("SELECT * FROM events ORDER BY eve_id DESC");
        

        while ($row = $sql->fetch(PDO::FETCH_OBJ)) {
            $attend = 0;
            $statu = 0;
            $parSql = $handler->prepare("SELECT * FROM participants WHERE mem_id=?");
            $parSql->execute(array($userId));

            $att = $handler->prepare("SELECT COUNT(par_id) AS cnt FROM participants WHERE eve_id=?");
            $att->execute(array($row->eve_id));
            $cntRos = $att->fetch(PDO::FETCH_OBJ);

            while($rowPar = $parSql->fetch(PDO::FETCH_OBJ)) {
                $parEve = $rowPar->eve_id;
                $eve = $row->eve_id;
                
                if($parEve==$eve){
                    $attend = 1;  
                    $status = $rowPar->par_status;
                }     
            }

            $result[] = array(
                'id' => $row->eve_id,
                'title' => $row->eve_title,
                'desc' => $row->eve_desc,
                'eveDate' => $row->eve_date,
                'location' => $row->eve_location,
                'img' => $row->eve_img,
                'attend' => $attend,
                'status' => $status,
                'count' => $cntRos->cnt
            );
        }

        echo json_encode($result);
    }elseif (isset($_POST['eventId'])) {
        $userId = $_POST['userId'];
        $event = $_POST['eventId'];
        $sqlChk = $handler->prepare("SELECT * FROM participants WHERE eve_id=? AND mem_id=?");
        $sqlChk->execute(array($event,$userId));

        if ($sqlChk->rowCount()) {
            $sql = $handler->prepare("DELETE FROM participants WHERE eve_id=? AND mem_id=?");
            $sql->execute(array($event, $userId));
            
            $result[] = array(
                'eventId' => $event,
                'status' => 0 
            );

            echo json_encode($result);
        }else{
            $sql = $handler->prepare("INSERT INTO participants(
                `mem_id`,
                `eve_id`,
                `par_status`,
                `par_indate`
                ) 
                VALUES(
                    :userId,
                    :eventId,
                    0,
                    now()
                )");

            $sql->execute(array(
                'userId' => isset($_POST['userId']) ? $_POST['userId'] : null , 
                'eventId' => isset($_POST['eventId']) ? $_POST['eventId'] : null
            ));

            $result[] = array(
                'eventId' => $event,
                'status' => 1 
            );

            echo json_encode($result);
        }
            
    }

?>