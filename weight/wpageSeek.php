<?php
session_start();
if(isset($_POST['op'])){
	$_SESSION['weightp'] = 1;
}
if(isset($_POST['next'])){
	$_SESSION['weightp']++;
}
if(isset($_POST['pre'])){
	$_SESSION['weightp']--;
}
if(isset($_POST['end'])){
	$_SESSION['weightp'] = $_SESSION['maxweightp'];
	//print("最後");
}
header('Location:../main/main.php#weight');
?>