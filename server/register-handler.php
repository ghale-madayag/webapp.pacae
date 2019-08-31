<?php
    require_once('handler.php');

    if(isset($_POST['fname'])){
        $sql = $handler->prepare('INSERT INTO member(
            `mem_fname`, 
            `mem_lname`,
            `mem_contact`,
            `mem_email`,
            `mem_pword`,
            `mem_region`,
            `mem_position`,
            `mem_school`,
            `mem_schooladd`,
            `mem_indate`
        ) 
        VALUES(
            :fname,
            :lname,
            :mobile,
            :email,
            :pword,
            :region,
            :position,
            :school,
            :schooladd,
            now()  
        )');    

        $pword = $_POST['pword'];
        $convert = sha1($pword);

        $sql->execute(array(
            'fname' => isset($_POST['fname']) ? $_POST['fname'] : null,
            'lname' => isset($_POST['lname']) ? $_POST['lname'] : null,
            'mobile' => isset($_POST['mobile']) ? $_POST['mobile'] : null,
            'email' => isset($_POST['email']) ? $_POST['email'] : null,
            'pword' => $convert,
            'region' => isset($_POST['region']) ? $_POST['region'] : null,
            'position' => isset($_POST['position']) ? $_POST['position'] : null,
            'school' => isset($_POST['school']) ? $_POST['school'] : null,
            'schooladd' => isset($_POST['schooladd']) ? $_POST['schooladd'] : null
        ));

        echo 1;
    }
?>