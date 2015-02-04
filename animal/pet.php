<html>
	<head>
	<meta charset="UTF-8"/>
	<title>登録結果</title>
	<link rel="shortcut icon" href="../assets/pad.png" type="image/png">
	<style type="text/css">
		<!--
		body{
		background-image: url("../assets/02.jpg");
		background-repeat: repeat;
		font-family: "Lucida Grande", "segoe UI", "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", Meiryo, Verdana, Arial, sans-serif;
		//font-family: "Lucida Grande", "segoe UI", "ヒラギノ丸ゴ ProN W4", "Hiragino Maru Gothic ProN", Meiryo, Arial, sans-serif;
		//font-size:0.9em
			margin:0px;          /* ページ全体のmargin */
			padding:0px;         /* ページ全体のpadding */
			text-align:center;   /* 下記のautoに未対応用のセンタリング */
		}
		#main{
			margin-left:auto;    /* 左側マージンを自動的に空ける */
			margin-right:auto;   /* 右側マージンを自動的に空ける */
			text-align:left;     /* 中身を左側表示に戻す */
			width:650px;         /* 幅を決定する */
		}
		-->
	</style>
	</head>
<body>
<?php
session_start();
//表示用変数
$html ="";
//飼い主id
if(isset($_SESSION['owner_id'])){
	$id = $_SESSION['owner_id'];
}else{
	//header("Location: index.html");
}
//画像成功フラグ
$fig = false;
//画像アップローダー
	if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
		if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "img/" . $_FILES["upfile"]["name"])) {
			chmod("img/" . $_FILES["upfile"]["name"], 0644);
			$imgfig = "※画像をアップロードしました。<br>\n";
			$imgfig = $imgfig."画像名：". $_FILES["upfile"]["name"];
			$fig = true;
		} else {
			$imgfig = "※画像をアップロードに失敗しました。";
		}
	} else {
		$imgfig = "※画像が追加されませんでした。";
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
		$results = "ペット登録成功";
		$pdo = new PDO ( "mysql:host=mysql.miraiserver.com;charset=utf8; dbname=u661551261_wan", "u661551261_wan", "u661551261" );//DBアクセス
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$res = $pdo->query("SELECT * FROM  `animal` WHERE  `animal_name` LIKE  '".$name."' AND  `owner_id` = ".$id." ;");
		$result = $res->fetch(PDO::FETCH_ASSOC);
		//setcookie ("animalid", $result['animal_id']);
		$_SESSION['animal_id'] = $result['animal_id'];
		$html = $html."<br>animal_id:".$result['animal_id']."<br>";
		
		$res = $pdo->query("SELECT * FROM `u661551261_wan`.`animal_detail` WHERE  `animal_id` = ".$result['animal_id']." ;");
		//$html = $html."<br>件数：".$res->rowCount()."<br>";
		if($res->rowCount() == 0){
				$res = $pdo->prepare("INSERT INTO `u661551261_wan`.`animal_detail` (`animal_id`, `dinner`, `disposal`, `prevention`, `fleas`, `avaccine`, `medical_history`, `allergy`) VALUES ('".$result['animal_id']."', NULL, NULL, NULL, NULL, NULL, NULL, NULL);");
				$res->execute();
		}else{
				$html = $html."<br>その処理は実行中です。<br>\n";
		}
		$html = $html. '<br><a href="../top.html">メニュー画面へ</a>';
		$html = $html. '<br><a href="newpet.php">ペット追加へ</a><br>';
		$html = $html. '<a href="detailed_information.html">詳細登録画面へ</a><br>';
		$html = $html. '<a href="../main/main.php">体重・血液登録画面へ</a><br>';
	}else{
		$results = "ペット登録失敗";
		$html = $html.'<a href="index.html">メニュー画面へ</a><br>';
	}
}catch (PDOException $e){
	//$html = $html. 'Connection failed:'.$e->getMessage();
	$html = $html. '<a href="index.html">メニュー画面へ</a><br>';
}
?>
<div id="main" class="main" style="background-color:#EDF7FF;">
<div>
<font size="6"><?php echo $results ?></font><br>
<font size="5"><?php echo $imgfig ?></font><br>
<font size="6">
<?php echo $html ?>
</font>
</div>
</div>
</body>
</html>