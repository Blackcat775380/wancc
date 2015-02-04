<html>
	<head>
	<meta charset="UTF-8"/>
	<!-- 1秒後に移動する場合 -->
	<META http-equiv="refresh" content="1; url=owner_change.html">
	<title>処理中</title>
	<link rel="shortcut icon" href="../assets/pad.png" type="image/png">
	<style>
	#loading{
		position:absolute;
		left:50%;
		top:20%;
		margin-left:-30px;
	}
	</style>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
	<script type="text/javascript">
	<!--
	//コンテンツの非表示
	$(function(){
		$('#contents').css('display', 'none');
	});
	//ページの読み込み完了後に実行
	window.onload = function(){
		$(function() {
			//ページの読み込みが完了したのでアニメーションはフェードアウトさせる
			$("#loading").fadeOut();
			//ページの表示準備が整ったのでコンテンツをフェードインさせる
			$("#contents").fadeIn();
		});
	}
	//-->
	</script>
	</head>
<body>
<?php
session_start();
//post処理メソッド
function getPOST($text){
	if(isset($_POST[$text])){
		return $_POST[$text];
	}else{
		return "null";
	}
}
//飼い主名
$name            = getPOST('name');
//飼い主名ひらがな
$nameh           = getPOST('name2');
//メールアドレス
$email           = getPOST('email');
//ご自宅
$number          = getPOST('tel1');
//携帯電話
$phone_number    = getPOST('fax1');
//郵便番号
$postal_code     = getPOST('zip11');
//住所
$address         = getPOST('addr11');
//データベース接続＆追加
try{
	$dbh = new PDO ( "mysql:host=mysql.miraiserver.com;charset=utf8; dbname=u661551261_wan", "u661551261_wan", "u661551261" );
	//print('データベース接続成功');
	$sql = "UPDATE  `u661551261_wan`.`owner` SET  `owner_furigana` = '".$nameh.
	"', `owner_name`   =  '".$name.
	"', `postal_code`  =  '".$postal_code.
	"', `home_address` =  '".$address.
	"', `home_number`  =  '".$number.
	"', `phone_number` =  '".$phone_number.
	"', `mail_address` =  '".$email.
	"' WHERE  `owner`.`owner_id` =".$_SESSION['owner_id'].";";
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	if($stmt){
		//print("変更成功");
	}else{
		//print("変更失敗");
		header("Location: owner.html");
	}
}catch (PDOException $e){
		print('Connection failed:'.$e->getMessage());
}
?>
<div id="loading"><h1>処理中</h1><br><img src="images/loading.gif"></div>
</body>
</html>