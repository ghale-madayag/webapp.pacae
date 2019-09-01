<?php
    require_once('handler.php');

    if(!empty($_POST['email']) && !empty($_POST['pword'])){
        $email = $_POST['email'];
        $pword = $_POST['pword'];
        $enPword = sha1($pword);

        $sqlChk = $handler->prepare("SELECT mem_id,mem_email, mem_pword FROM member WHERE mem_email= ? AND mem_pword= ?");
        $sqlChk->execute(array($email,$enPword));

        if ($sqlChk->rowCount()) {
            $row = $sqlChk->fetch(PDO::FETCH_OBJ);
            $result[] = array(
                'id' => $row->mem_id,
                'status' => 1
            );

            echo json_encode($result);
        }else{
            echo 0;   
        }
    }

?>