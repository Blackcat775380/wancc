<?php
	session_start();
	if(isset($_GET['id'])){
	$_SESSION["owner_id"] = $_GET['id'];
		header("Location: newpet.php");
	}else{
		header("Location: Owner_Search.html");
	}
?>
