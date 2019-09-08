<?php
    require_once('handler.php');
    
    if(isset($_GET['q'])) {
		$term = $_GET['q'];
		$sql = $handler->prepare('SELECT mem_id, mem_contact, CONCAT(mem_fname," ", mem_lname) as fullname FROM member WHERE mem_contact LIKE "%'.$term.'%" OR mem_fname LIKE "%'.$term.'%" OR mem_lname LIKE "%'.$term.'%" AND mem_status !=0');
        $sql->execute();
    
	}else{
		$sql = $handler->query('SELECT mem_id, mem_contact, CONCAT(mem_fname," ", mem_lname) as fullname FROM member WHERE mem_status !=0 ORDER BY mem_id DESC');
	}


	while ($row=$sql->fetch(PDO::FETCH_OBJ)) {
		$fullname = $row->fullname;
		$result[] = array(
			'id' => $row->mem_id,
			'contact' => $row->mem_contact." | ".$fullname
		);
	}
    echo json_encode($result);

?>