<!DOCTYPE html>
<html lang="ja">
<head>
<title>更新結果</title>
<meta charset="UTF-8"/>
</head>
<body>
<div align="center">
<?php
session_start();
//ペットid
if(isset($_SESSION["animal_id"])){
	$id = $_SESSION["animal_id"];
}else{
	header("Location: pet_change.html");
}
//画像アップローダー
$fig = false;
if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
  if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "img/" . $_FILES["upfile"]["name"])) {
    chmod("img/" . $_FILES["upfile"]["name"], 0644);
    echo $_FILES["upfile"]["name"] . "をアップロードしました。<br>";
    $fig = true;
  } else {
    echo "ファイルをアップロードに失敗しました。<br>";
  }
} else {
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
//血液参照のため 科
$blood              = getPOST('ka');
//画像処理ありかなしかで分岐
if(!$fig){
}else{
$url             = $_FILES["upfile"]["tmp_name"];
         print("現在:画像変更に対応していません。<br>");
}
//データベース接続＆追加
try{
    $dbh = new PDO ( "mysql:host=mysql.miraiserver.com;charset=utf8; dbname=u661551261_wan", "u661551261_wan", "u661551261" );
    //print('データベース接続成功');
    $sql = "UPDATE  `u661551261_wan`.`animal` SET  `animal_name` =  '".$name
."',`animal_type` =  '".$type."',`hair_color` =  '".$color."',`birth` =  '".$day
."',`sex` =  '".$sex."',`personality` =  '".$personality."',`animal_number` =  '".$number
."',`animal_family` =  '".$blood."',`karte_id` =  '".$karute."',`microchip` =  '".$mnumber
."' WHERE  `animal`.`animal_id` =".$id.";";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    if($stmt){
         print("ペット変更成功<br>");
         print('<a href="pet_change.html">ペット変更へ</a><br>');
    }else{
         print("ペット変更失敗<br>");
         print('<a href="pet_change.html">ペット変更へ</a><br>');
    }
}catch (PDOException $e){
    print('Connection failed:'.$e->getMessage());
    print('<a href="pet_change.html">ペット変更へ</a><br>');
}
?>
</div>
</body>
</html>