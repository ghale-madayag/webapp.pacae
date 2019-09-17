<?php
    require_once('handler.php');

	if (isset($_POST['infoboxPat'])!="") {

		$sql = $handler->query("SELECT COUNT(member.mem_id) as total FROM member WHERE mem_status !=0");
		$r = $sql->fetch(PDO::FETCH_OBJ);

		echo $r->total;
	}elseif(isset($_POST['events'])){
        $sql = $handler->query("SELECT COUNT(eve_id) as total FROM events");
		$r = $sql->fetch(PDO::FETCH_OBJ);

		echo $r->total;
    }elseif(isset($_POST['msg'])){
        $sql = $handler->query("SELECT COUNT(msg_id) as total FROM message");
		$r = $sql->fetch(PDO::FETCH_OBJ);

		echo $r->total;
	}elseif(isset($_POST['api'])){
		echo itexmoStatus();
	}
	
	function itexmoStatus(){
		//$url = 'https://itexmo.com/php_api/serverstatus.php?apicode=TR-ABEGA370289_6W9D7';
		$url = 'https://itexmo.com/php_api/serverstatus.php?apicode=PR-REXI.290432_H88HL';
		return file_get_contents($url);
	}

?>