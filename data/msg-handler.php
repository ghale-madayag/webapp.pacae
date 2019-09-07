<?php
    require_once('handler.php');
    //require_once "../vendor/autoload.php";
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
            $conSql = $handler->prepare("SELECT mem_contact FROM member WHERE mem_id =?");
            $conSql->execute(array($key));
            $row = $conSql->fetch(PDO::FETCH_OBJ);
            $contact = str_replace("-","",$row->mem_contact);
            $contact = str_replace("(63) ","63",$contact);

            $results=itexmo($contact,$txt,'TR-ABEGA370289_6W9D7');

            if ($results == ""){
                echo "iTexMo: No response from server!!!
                Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.	
                Please CONTACT US for help. ";	
            }else if ($results == 0){
                $sql = $handler->prepare('INSERT INTO message_sent(`msg_id`,`mem_id`,`ms_status`) VALUES(?,?,1)');
                $sql->execute(array($lastInsert, $key));
                $cnt++;
                echo "Message Sent!";
            }else{	
                echo "Error Num ". $results . " was encountered!";
            }
            
            
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

    // $basic  = new \Nexmo\Client\Credentials\Basic('b3b13e90', 'PPAoIuSYVKpPG6YR');
    // $client = new \Nexmo\Client($basic);

    // $message = $client->message()->send([
    //     'to' => $to,
    //     'from' => "PACAE",
    //     'text' => $txt
    // ]);
}

// function itexmo($number,$message,$apicode){
//     $ch = curl_init();
//     $itexmo = array('1' => $number, '2' => $message, '3' => $apicode);
//     curl_setopt($ch, CURLOPT_URL,"https://www.itexmo.com/php_api/api.php");
//     curl_setopt($ch, CURLOPT_POST, 1);
//      curl_setopt($ch, CURLOPT_POSTFIELDS, 
//               http_build_query($itexmo));
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     return curl_exec ($ch);
//     curl_close ($ch);
// }

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
    return file_get_contents($url, false, $context);}

?>