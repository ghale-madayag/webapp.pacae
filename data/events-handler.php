<?php
    require_once('handler.php');
    require_once('functions.php');


    if(isset($_POST['decline'])){
        $sql = $handler->prepare('UPDATE participants SET par_status=0 WHERE par_id=?');
        $sql->execute(array($_POST['decline']));

        echo 1;
    }else if(isset($_POST['approved'])){

        $memSql = $handler->prepare("SELECT mem_id FROM participants WHERE par_id =?");
        $memSql->execute(array($_POST['approved']));

        $eveSql = $handler->prepare("SELECT eve_id FROM participants WHERE par_id =?");
        $eveSql->execute(array($_POST['approved']));

        $memRow = $memSql->fetch(PDO::FETCH_OBJ);
        $eveRow = $eveSql->fetch(PDO::FETCH_OBJ);

        $conSql = $handler->prepare("SELECT mem_contact FROM member WHERE mem_id =?");
        $conSql->execute(array($memRow->mem_id));

        $titSql = $handler->prepare("SELECT eve_title FROM events WHERE eve_id =?");
        $titSql->execute(array($eveRow->eve_id));
        $rowTit = $titSql->fetch((PDO::FETCH_OBJ));
        $title = $rowTit->eve_title;

        $row = $conSql->fetch(PDO::FETCH_OBJ);
        $contact = str_replace("-","",$row->mem_contact);
        $contact = str_replace("(63) ","63",$contact);

        $txt = 'Congratulations:'.$title.' has been confirmed';
        

        $sql = $handler->prepare('UPDATE participants SET par_status=2 WHERE par_id=?');
        $sql->execute(array($_POST['approved']));

        //itexmo($contact,$txt,'TR-ABEGA370289_6W9D7');
        $results=itexmo($contact,$txt,'PR-REXI.290432_H88HL');

        if ($results == ""){
            $status = 0;
        }else if ($results == 0){
            $status = 1;
        }else{	
            $status = 0;
        }

        echo $results;
    }else if(isset($_POST['getAtt'])){
        $sql = $handler->prepare('SELECT member.mem_id, member.mem_contact, CONCAT(member.mem_fname," ", member.mem_lname) as fullname,participants.par_id, participants.eve_id,participants.par_indate, participants.par_img, participants.par_status FROM member RIGHT JOIN participants ON member.mem_id = participants.mem_id 
        WHERE participants.eve_id = ? AND participants.par_status=1 ORDER BY participants.mem_id DESC');

        $sql->execute(array($_POST['getAtt']));

        while ($row = $sql->fetch(PDO::FETCH_OBJ)) {

            $dateCre = date_create($row->par_indate);
            $date = date_format($dateCre, 'M. d, Y | h:i a');

            $img = '<a href="img/'.$row->par_img.'" data-lightbox="'.$row->par_img.'" data-title="'.$row->par_img.'"><i class="fa fa-image"> <strong>View Image</strong></i></a>';
            
            $result[] = array(
                'id' => $row->par_id,
                'img' => $img,
                'fullname' => $row->fullname,
                'date' => $date,
            );
        }

        echo json_encode($result);
    }else if(isset($_POST['getConf'])){
        $sql = $handler->prepare('SELECT member.mem_id, member.mem_contact,member.mem_email,member.mem_school,member.mem_schooladd,member.mem_position, CONCAT(member.mem_fname," ", member.mem_lname) as fullname,participants.par_id, participants.eve_id,participants.par_indate, participants.par_img, participants.par_status FROM member RIGHT JOIN participants ON member.mem_id = participants.mem_id 
        WHERE participants.eve_id = ? AND participants.par_status=2 ORDER BY participants.mem_id DESC');

        $sql->execute(array($_POST['getConf']));

        while ($row = $sql->fetch(PDO::FETCH_OBJ)) {

            $dateCre = date_create($row->par_indate);
            $date = date_format($dateCre, 'M. d, Y | h:i a');

            $img = '<a href="img/'.$row->par_img.'" data-lightbox="'.$row->par_img.'" data-title="'.$row->par_img.'"><i class="fa fa-image"> <strong>View Image</strong></i></a>';
            
            $result[] = array(
                'id' => $row->par_id,
                'img' => $img,
                'fullname' => $row->fullname,
                'contact' => $row->mem_contact,
                'email' => $row->mem_email,
                'designation' => $row->mem_position,
                'school' => $row->mem_school,
                'schoolAdd' => $row->mem_schooladd,
                'date' => $date,
            );
        }

        echo json_encode($result);

    }elseif(isset($_POST['eventId'])){
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

            $att = $handler->prepare("SELECT COUNT(par_id) AS cnt FROM participants WHERE eve_id=? AND par_status=?");
            $att->execute(array($row->eve_id,1));
            $cntRos = $att->fetch(PDO::FETCH_OBJ);
            $attendees = $cntRos->cnt;

            $conF = $handler->prepare("SELECT COUNT(par_id) AS cnt FROM participants WHERE eve_id=? AND par_status=?");
            $conF->execute(array($row->eve_id,2));
            $conConF = $conF->fetch(PDO::FETCH_OBJ);
            $confirmed = $conConF->cnt;
            $dateCre = date_create($row->eve_indate);
            $date = date_format($dateCre, 'M. d, Y | h:i a');

            $title = "'".$row->eve_title."'";

            if($attendees>0){
                $attendees='<a class="eveLink" onclick="getAtt('.$row->eve_id.', '.$title.');"><span class="label label-success">'.$attendees.'</span></a>';
            }else{
                $attendees = '<span class="label label-danger">'.$attendees.'</span>';
            }

            if($confirmed>0){
                $confirmed='<a class="eveLink" onclick="getConf('.$row->eve_id.', '.$title.');"><span class="label label-success">'.$confirmed.'</span></a>';
            }else{
                $confirmed = '<span class="label label-danger">'.$confirmed.'</span>';
            }
            $result[] = array(
                'id' => $row->eve_id,
                'title' => $row->eve_title,
                'desc' => $row->eve_desc,
                'date' => $row->eve_date,
                'location' => $row->eve_location,
                'indate' => $date,
                'attendees' => $attendees,
                'confirmed' => $confirmed
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