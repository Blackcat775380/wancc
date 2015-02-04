<?php
	session_start();
	if(isset($_GET['id'])){
	$_SESSION["animal_id"] = $_GET['id'];
		header("Location: pet_change.html");
	}else{
		header("Location: pet_select.html");
	}
?>
