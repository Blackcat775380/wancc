<?php
session_start();
/*ダイアログから遷移。血液表の更新をする。*/
if(isset($_SESSION["animal_id"])){
		$animal_id = $_SESSION["animal_id"];
	}else{
		$animal_id = 1;
	}
$weight = $_GET['weight'];
$date = $_GET['date'];
$num = $_GET['num'];
$weight_id = $_GET['weight_id'];
try{
$pdo = new PDO ( "mysql:host=mysql.miraiserver.com; dbname=u661551261_wan", "u661551261_wan", "u661551261" );
$res = $pdo -> query("SET NAMES utf8;");
$res = $pdo->prepare("UPDATE `u661551261_wan`.`animal_weight`
 SET `".$weight."` = '".$num."' 
 WHERE `animal_weight`.`animal_id` = ".$animal_id." 
 AND `animal_weight`.`date` = '".$date."' 
 AND `animal_weight`.`weight_id` = ".$weight_id.";");
 echo "UPDATE `u661551261_wan`.`animal_weight`
 SET `".$weight."` = '".$num."' 
 WHERE `animal_weight`.`animal_id` = ".$animal_id." 
 AND `animal_weight`.`date` = '".$date."' 
 AND `animal_weight`.`weight_id` = ".$weight_id.";";
$flag = $res->execute();
if ($flag){
        header('Location:../main/main.php#weight');
    }else{
    	header('Location:inserterr.html');
    }
}
catch ( PDOException $e ) {
	print('Error:'.$e->getMessage());
	print ("接続に失敗しました") ;
}

?>