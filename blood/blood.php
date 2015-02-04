<?php
session_start();
$animal_id = $_SESSION["animal_id"];
$date = "-9999";
$WBC = "-9999";
$RBC = "-9999";
$Hb = "-9999";
$PCV = "-9999";
$MCV = "-9999";
$MCH = "-9999";
$MCHC = "-9999";
$PLT = "-9999";
$II = "-9999";
$Ht = "-9999";

$GLU = "-9999";
$BUN = "-9999";
$CRE = "-9999";
$UN_CR = "-9999";
$IP = "-9999";
$Ca = "-9999";
$TP = "-9999";
$ALB = "-9999";
$ALT_GPT = "-9999";
$AST_GOT = "-9999";

$ALP = "-9999";
$TBIL = "-9999";
$TCHO = "-9999";
$GGT = "-9999";
$NH3 = "-9999";
$CPK = "-9999";
$LIP = "-9999";
$AMYL = "-9999";
$LDH = "-9999";
$TG = "-9999";

$Na = "-9999";
$K = "-9999";
$Cl = "-9999";
$other = "";
if (isset($_POST['date']) && $_POST['date'] != "") {
	$date = $_POST['date'];
}else{
	//print("ナイヨー1");
}
if (isset($_POST['WBC']) && $_POST['WBC'] != "") {
	$WBC = $_POST['WBC'];
}else{
	//print("ナイヨー2");
}
if (isset($_POST['RBC']) && $_POST['RBC'] != "") {
	$RBC = $_POST['RBC'];
}else{
	//print("ナイヨー3");
}
if (isset($_POST['Hb']) && $_POST['Hb'] != "") {
	$Hb = $_POST['Hb'];
}else{
	//print("ナイヨー4");
}
if (isset($_POST['PCV']) && $_POST['PCV'] != "") {
	$PCV = $_POST['PCV'];
}else{
	//print("ナイヨー5");
}
if (isset($_POST['MCV']) && $_POST['MCV'] != "") {
	$MCV = $_POST['MCV'];
}else{
	//print("ナイヨー6");
}
if (isset($_POST['MCH']) && $_POST['MCH'] != "") {
	$MCH = $_POST['MCH'];
}else{
	//print("ナイヨー7");
}
if (isset($_POST['MCHC']) && $_POST['MCHC'] != "") {
	$MCHC = $_POST['MCHC'];
}else{
	//print("ナイヨー8");
}
if (isset($_POST['PLT']) && $_POST['PLT'] != "") {
	$PLT = $_POST['PLT'];
}else{
	//print("ナイヨー9");
}
if (isset($_POST['II']) && $_POST['II'] != "") {
	$II = $_POST['II'];
}else{
	//print("ナイヨー10");
}
if (isset($_POST['Ht']) && $_POST['Ht'] != "") {
	$Ht = $_POST['Ht'];
}else{
	//print("ナイヨー");
}
if (isset($_POST['GLU']) && $_POST['GLU'] != "") {
	$GLU = $_POST['GLU'];
}else{
	//print("ナイヨー");
}
if (isset($_POST['BUN']) && $_POST['BUN'] != "") {
	$BUN = $_POST['BUN'];
}else{
	//print("ナイヨー");
}
if (isset($_POST['CRE']) && $_POST['CRE'] != "") {
	$CRE = $_POST['CRE'];
}else{
	//print("ナイヨー");
}
if (isset($_POST['UN/CR']) && $_POST['UN/CR'] != "") {
	$UN_CR = $_POST['UN/CR'];
}else{
	//print("ナイヨー");
}
if (isset($_POST['IP']) && $_POST['IP'] != "") {
	$IP = $_POST['IP'];
}else{
	//print("ナイヨー");
}
if (isset($_POST['Ca']) && $_POST['Ca'] != "") {
	$Ca = $_POST['Ca'];
}else{
	//print("ナイヨー");
}
if (isset($_POST['TP']) && $_POST['TP'] != "") {
	$TP = $_POST['TP'];
}else{
	//print("ナイヨー");
}
if (isset($_POST['ALB']) && $_POST['ALB'] != "") {
	$ALB = $_POST['ALB'];
}else{
	//print("ナイヨー");
}
if (isset($_POST['ALT/GPT']) && $_POST['ALT/GPT'] != "") {
	$ALT_GPT = $_POST['ALT/GPT'];
}else{
	//print("ナイヨー");
}
if (isset($_POST['AST/GOT']) && $_POST['AST/GOT'] != "") {
	$AST_GOT = $_POST['AST/GOT'];
}else{
	//print("ナイヨー");
}
if (isset($_POST['ALP']) && $_POST['ALP'] != "") {
	$ALP = $_POST['ALP'];
}else{
	//print("ナイヨー");
}
if (isset($_POST['TBIL']) && $_POST['TBIL'] != "") {
	$TBIL = $_POST['TBIL'];
}else{
	//print("ナイヨー");
}
if (isset($_POST['TCHO']) && $_POST['TCHO'] != "") {
	$TCHO = $_POST['TCHO'];
}else{
	//print("ナイヨー");
}
if (isset($_POST['GGT']) && $_POST['GGT'] != "") {
	$GGT = $_POST['GGT'];
}else{
	//print("ナイヨー");
}
if (isset($_POST['NH3']) && $_POST['NH3'] != "") {
	$NH3 = $_POST['NH3'];
}else{
	//print("ナイヨー");
}
if (isset($_POST['CPK']) && $_POST['CPK'] != "") {
	$CPK = $_POST['CPK'];
}else{
	//print("ナイヨー");
}
if (isset($_POST['LIP']) && $_POST['LIP'] != "") {
	$LIP = $_POST['LIP'];
}else{
	//print("ナイヨー");
}
if (isset($_POST['AMYL']) && $_POST['AMYL'] != "") {
	$AMYL = $_POST['AMYL'];
}else{
	//print("ナイヨー");
}
if (isset($_POST['LDH']) && $_POST['LDH'] != "") {
	$LDH = $_POST['LDH'];
}else{
	//print("ナイヨー");
}
if (isset($_POST['TG']) && $_POST['TG'] != "") {
	$TG = $_POST['TG'];
}else{
	//print("ナイヨー");
}
if (isset($_POST['Na']) && $_POST['Na'] != "") {
	$Na = $_POST['Na'];
}else{
	//print("ナイヨー");
}
if (isset($_POST['K']) && $_POST['K'] != "") {
	$K = $_POST['K'];
}else{
	//print("ナイヨー");
}
if (isset($_POST['Cl']) && $_POST['Cl'] != "") {
	$Cl = $_POST['Cl'];
}else{
	//print("ナイヨー");
}
if (isset($_POST['other'])) {
	$other = $_POST['other'];
}else{
	//print("ナイヨー");
}
try{
$pdo = new PDO ( "mysql:host=mysql.miraiserver.com; dbname=u661551261_wan", "u661551261_wan", "u661551261" );
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$pdo->query('SET NAMES utf8;');
/*if ($pdo == null){
        print('接続に失敗しました。<br>');
    }else{
        print('接続に成功しました。<br>');
    }*/
$res = $pdo -> query("SET NAMES utf8;");
$res = $pdo->prepare("insert into `u661551261_wan`.`blood_examination` 
(`animal_id`, `date`, `WBC`, `RBC`, `Hb`, `PCV`, `MCV`, `MCH`, `MCHC`, `PLT`, `II`, `Ht`, `GLU`, `BUN`, `CRE`, `UN/CR`, `IP`, `Ca`, `TP`, `ALB`, `ALT/GPT`, `AST/GOT`, `ALP`, `TBIL`, `TCHO`, `GGT`
, `NH3`, `CPK`, `LIP`, `AMYL`, `LDH`, `TG`, `Na`, `K`, `Cl`, `other`) 
VALUES ('".$animal_id."', '".$date."', '".$WBC."', '".$RBC."', '".$Hb."', '".$PCV."', '".$MCV."', '".$MCH."', '".$MCHC."', '".$PLT."', '".$II."', '".$Ht."', '".$GLU."', '".$BUN."', '".$CRE."', 
'".$UN_CR."', '".$IP."', '".$Ca."', '".$TP."', '".$ALB."', '".$ALT_GPT."', '".$AST_GOT."', '".$ALP."', '".$TBIL."', '".$TCHO."', '".$GGT."', '".$NH3."', '".$CPK."', '".$LIP."', '".$AMYL."', '".$LDH."', '".$TG."', '".$Na."',
'".$K."', '".$Cl."', '".$other."');");





print("insert into `u661551261_wan`.`blood_examination` 
(`animal_id`, `date`, `WBC`, `RBC`, `Hb`, `PCV`, `MCV`, `MCH`, `MCHC`, `PLT`, `II`, `Ht`, `GLU`, `BUN`, `CRE`, `UN/CR`, `IP`, `Ca`, `TP`, `ALB`, `ALT/GPT`, `AST/GOT`, `ALP`, `TBIL`, `TCHO`, `GGT`
, `NH3`, `CPK`, `LIP`, `AMYL`, `LDH`, `TG`, `Na`, `K`, `Cl`, `other`) 
VALUES ('".$animal_id."', '".$date."', '".$WBC."', '".$RBC."', '".$Hb."', '".$PCV."', '".$MCV."', '".$MCH."', '".$MCHC."', '".$PLT."', '".$II."', '".$Ht."', '".$GLU."', '".$BUN."', '".$CRE."', 
'".$UN_CR."', '".$IP."', '".$Ca."', '".$TP."', '".$ALB."', '".$ALT_GPT."', '".$AST_GOT."', '".$ALP."', '".$TBIL."', '".$TCHO."', '".$GGT."', '".$NH3."', '".$CPK."', '".$LIP."', '".$AMYL."', '".$LDH."', '".$TG."', '".$Na."',
'".$K."', '".$Cl."', '".$other."');");
$flag = $res->execute();
if ($flag){
        header('Location:../main/main.php#contents02');
    }else{
    	header('Location:inserterr.html');
    }
}
catch ( PDOException $e ) {
	//print('Error:'.$e->getMessage());
	//print ("接続に失敗しました") ;
}

?>