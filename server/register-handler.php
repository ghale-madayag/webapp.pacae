<?php
    require_once('handler.php');

    if(isset($_POST['fname'])){
        $sql = $handler->prepare('INSERT INTO member(
            `mem_fname`, 
            `mem_lname`,
            `mem_indate`
        ) 
        VALUES(
            :fname,
            :lname,
            now()  
        )');    

        $sql->execute(array(
            'fname' => isset($_POST['fname']) ? $_POST['fname'] : null,
            'lname' => isset($_POST['lname']) ? $_POST['lname'] : null
        ));

        echo 1;
    }
?>