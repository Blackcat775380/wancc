<?php
session_start();
if(isset($_POST['op'])){
	$_SESSION['bloodp'] = 1;
}
if(isset($_POST['next'])){
	$_SESSION['bloodp']++;
}
if(isset($_POST['pre'])){
	$_SESSION['bloodp']--;
}
if(isset($_POST['end'])){
	$_SESSION['bloodp'] = $_SESSION['maxbloodp'];
	//print("最後");
}
header('Location:../main/main.php#contents02');
?>