<?php
    require_once('handler.php');

    if(!empty($_POST['email']) && !empty($_POST['pword'])){
        $email = $_POST['email'];
        $pword = $_POST['pword'];
        $enPword = sha1($pword);

        $sqlChk = $handler->prepare("SELECT mem_email, mem_pword FROM member WHERE mem_email= ? AND mem_pword= ?");
        $sqlChk->execute(array($email,$enPword));

        if ($sqlChk->rowCount()) {
            echo 1;
        }else{
            echo 0;   
        }
    }

?>