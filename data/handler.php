<?php
	try {
		$handler = new PDO('mysql:host=communicationinaction.net:3306;dbname=db_ciapayments','ciamysql','ciaMysqluser123');
		$handler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo $e->getMessage();
		die();	
	}
?>