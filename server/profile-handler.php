<?php
    require_once('handler.php');

    if(isset($_POST['get_id'])){
        $id = $_POST['get_id'];

        $sql = $handler->prepare("SELET * FROM member WHERE mem_id = ?");
        $sql->execute(array($id));
        
        while ($row = $sql->fetch(PDO::FETCH_OBJ)) {
            $result[] = array(
                'id' => $row->mem_id 
            );
        }
    }

?>