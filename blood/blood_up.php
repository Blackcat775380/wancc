<?php
session_start();
/*ダイアログから遷移。血液表の更新をする。*/
if(isset($_SESSION["animal_id"])){
		$animal_id = $_SESSION["animal_id"];
	}else{
		$animal_id = 1;
	}
$blood = $_GET['blood'];
$date = $_GET['date'];
$num = $_GET['num'];
$blood_id = $_GET['blood_id'];
try{
$pdo = new PDO ( "mysql:host=mysql.miraiserver.com; dbname=u661551261_wan", "u661551261_wan", "u661551261" );
$res = $pdo -> query("SET NAMES utf8;");
$res = $pdo->prepare("UPDATE `u661551261_wan`.`blood_examination`
 SET `".$blood."` = '".$num."' 
 WHERE `blood_examination`.`blood_id` = ".$blood_id." 
 AND `blood_examination`.`animal_id` = ".$animal_id." 
 AND `blood_examination`.`date` = '".$date."';");
 print "UPDATE `u661551261_wan`.`blood_examination`
 SET `".$blood."` = '".$num."' 
 WHERE `blood_examination`.`blood_id` = ".$blood_id." 
 AND `blood_examination`.`animal_id` = ".$animal_id." 
 AND `blood_examination`.`date` = '".$date."';";
$flag = $res->execute();
if ($flag){
        header('Location:../main/main.php#contents02');
    }else{
    	header('Location:inserterr.html');
    }
}
catch ( PDOException $e ) {
	print('Error:'.$e->getMessage());
	print ("接続に失敗しました") ;
}

?>