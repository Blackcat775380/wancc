<?php
	session_start();
	if(isset($_SESSION["animal_id"])){
		$id = $_SESSION["animal_id"];
	}
	//post処理メソッド
	function getPOST($text){
		if(isset($_POST[$text])){
			return $_POST[$text];
		}else{
			return "null";
		}
	}
	//食事
	$dinner     = getPOST('dinner');
	//投薬・処理
	$disposal   = getPOST('disposal');
	//フィラリア
	$prevention = getPOST('prevention');
	//ノミ・ダニ予防
	$flea       = getPOST('flea');
	//混合ワクチン
	$vaccine    = getPOST('vaccine');
	//狂犬病予防注射
	$avaccine   = getPOST('avaccine');
	//既住歴
	$medical_history = getPOST('medical_history');
	//アレルギーの有無
	$allergy         = getPOST('allergy');

	//データベース接続＆追加
	try{
		$dbh = new PDO ( "mysql:host=mysql.miraiserver.com;charset=utf8; dbname=u661551261_wan", "u661551261_wan", "u661551261" );
$sql = "UPDATE  `u661551261_wan`.`animal_detail` SET  `dinner` =  '".$dinner."',`disposal` =  '".$disposal."', `prevention` = '"
.$prevention."', `fleas` =  '".$flea."', `avaccine` =  '".$avaccine."', `medical_history` =  '".$medical_history."', `allergy` =  '"
.$allergy."' WHERE  `animal_detail`.`animal_id` = ".$id.";" ;
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		if($stmt){
			print("登録成功".$id);
			header("Location: ../main/main.php");
		}else{
			print("登録失敗");
		}
	}catch (PDOException $e){
		print('Connection failed:'.$e->getMessage());
	}
?>