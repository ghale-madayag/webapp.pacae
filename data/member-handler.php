<?php
    require_once('handler.php');

    if(isset($_POST['userid'])){
        $sqlCheck = $handler->prepare("SELECT mem_id, mem_email, mem_contact FROM member WHERE mem_email= ? OR mem_contact= ?");
        $sqlCheck->execute(array($_POST['emailEdit'],$_POST['mobileEdit']));
        
        if ($sqlCheck->rowCount()) {
            $rowChk = $sqlCheck->fetch(PDO::FETCH_OBJ);
			if($rowChk->mem_id == $_POST['userid']){
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
                    'fname' => isset($_POST['fnameEdit']) ? $_POST['fnameEdit'] : null,
                    'lname' => isset($_POST['lnameEdit']) ? $_POST['lnameEdit'] : null,
                    'mobile' => isset($_POST['mobileEdit']) ? $_POST['mobileEdit'] : null,
                    'email' => isset($_POST['emailEdit']) ? $_POST['emailEdit'] : null,
                    'region' => isset($_POST['regionEdit']) ? $_POST['regionEdit'] : null,
                    'position' => isset($_POST['positionEdit']) ? $_POST['positionEdit'] : null,
                    'school' => isset($_POST['schoolEdit']) ? $_POST['schoolEdit'] : null,
                    'schooladd' => isset($_POST['schooladdEdit']) ? $_POST['schooladdEdit'] : null
                ));

                echo 1;
            }else{
                echo 0;
            }
        }
    }elseif(isset($_POST['del'])){
        $memId = $_POST['memId'];

        $sql = $handler->prepare("DELETE FROM member WHERE mem_id=?");
        $sql->execute(array($memId));

        echo 1;
    }elseif(isset($_POST['appID'])){
        $memId = $_POST['appID'];

        $sqlCheck = $handler->prepare("SELECT mem_status FROM member WHERE mem_id=?");
        $sqlCheck->execute(array($memId));

        $row = $sqlCheck->fetch(PDO::FETCH_OBJ);

        if($row->mem_status == 1){
            echo 0;
        }else{
            $sql = $handler->prepare("UPDATE member SET mem_status=1 WHERE mem_id=?");
            $sql->execute(array($memId));
            echo 1;
        }

    }elseif(isset($_POST['email'])){
        $fullname = $_POST['fname'];
        $email = $_POST['email'];
        $contact = $_POST['mobile'];
        $to = $email;
        $subject = "PACAE verificaion reminder";
        $pword = randomPassword();

        $sqlCheck = $handler->prepare("SELECT mem_email, mem_contact FROM member WHERE mem_email= ? OR mem_contact= ?");
        $sqlCheck->execute(array($email,$contact));
        
        if ($sqlCheck->rowCount()) {
			echo 0;
		}else{
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
                `mem_status`,
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
                1,
                now()  
            )');  
    
            $sql->execute(array(
                'fname' => isset($_POST['fname']) ? $_POST['fname'] : null,
                'lname' => isset($_POST['lname']) ? $_POST['lname'] : null,
                'mobile' => isset($_POST['mobile']) ? $_POST['mobile'] : null,
                'email' => isset($_POST['email']) ? $_POST['email'] : null,
                'pword' => sha1($pword),
                'region' => isset($_POST['region']) ? $_POST['region'] : null,
                'position' => isset($_POST['position']) ? $_POST['position'] : null,
                'school' => isset($_POST['school']) ? $_POST['school'] : null,
                'schooladd' => isset($_POST['schooladd']) ? $_POST['schooladd'] : null
            ));
    
            // $headers  = 'MIME-Version: 1.0' . "\r\n";
            // $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
            // $message = '<html><body>';
            // $message .= '<h1>ACCOUNT VERIFICATION REMINDER</h1>';
            // $message .= '<p>Dear '.$fullname.'</p>';
            // $message .= '<p>Your email address has been registered to access the PACAE APP. Use the following information to sign in.</p> ';
            // $message .= '<p>Email: '.$email.'</p>';
            // $message .= '<p>Password: <strong>'.$pword.'</strong></p>';
            // $message .= '<br/>';
            // $message .= '<br/>';
            // $message .= '<p>To verify your account, click the button below.</p>';
            // $message .= '<a href="#'.sha1($pword).'" style="background-color: #0b7542;border: 12px solid #0b7542;
            //             border-left: 24px solid #0b7542;
            //             border-right: 24px solid #0b7542;
            //             color: #fff;
            //             display: inline-block;
            //             font-family: Arial,Helvetica,sans-serif;
            //             font-size: 14px;
            //             line-height: 1.3em;
            //             text-align: center;
            //             text-decoration: none;
            //             text-transform: uppercase;">VERIFY ACCOUNT</a>';
            // $message .= '</body></html>';
    
            // if(mail($to, $subject, $message, $headers)){
            //     echo 1;
            // } else{
            //    echo 0;
            // }

            echo 1;
        }
    }elseif(isset($_POST['get_mem'])){
        $sql = $handler->prepare('SELECT * FROM member WHERE mem_id=? ORDER BY mem_id DESC');
        $sql->execute(array($_POST['get_mem']));
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
                'schooladd' => $row->mem_schooladd,
            );
        }
        echo json_encode($result);
    }else{
        $result = "";
        $sql = $handler->query('SELECT * FROM member ORDER BY mem_id DESC');
        while ($row = $sql->fetch(PDO::FETCH_OBJ)) {
            $fullname = ucfirst($row->mem_fname)." ".ucfirst($row->mem_lname);
            $status = $row->mem_status;
            $dateCre = date_create($row->mem_indate);
            $date = date_format($dateCre, 'M. d, Y | h:i a');
            if($status==0){
                $status='<span class="label label-warning">Pending</span>';
            }else{
                $status = '<span class="label label-success">Approved</span>';
            }
            $result[] = array(
                'id' => $row->mem_id,
                'status' => $status,
                'fullname' => $fullname,
                'mobile' => $row->mem_contact,
                'email' => $row->mem_email,
                'region' => $row->mem_region,
                'position' => $row->mem_position,
                'school' => $row->mem_school,
                'schooladd' => $row->mem_schooladd,
                'indate' => $date

            );
        }
        echo json_encode($result);
    }

    function randomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyz0123456789";
        $pass = array(); 
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 6; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

?>