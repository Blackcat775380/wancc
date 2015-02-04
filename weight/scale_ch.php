<?php
session_start();
if(isset($_POST['num'])&&($_POST['num']>0)&&($_POST['num']<101)){
	$_SESSION['scale_num'] = $_POST['num'];
}
if(isset($_POST['width'])&&($_POST['width']>0)&&($_POST['width']<101)){
	$_SESSION['scale_width'] = $_POST['width'];
}
if(isset($_POST['min'])&&($_POST['min']>0)&&($_POST['min']<101)){
	$_SESSION['scale_min'] = $_POST['min'];
}
header('Location:../main/main.php#weight');
?>