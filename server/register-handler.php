<?php
    require_once('handler.php');

    if(isset($_POST['fname'])){

        
        $sqlCheck = $handler->prepare("SELECT mem_email, mem_contact FROM member WHERE mem_email= ? OR mem_contact= ?");
        $sqlCheck->execute(array($email,$contact));
        
        if ($sqlCheck->rowCount()) {
			echo 0;
		}else{
            $email = $_POST['email'];
            $to = $email;
            $subject = "PACAE VERIFICATION";
            $fullname = $_POST['fname'];
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
                0,
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
    
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
            $message = '<html><body>';
            $message .= '<h1>ACCOUNT VERIFICATION REMINDER</h1>';
            $message .= '<p>Dear '.$fullname.'</p>';
            $message .= '<p>Thank You!<br/><br/>Your registration to PACAE App has been approved. You are now advised to Log-in using your encoded username and password.
            </p> ';
            $message .= '<p>Email: '.$email.'</p>';
            $message .= '<p>Password: <strong>'.$pword.'</strong></p>';
            $message .= '<br/>';
            $message .= '<br/>';
            $message .= '</body></html>';
    
            if(mail($to, $subject, $message, $headers)){
                echo 1;
            } else{
               echo 0;
            }
        }
    }
?>