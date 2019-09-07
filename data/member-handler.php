<?php
    require_once('handler.php');

    if(isset($_POST['fname'])){
        $fullname = $_POST['fname'];
        $email = $_POST['email'];
        $to = $email;
        $subject = "PACAE User Information";
        $pword = randomPassword();
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
            2,
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

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        $message = '<html><body>';
        $message .= '<h1>ACCOUNT VERIFICATION REMINDER</h1>';
        $message .= '<p>Dear '.$fullname.'</p>';
        $message .= '<p>Your email address has been registered to access the PACAE APP. Use the following information to sign in.</p> ';
        $message .= '<p>Email: '.$email.'</p>';
        $message .= '<p>Password: <strong>'.$pword.'</strong></p>';
        $message .= '<br/>';
        $message .= '<br/>';
        $message .= '<p>To verify your account, click the button below.</p>';
        $message .= '<a href="#'.sha1($pword).'" style="background-color: #4980B5;border: 12px solid #4980B5;
                    border-left: 24px solid #4980B5;
                    border-right: 24px solid #4980B5;
                    color: #fff;
                    display: inline-block;
                    font-family: Arial,Helvetica,sans-serif;
                    font-size: 14px;
                    line-height: 1.3em;
                    text-align: center;
                    text-decoration: none;
                    text-transform: uppercase;">VERIFY ACCOUNT</a>';
        $message .= '</body></html>';

        if(mail($to, $subject, $message, $headers)){
            echo 1;
        } else{
           echo 0;
        }
    }else{
        $sql = $handler->query('SELECT * FROM member');
        while ($row = $sql->fetch(PDO::FETCH_OBJ)) {
            $fullname = ucfirst($row->mem_fname)." ".ucfirst($row->mem_lname);
            $status = $row->mem_status;

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
                'indate' => $row->mem_indate

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