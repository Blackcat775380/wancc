<?php
	session_start();
//sessin変数確認用
	if(isset($_SESSION["animal_id"])){
		echo("animal_id ".$_SESSION["animal_id"]."<br>\n");
	}
	if(isset($_SESSION["owner_id"])){
		echo("owner_id ".$_SESSION["owner_id"]);
	}
?>