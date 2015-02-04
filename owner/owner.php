<meta charset="UTF-8"/>
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
$number          = getPOST('tel1').getPOST('tel2').getPOST('tel3');
//携帯電話
$phone_number    = getPOST('fax1').getPOST('fax2').getPOST('fax3');
//郵便番号
$postal_code     = getPOST('zip21').getPOST('zip22');
//住所
$address         = getPOST('pref21').getPOST('addr21').getPOST('strt21');

//データベース接続＆追加
try{
    $dbh = new PDO ( "mysql:host=mysql.miraiserver.com;charset=utf8; dbname=u661551261_wan", "u661551261_wan", "u661551261" );
    print('データベース接続成功');
    $sql = "INSERT INTO `u661551261_wan`.`owner` (`owner_furigana`, `owner_name`, `postal_code`, `home_address`, `home_number`, `phone_number`, `mail_address`)VALUES ('".
    $nameh."','".$name."','".$postal_code."','".$address."','".$number."','".$phone_number."','".$email."');";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    if($stmt){
        print("登録成功");
         $pdo = new PDO ( "mysql:host=mysql.miraiserver.com;charset=utf8; dbname=u661551261_wan", "u661551261_wan", "u661551261" );//DBアクセス
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
         $res = $pdo->query("SELECT * FROM  `owner` WHERE  `owner_name` LIKE  '".$name."' AND  `postal_code` = ".$postal_code);
         $result = $res->fetch(PDO::FETCH_ASSOC);
         //print($result['owner_id']);
         //setcookie ("ownerid", $result['owner_id']);
         $_SESSION["owner_id"] = $result['owner_id'];
         header("Location: ../animal/pet.html");
    }else{
        print("登録失敗");
        header("Location: owner.html");
    }
}catch (PDOException $e){
    print('Connection failed:'.$e->getMessage());
}
?>