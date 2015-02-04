<?php
session_start();
if(isset($_SESSION["animal_id"])){
		$animal_id = $_SESSION["animal_id"];
	}else{
		$animal_id = 1;
	}
$date = "-9999";
$BW = "-9999";
$BCS = "-9999";
if (isset($_POST['date']) && $_POST['date'] != "") {
	$date = $_POST['date'];
}else{
	//print("ナイヨー1");
}
if (isset($_POST['BW']) && $_POST['BW'] != "") {
	$BW = $_POST['BW'];
}else{
	//print("ナイヨー2");
}
if (isset($_POST['BCS']) && $_POST['BCS'] != "") {
	$BCS = $_POST['BCS'];
}else{
	//print("ナイヨー3");
}
if (isset($_POST['after']) && $_POST['after'] != "") {
	$after = $_POST['after'];
}else{
	//print("ナイヨー3");
}
try{
$pdo = new PDO ( "mysql:host=mysql.miraiserver.com; dbname=u661551261_wan", "u661551261_wan", "u661551261" );
//$pdo->query('SET NAMES utf-8');
/*if ($pdo == null){
        //print('接続に失敗しました。<br>');
    }else{
        //print('接続に成功しました。<br>');
    }*/
$res = $pdo -> query("SET NAMES utf8;");
$res = $pdo->prepare("INSERT INTO `u661551261_wan`.`animal_weight` 
(`animal_id`, `date`, `weight_id`, `bw`, `bcs`, `after`) 
VALUES ('".$animal_id."', '".$date."', NULL, '".$BW."', '".$BCS."', '".$after."');");





/*print("insert into `u661551261_wan`.`blood_examination` 
(`animal_id`, `date`, `WBC`, `RBC`, `Hb`, `PCV`, `MCV`, `MCH`, `MCHC`, `PLT`, `II`, `Ht`, `GLU`, `BUN`, `CRE`, `UN/CR`, `IP`, `Ca`, `TP`, `ALB`, `ALT/GPT`, `AST/GOT`, `ALP`, `TBIL`, `TCHO`, `GGT`
, `NH3`, `CPK`, `LIP`, `AMYL`, `LDH`, `TG`, `Na`, `K`, `Cl`, `other`) 
VALUES ('".$animal_id."', '".$date."', '".$WBC."', '".$RBC."', '".$Hb."', '".$PCV."', '".$MCV."', '".$MCH."', '".$MCHC."', '".$PLT."', '".$II."', '".$Ht."', '".$GLU."', '".$BUN."', '".$CRE."', 
'".$UN_CR."', '".$IP."', '".$Ca."', '".$TP."', '".$ALB."', '".$ALT_GPT."', '".$AST_GOT."', '".$ALP."', '".$TBIL."', '".$TCHO."', '".$GGT."', '".$NH3."', '".$CPK."', '".$LIP."', '".$AMYL."', '".$LDH."', '".$TG."', '".$Na."',
'".$K."', '".$Cl."', '".$other."');");*/
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