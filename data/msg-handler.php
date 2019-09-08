<?php
    require_once('handler.php');

    if(isset($_POST['title'])){
        $title = $_POST['title'];
        $description = $_POST['desc'];
        $txt = $title ." ".$description;
        $sql = $handler->prepare("INSERT INTO message(
            `msg_title`,
            `msg_desc`,
            `msg_indate`
            ) 
            VALUES(
                :title,
                :descrip,
                now()

            )");

        $sql->execute(array(
            'title' => isset($_POST['title']) ? $_POST['title'] : null,
            'descrip' => isset($_POST['desc']) ? $_POST['desc'] : null  
            ));

        $lastInsert = $handler->lastInsertId();
        $cnt = 0;
        
        foreach ($_POST['contact'] as $key) {
            $results ="";
            $status = 0;
            $conSql = $handler->prepare("SELECT mem_contact FROM member WHERE mem_id =?");
            $conSql->execute(array($key));
            $row = $conSql->fetch(PDO::FETCH_OBJ);
            $contact = str_replace("-","",$row->mem_contact);
            $contact = str_replace("(63) ","63",$contact);
            
            $results=itexmo($contact,$txt,'TR-ABEGA370289_6W9D7');

            if ($results == ""){
                $status = 0;
            }else if ($results == 0){
                $status = 1;
            }else{	
                $status = 0;
            }
            
            $sql = $handler->prepare('INSERT INTO message_sent(`msg_id`,`mem_id`,`ms_status`) VALUES(?,?,'.$status.')');
            $sql->execute(array($lastInsert, $key));
            $cnt++;
            
            
        }

        $result[] = array(
            'status' => $status,
            'cnt' => $cnt
        );

        echo json_encode($result);
    }elseif(isset($_POST['del'])){
        $del = $_POST['del'];
        $msgId = $_POST['msgId'];

        $msg = $handler->prepare("SELECT msg_id as cnt FROM message_sent WHERE msg_id =?");
        $msg->execute(array($msgId));

        if($msg->rowCount()<2) {
            $sql = $handler->prepare("DELETE FROM message_sent WHERE ms_id=?");
            $sql->execute(array($del));

            $sql = $handler->prepare("DELETE FROM message WHERE msg_id=?");
            $sql->execute(array($msgId));
        }else{
            $sql = $handler->prepare("DELETE FROM message_sent WHERE ms_id=?");
            $sql->execute(array($del));
        }

        echo 1;
        
    
    }elseif(isset($_POST['all_msg'])){
        $result ="";
        $sql = $handler->query("SELECT * FROM message ORDER BY msg_id DESC LIMIT 5");

        while($row=$sql->fetch(PDO::FETCH_OBJ)){
            $cnt = $handler->prepare("SELECT COUNT(ms_id) as cnt FROM message_sent WHERE msg_id=?");
            $cnt->execute(array($row->msg_id));

            $cntRow = $cnt->fetch(PDO::FETCH_OBJ);
            $dateCre = date_create($row->msg_indate);
            $date = date_format($dateCre, 'M. d, Y | h:i a');
            $result[] = array(
                'title' => $row->msg_title,
                'desc' => $row->msg_desc,
                'indate' => $date,
                'total' => $cntRow->cnt
            );
        }

        echo json_encode($result);
    }else{
        $result = "";

        $sql = $handler->query("SELECT message_sent.ms_id, message_sent.msg_id, message_sent.ms_status, CONCAT(member.mem_fname,' ', member.mem_lname) as fullname, message.msg_title, message.msg_desc, message.msg_indate 
        FROM member RIGHT JOIN message_sent ON member.mem_id = message_sent.mem_id 
        LEFT JOIN message ON message_sent.msg_id = message.msg_id ORDER BY message_sent.ms_id DESC");

        while ($row = $sql->fetch(PDO::FETCH_OBJ)) {
            $dateCre = date_create($row->msg_indate);
            $date = date_format($dateCre, 'M. d, Y | h:i a');

            $status = $row->ms_status;

            if($status==0){
                $status='<span class="label label-danger">Failed</span>';
            }else{
                $status = '<span class="label label-success">Sent</span>';
            }

            $result[] = array(
                'id' => $row->ms_id,
                'msg_id' => $row->msg_id,
                'fullname' => $row->fullname,
                'title' => $row->msg_title,
                'desc' => $row->msg_desc,
                'indate' => $date,
                'status' => $status
            );
        }

        echo json_encode($result);

    }

function itexmo($number,$message,$apicode){
    $url = 'https://www.itexmo.com/php_api/api.php';
    $itexmo = array('1' => $number, '2' => $message, '3' => $apicode);
    $param = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($itexmo),
        ),
    );
    $context  = stream_context_create($param);
    return file_get_contents($url, false, $context);
}



?>