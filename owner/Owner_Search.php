<?php
	session_start();
	if(isset($_GET['id'])){
	$_SESSION["owner_id"] = $_GET['id'];
		header("Location: owner_change.html");
	}else{
		header("Location: Owner_Search.html");
	}
?>
