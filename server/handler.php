<?php
	try {
		$handler = new PDO('mysql:host=localhost;dbname=pacaeapp_db','root','');
		$handler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo $e->getMessage();
		die();	
	}
?>