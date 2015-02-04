<?php
	session_start();
	if(isset($_GET['id'])){
		$_SESSION["animal_id"] = $_GET['id'];
		$_SESSION['bloodp'] = 1;//初期のページを1に設定
		$_SESSION['weightp'] = 1;//初期のページを1に設定
		header("Location: main.php#weight");
	}else{
		header("Location: result.html");
	}
?>