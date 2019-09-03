<?php
    require_once('handler.php');

    if(isset($_POST['get_id'])){
        $id = $_POST['get_id'];

        $sql = $handler->prepare("SELECT * FROM member WHERE mem_id = ?");
        $sql->execute(array($id));

        while ($row = $sql->fetch(PDO::FETCH_OBJ)) {
            $result[] = array(
                'id' => $row->mem_id,
                'fname' => $row->mem_fname,
                'lname' => $row->mem_lname,
                'mobile' => $row->mem_contact,
                'email' => $row->mem_email,
                'region' => $row->mem_region,
                'position' => $row->mem_position,
                'school' => $row->mem_school,
                'schooladd' => $row->mem_schooladd

            );
        }

        echo json_encode($result);
    }else if (isset($_POST['userid'])) {
        $sql = $handler->prepare("UPDATE member SET 
            mem_fname=:fname,
            mem_lname=:lname,
            mem_contact=:mobile,
            mem_email=:email,
            mem_region=:region,
            mem_position=:position,
            mem_school=:school,
            mem_schooladd=:schooladd 
            WHERE mem_id = :id
        ");

        $sql->execute(array(
            'id' => $_POST['userid'],
            'fname' => isset($_POST['fname']) ? $_POST['fname'] : null,
            'lname' => isset($_POST['lname']) ? $_POST['lname'] : null,
            'mobile' => isset($_POST['mobile']) ? $_POST['mobile'] : null,
            'email' => isset($_POST['email']) ? $_POST['email'] : null,
            'region' => isset($_POST['region']) ? $_POST['region'] : null,
            'position' => isset($_POST['position']) ? $_POST['position'] : null,
            'school' => isset($_POST['school']) ? $_POST['school'] : null,
            'schooladd' => isset($_POST['schooladd']) ? $_POST['schooladd'] : null
        ));

        echo 1;
    }else if(isset($_POST['pid'])){
        $pword = $_POST['pword'];
        $npword = $_POST['npword'];
        $cpword = $_POST['cpword'];

        $sql = $handler->prepare("SELECT mem_id FROM member WHERE mem_id = ? AND mem_pword = ?");
        $sql->execute(array($_POST['pid'],sha1($pword)));

        if($npword!=$cpword){
            echo 3;
        }else{
            if ($sql->rowCount()) {
                $sql = $handler->prepare("UPDATE member SET 
                mem_pword=:pword
                WHERE mem_id = :id
            ");
    
            $sql->execute(array(
                'id' => $_POST['pid'],
                'pword' => sha1($pword)
            ));
                echo 1;
            }else{
                echo 2;
            }
        }
    }

?>