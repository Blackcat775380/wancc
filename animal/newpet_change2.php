<!DOCTYPE html>
<html lang="ja">
<head>
<title>更新結果</title>
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
//ペットid
$id              = getPOST('animal_id');
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
         print("<h1>ペット変更成功</h1><hr><br>");
         print('<h2><a href="newpet.php">ペット変更へ</a></h2><br>');
    }else{
         print("<h1>ペット変更失敗</h1><hr><br>");
         print('<h2><a href="newpet.php">ペット変更へ</a></h2><br>');
    }
}catch (PDOException $e){
    print('Connection failed:'.$e->getMessage());
    print('<h2><a href="newpet.php">ペット変更へ</a></h2><br>');
}
}else{
$url             = $_FILES["upfile"]["tmp_name"];
//データベース接続＆追加
try{
    $dbh = new PDO ( "mysql:host=mysql.miraiserver.com;charset=utf8; dbname=u661551261_wan", "u661551261_wan", "u661551261" );
    //print('データベース接続成功');
    $sql = "UPDATE  `u661551261_wan`.`animal` SET  `animal_name` =  '".$name
."',`animal_type` = '".$type
."',`hair_color` = '".$color
."',`birth` = '".$day
."',`sex` = '".$sex
."',`personality` = '".$personality
."',`animal_number` = '".$number
."',`animal_family` = '".$blood
."',`karte_id` = '".$karute
."',`microchip` = '".$mnumber
."',`image_url` = '".$url
."' WHERE  `animal`.`animal_id` =".$id.";";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    if($stmt){
         print("<h1>ペット変更成功</h1><hr><br>");
         print('<h2><a href="newpet.php?id='.md5($id)."k".$id."k ".'">ペット変更へ</a></h2><br>');
    }else{
         print("<h1>ペット変更失敗</h1><hr><br>");
         print('<h2><a href="newpet.php">ペット変更へ</a></h2><br>');
    }
}catch (PDOException $e){
    print('Connection failed:'.$e->getMessage());
    print('<h2><a href="newpet.php">ペット変更へ</a></h2><br>');
}
}
?>
</div>
</div>
</body>
</html>