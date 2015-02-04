<!DOCTYPE html>
<html lang="ja">
<head>
<title>登録結果</title>
<meta charset="UTF-8"/>
<style type="text/css">
<!--
.main {  
    width: 100%;  
    border: 1px #000;  
}  
.main div   {  
    width: 80%;  
    border: 1px #FF0000;  
    margin: 0 auto;  
}
body {
		background-image: url("../assets/02.jpg");
		background-repeat: repeat;
		font-family: "Lucida Grande", "segoe UI", "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", Meiryo, Verdana, Arial, sans-serif;
		//font-family: "Lucida Grande", "segoe UI", "ヒラギノ丸ゴ ProN W4", "Hiragino Maru Gothic ProN", Meiryo, Arial, sans-serif;
		//font-size:0.9em
}
//-->
</style>
</head>
<body>
<div class="main" style="background-color:#EDF7FF;">
<div>
<?php
session_start();
//飼い主id
if(isset($_SESSION['owner_id'])){
    $id = $_SESSION['owner_id'];
}else{
    //header("Location: index.html");
}
$echoimg="";
//画像アップローダー
$fig = false;
if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
  if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "img/" . $_FILES["upfile"]["name"])) {
    chmod("img/" . $_FILES["upfile"]["name"], 0644);
    $echoimg = $_FILES["upfile"]["name"] . "をアップロードしました。";
    $fig = true;
  } else {
    $echoimg = "写真をアップロードできません。";
  }
} else {
  $echoimg = "写真が設定されていません。";
}
//post処理メソッド
function getPOST($text){
    if(isset($_POST[$text])){
        return $_POST[$text];
    }else{
        return "null";
    }
}
//カルテNo
$karute          = getPOST('karute');
//動物の名前
$name            = getPOST('name');
//登録No
$number          = getPOST('number');
//マイクロチップ
$mnumber         = getPOST('mnumber');
//種類
$type            = getPOST('type');
//毛色
$color           = getPOST('color');
//生年月日
$day             = getPOST('date');
//性別
$sex             = getPOST('sex');
//性格
$personality     = getPOST('personality');
//画像
if(!$fig){
$url             = "";
}else{
$url             = $_FILES["upfile"]["name"];
}
//科
$ka              = getPOST('ka');
//データベース接続＆追加
try{
    $dbh = new PDO ( "mysql:host=mysql.miraiserver.com;charset=utf8; dbname=u661551261_wan", "u661551261_wan", "u661551261" );
    //print('データベース接続成功');
    $sql = "INSERT INTO `u661551261_wan`.`animal` (`animal_id`, `animal_name`, `owner_id`, `animal_type`, `hair_color`, `birth`, `sex`, `personality`, `image_url`, `animal_number`, `animal_family`, `karte_id`, `microchip`) VALUES (NULL, '"
    .$name."' , '".$id."' , '".$type."' , '".$color."' , '".$day."' , '".$sex."' , '".$personality."' , '".$url."' , '".$number."' , '".$ka."' , '".$karute."' , '".$mnumber."');";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    if($stmt){
         print("<h1>ペット登録成功</h1><hr>");
         $pdo = new PDO ( "mysql:host=mysql.miraiserver.com;charset=utf8; dbname=u661551261_wan", "u661551261_wan", "u661551261" );//DBアクセス
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
         $res = $pdo->query("SELECT * FROM  `animal` WHERE  `animal_name` LIKE  '".$name."' AND  `owner_id` = ".$id." ;");
         $result = $res->fetch(PDO::FETCH_ASSOC);
         //setcookie ("animalid", $result['animal_id']);
         $_SESSION['animal_id'] = $result['animal_id'];
         if($result){
            $res = $pdo->prepare("INSERT INTO `u661551261_wan`.`animal_detail` (`animal_id`, `dinner`, `disposal`, `prevention`, `fleas`, `avaccine`, `medical_history`, `allergy`) VALUES ('"
            .$result['animal_id']."', NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
            $res->execute();
         }
		print('※：'.$echoimg);
		print('<br><h2><a href="newpet.php">戻る</a></h2><br>');
		print('<br><h2><a href="../top.html">メニュー画面へ</a></h2><br>');
		print('<h2><a href="detailed_information.html">詳細登録画面へ</a></h2><br>');
		print('<h2><a href="../main/main.php">体重・血液登録画面へ</a></h2><br>');
	}else{
		print("<h1>ペット登録失敗</h1><hr>");
		print('<h2><a href="index.html">メニュー画面へ</a></h2><br>');
	}
}catch (PDOException $e){
	print('Connection failed:'.$e->getMessage());
	print('<h2><a href="index.html">メニュー画面へ</a></h2><br>');
}
?>
</div>
</div>
</body>
</html>