<?php
    require_once('handler.php');
    if(isset($_POST['eventId'])){
        $img = basename($_FILES["imgEdit"]["name"]);

        if($img==null){
            $sql = $handler->prepare("UPDATE events SET 
                eve_title = :title,
                eve_desc = :description,
                eve_date = :eveDate,
                eve_location = :location
                WHERE eve_id = :id
            ");

            $sql->execute(array(
                'id' => $_POST['eventId'],
                'title' => isset($_POST['titleEdit']) ? $_POST['titleEdit'] : null,
                'description' => isset($_POST['descEdit']) ? $_POST['descEdit'] : null ,
                'eveDate' => isset($_POST['eveDateEdit']) ? $_POST['eveDateEdit'] : null ,
                'location' => isset($_POST['locationEdit']) ? $_POST['locationEdit'] : null ,
            ));
            echo 1;
        }else{
            $imgRes = uploadImg($_FILES["imgEdit"]);
            if($imgRes==1){
                $sql = $handler->prepare("UPDATE events SET 
                    eve_title = :title,
                    eve_desc = :description,
                    eve_date = :eveDate,
                    eve_location = :location,
                    eve_img = :img
                    WHERE eve_id = :id
                ");

                $sql->execute(array(
                    'id' => $_POST['eventId'],
                    'title' => isset($_POST['titleEdit']) ? $_POST['titleEdit'] : null,
                    'description' => isset($_POST['descEdit']) ? $_POST['descEdit'] : null ,
                    'eveDate' => isset($_POST['eveDateEdit']) ? $_POST['eveDateEdit'] : null ,
                    'location' => isset($_POST['locationEdit']) ? $_POST['locationEdit'] : null ,
                    'img' => basename($_FILES["imgEdit"]["name"])
                ));

                echo 1;
            }else{
                echo $imgRes;
            }
        }
    }elseif(isset($_POST['del'])){
            $eveId = $_POST['del'];
    
            $sql = $handler->prepare("DELETE FROM events WHERE eve_id=?");
            $sql->execute(array($eveId));
    
            echo 1;
        
    }elseif(isset($_POST['get_event'])){
        $sql = $handler->prepare("SELECT * FROM events WHERE eve_id = ?");
        $sql->execute(array($_POST['get_event']));

        $row = $sql->fetch(PDO::FETCH_OBJ);

        $result[] = array(
            'id' => $row->eve_id,
            'title' => $row->eve_title, 
            'desc' => $row->eve_desc, 
            'date' => $row->eve_date, 
            'location' => $row->eve_location
        );

        echo json_encode($result);
    }elseif(isset($_POST['title'])){
        $imgRes = uploadImg($_FILES["img"]);
        
        if($imgRes==1){
            $sql = $handler->prepare("INSERT INTO events(
                `eve_title`,
                `eve_desc`,
                `eve_date`,
                `eve_location`,
                `eve_img`,
                `eve_indate`
            ) 
            VALUES(
                :title,
                :description,
                :eveDate,
                :location,
                :img,
                now()
            )");

            $sql->execute(array(
                'title' => isset($_POST['title']) ? $_POST['title'] : null ,
                'description' => isset($_POST['desc']) ? $_POST['desc'] : null ,
                'eveDate' => isset($_POST['eveDate']) ? $_POST['eveDate'] : null ,
                'location' => isset($_POST['location']) ? $_POST['location'] : null ,
                'img' => basename($_FILES["img"]["name"])
            ));

            echo 1;
        }else{
            echo $imgRes;
        }
    }else{
        $sql = $handler->query("SELECT * FROM events ORDER BY eve_id DESC");
        
        while ($row = $sql->fetch(PDO::FETCH_OBJ)) {

            $att = $handler->prepare("SELECT COUNT(par_id) AS cnt FROM participants WHERE eve_id=?");
            $att->execute(array($row->eve_id));
            $cntRos = $att->fetch(PDO::FETCH_OBJ);
            $attendees = $cntRos->cnt;
            $dateCre = date_create($row->eve_indate);
            $date = date_format($dateCre, 'M. d, Y | h:i a');

            if($attendees>0){
                $attendees='<span class="label label-success">'.$attendees.'</span>';
            }else{
                $attendees = '<span class="label label-danger">'.$attendees.'</span>';
            }
            $result[] = array(
                'id' => $row->eve_id,
                'title' => $row->eve_title,
                'desc' => $row->eve_desc,
                'date' => $row->eve_date,
                'location' => $row->eve_location,
                'indate' => $date,
                'count' => $attendees
            );
        }

        echo json_encode($result);
    }


function uploadImg($imgFile){
    $target_dir = "../img/";
    $target_file = $target_dir . basename($imgFile["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $msg = "";

    $check = getimagesize($imgFile["tmp_name"]);
    if($check !== false) {
        $msg = "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $msg = "File is not an image.";
        $uploadOk = 0;
    }

    if (file_exists($target_file)) {
        $msg = "Sorry, image file already exists.";
        $uploadOk = 0;
    }

    if ($imgFile["size"] > 500000) {
        $msg = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($imgFile["tmp_name"], $target_file)) {
            $msg = 1;
        } else {
            $msg = "Sorry, there was an error uploading your file.";
        }
    }

    return $msg;
}
?>