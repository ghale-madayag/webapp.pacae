<?php
    require_once('handler.php');

    if(isset($_POST['title'])){
        $sql = $handler->prepare("INSERT INTO newprivatelesson_2017(
            `school_id`,
            `privatelessonday`,
            `privatelessontime`,
            `price`,
            `max_student`,
            `orderlist`,
            `created`,
            `modified`
        ) 
        VALUES(
            :school,
            :title,
            :tim,
            88,
            1,
            :list,
            now(),
            now()
        )");

        $sql->execute(array(
            'school' => isset($_POST['school']) ? $_POST['school'] : null,
            'title' => isset($_POST['title']) ? $_POST['title'] : null,
            'tim' => isset($_POST['time']) ? $_POST['time'] : null,
            'list' => isset($_POST['list']) ? $_POST['list'] : null
        ));

        echo 1;
    }else{
        $sql = $handler->query('SELECT * FROM newprivatelesson_2017 WHERE student_id = 0 ORDER BY id DESC');
        while ($row = $sql->fetch(PDO::FETCH_OBJ)) {
            $dateCre = date_create($row->created);
	        $date = date_format($dateCre, 'm/d/Y');
            $result[] = array(
                'id' => $row->id,
                'school_id' => $row->school_id,
                'privatelessonday' => $row->privatelessonday,
                'privatelessontime' => $row->privatelessontime,
                'price' => $row->price,
                'orderlist' => $row->orderlist,
                'created' => $date
            );
        }
        echo json_encode($result);
    }

?>