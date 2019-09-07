<?php
    require_once('handler.php');

    if(isset($_POST['title'])){
        $title = $_POST['title'];
        $description = $_POST['desc'];
        $txt = $title ."".$description;
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
            $conSql = $handler->prepare("SELECT mem_contact FROM member WHERE mem_id =?");
            $conSql->execute(array($key));
            $row = $conSql->fetch(PDO::FETCH_OBJ);
            $contact = str_replace("-","",$row->mem_contact);
            $contact = str_replace("(63) ","63",$contact);

            message($contact,$txt);
            $sql = $handler->prepare('INSERT INTO message_sent(`msg_id`,`mem_id`,`ms_status`) VALUES(?,?,1)');
            $sql->execute(array($lastInsert, $key));
            $cnt++;
            
        }

        $result[] = array(
            'status' => 1,
            'cnt' => $cnt
        );

        echo json_encode($result);
    }else{
        $result = "";

        $sql = $handler->query("SELECT message_sent.ms_id, message_sent.ms_status, CONCAT(member.mem_fname,' ', member.mem_lname) as fullname, message.msg_title, message.msg_desc, message.msg_indate 
        FROM member LEFT JOIN message_sent ON member.mem_id = message_sent.mem_id 
        LEFT JOIN message ON message_sent.msg_id = message.msg_id");

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
                'fullname' => $row->fullname,
                'title' => $row->msg_title,
                'desc' => $row->msg_desc,
                'indate' => $date,
                'status' => $status
            );
        }

        echo json_encode($result);

    }

function message($to,$txt){
    $basic  = new \Nexmo\Client\Credentials\Basic('b3b13e90', 'PPAoIuSYVKpPG6YR');
    $client = new \Nexmo\Client($basic);

    $message = $client->message()->send([
        'to' => $to,
        'from' => "PACAE",
        'text' => $txt
    ]);
}

?>