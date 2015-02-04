<?php
session_start();
mb_language('Japanese');
ini_set('mbstring.detect_order', 'auto');
ini_set('mbstring.http_input'  , 'auto');
ini_set('mbstring.http_output' , 'pass');
ini_set('mbstring.internal_encoding', 'UTF-8');
ini_set('mbstring.script_encoding'  , 'UTF-8');
ini_set('mbstring.substitute_character', 'none');
mb_regex_encoding('UTF-8');
$blood_sum = 0;//血液のデータが全体で何件あるか
if (!isset($_SESSION['bloodp'])){
		$_SESSION['bloodp'] = 1;//初期のページを1に設定
}
$weight_sum = 0;//体重のデータが全体で何件あるか
if (!isset($_SESSION['weightp'])){
		$_SESSION['weightp'] = 1;//初期のページを1に設定
}
if (!isset($_SESSION['scale_num'])){
		$_SESSION['scale_num'] = 10;//目盛り数
}
if (!isset($_SESSION['scale_width'])){
		$_SESSION['scale_width'] = 10;//目盛り幅
}
if (!isset($_SESSION['scale_min'])){
		$_SESSION['scale_min'] = 0;//目盛り始点値
}
if (!isset($_SESSION['select_blood'])){
		$_SESSION['select_blood'] = "dog_blood";//初期基準値を犬に設定
}
?>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" Content="text/html;charset=UTF-8">
<title>ペット体重・血液</title>
<link rel="shortcut icon" href="../assets/pad.png" type="image/png">
<head>
</head>
<meta charset="UTF-8"/>
<style type="text/css">
body {
	background-image: url("../assets/02.jpg");
	background-repeat: repeat;
	font-family: "Lucida Grande", "segoe UI", "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", Meiryo, Verdana, Arial, sans-serif;
	font-family: "Lucida Grande", "segoe UI", "ヒラギノ丸ゴ ProN W4", "Hiragino Maru Gothic ProN", Meiryo, Arial, sans-serif;
	font-size:0.9em
}
#tab_area {
	margin: 0 auto;
	width: 1300px;
	height: 1200px;
	text-align: left;
	position: relative;
}

#tab_area dl {
	width: 1300px;
	height: 1200px;
	top: -16px;
	border: #777 1px solid;
	position: absolute;
	background-color: #ffffff;
}

#tab_area dl dt {
	top: 0;
	width: 180px;
	height: 40px;
	position: absolute;
	border-bottom: #777 1px solid;
	z-index: 5;
}
#tab_area dl#contents02 dt {
	border-left: #777 1px solid;
	border-right: #777 1px solid;
}


#tab_area dl#weight dt {left: 0;}
#tab_area dl#contents02 dt {left: 180px;}
/*#tab_area dl#contents03 dt {left: 360px;}*/

#tab_area dl dt a {
	width: 180px;
	height: 40px;
	line-height: 40px;
	text-align: center;
	background-color: #ffffff;
	display: block;
}
#tab_area dl dt a:hover {background: #999;}

#tab_area dl dd {
	top: 41px;
	left: 0;
	height: 1150px;
	width: 1250px;
	background-color: #ffffff;
	position: absolute;
	opacity: 0;
	overflow-y: auto;
}

#tab_area dl dd p {
	padding: 0px 5px;
}

/* CSS3 TabAnimation
-------------------------- */
@-webkit-keyframes TabSwitch {
	0% {background: #fff;}
	100% {background: #777;}
}
#tab_area dl:target dt a {
	-webkit-animation-name: TabSwitch;
	-webkit-animation-duration: 1s;
	-webkit-animation-iteration-count: 1;
	color: #fff;
	font-weight: bold;
	background: #777;
}

@-webkit-keyframes ContentsSwitch {
	0% {opacity: 0;}
	100% {opacity: 1;}
}
#tab_area dl:target dd {
	-webkit-animation-name: ContentsSwitch;
	-webkit-animation-duration: 1.5s;
	-webkit-animation-iteration-count: 1;
	opacity: 1;
	z-index: 15;
}

</style>
<?php
/*if (isset($_SESSION['weightp'])) {
	$weightpage = $_SESSION['weightp'];
}*/


try{
	if(isset($_SESSION["animal_id"])){
		$animal_id = $_SESSION["animal_id"];
	}else{
		$animal_id = 1;
	}
	$pdo = new PDO ( "mysql:host=mysql.miraiserver.com;charset=utf8; dbname=u661551261_wan", "u661551261_wan", "u661551261" );//DBアクセス
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch ( PDOException $e ) {
	//print('Error:'.$e->getMessage());
	//print ("接続に失敗しました") ;
}
	$res = $pdo->query("SELECT * FROM  `animal` , `owner` WHERE  `animal`.`owner_id` =  `owner`.`owner_id` and `animal_id` = ".$animal_id);
	$result = $res->fetch(PDO::FETCH_ASSOC);
?>
<table style="margin-top: -11px">
<tr>
<td valign="top">
<table border="1" style="background-color: #ffffff;">
	<tr>
		<td colspan="3">
			<div align="left"><font size="6">Karte</font>
				<div align="right">
					<u>カルテNo.<?php print($result['karte_id']); ?>
					</u>
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td nowrap>飼い主  </td>
		<td><?php print($result['owner_name']); ?></td>
		<td>動物名前 <font size="6"><?php 		print($result['animal_name']); ?></font></td>
	</tr>
	<tr>
		<td>郵便番号</td>
		<td><?php print($result['postal_code']); ?></td>
		<td rowspan="7">
		<img border="0" src="../animal/img/<?php print($result['image_url']); ?>" width="200" height="200">
		</td>
	</tr>
	<tr>
		<td>登録No.</td>
		<td><?php print($result['animal_number']); ?></td>
	</tr>
	<tr>
		<td>MC</td>
		<td><?php print($result['microchip']); ?></td>
	</tr>
	<tr>
		<td>種類</td>
		<td><?php print($result['animal_type']); ?></td>
	</tr>
	<tr>
		<td>毛色</td>
		<td><?php print($result['hair_color']); ?></td>
	</tr>
	<tr>
		<td>生年月日</td>
		<td><?php print($result['birth']); ?></td>
	</tr>
	<tr>
		<td>性別</td>
		<td><?php print($result['sex']); ?></td>
	</tr>
	<tr>
		<td>性格</td>
		<td><?php print($result['personality']); ?></td>
<td><a href="../animal/detailed_information.html">変更</a></td>
	</tr>
<?php
	$res = $pdo->query("SELECT * FROM  `animal_detail` WHERE `animal_id` = $animal_id;");
	$result = $res->fetch(PDO::FETCH_ASSOC);
?>
	<tr>
		<td colspan="3">食事<br><?php print($result['dinner']); ?></td>
	</tr>
	<tr>
		<td colspan="3">投薬・処置<br><?php print($result['disposal']) ?></td>
	</tr>
	<tr>
		<td colspan="2">フィラリア予防</td>
		<td><?php print($result['prevention']); ?></td>
	</tr>
	<tr>
		<td colspan="2">ノミ・ダニ予防</td>
		<td><?php print($result['fleas']); ?></td>
	</tr>
	<tr>
		<td colspan="3">混合ワクチン<br></td>
	</tr>
	<tr>
		<td colspan="3">狂犬病予防注射<br><?php print($result['avaccine']); ?></td>
	</tr>
	<tr>
		<td colspan="3">既住歴<br><?php print($result['medical_history']); ?></td>
	</tr>
	<tr>
		<td colspan="3">アレルギーの有無<br><?php print($result['allergy']); ?></td>
	</tr>
</table>
</td>

<td>
	<script src="chart/Chart.js"></script>
<script src="chart/main.js"></script>
<div id="tab_area">
<dl id="weight">
<dt><a href="#weight">体重</a></dt>
<dd>
<p><strong>名前：
	<?php
	//echo $animal_id;
	$res = $pdo->query("SELECT * FROM `animal` WHERE `animal_id` = ".$animal_id);
	$result = $res->fetch(PDO::FETCH_ASSOC);
	print($result['animal_name']);
	?>
	</strong></p>
<p align="center">
	<canvas id="lineChartCanvas"width="700" height="400"></canvas><!--グラフ描写用キャンバス-->
</p>
<form  method="post" action="../weight/scale_ch.php">
<p align="center">
	目盛り数<input type="number" value="10" name="num"/>
	目盛り幅<input type="number" value="10" name="width"/>
	目盛り始点値<input type="number" value="0" name="min" />
	<input type="submit" value="更新" />
</p>
</form>
<p align="center">
	<table border="1" cellspacing="0" cellpadding="0" class="style">
	<tr height="50">
	<th>日付</th>
	<?php
	$res = $pdo->query("SELECT * FROM `animal_weight` WHERE `animal_id` = ".$animal_id. " ORDER BY `animal_weight`.`date` DESC, `animal_weight`.`weight_id` DESC");
	while($result = $res->fetch(PDO::FETCH_ASSOC)){
		$weight_sum++;
	}
	$karamax = 16 * ($_SESSION['weightp'] - 1);
	$kara = 0;
	$num = 0;
	$res = $pdo->query("SELECT * FROM `animal_weight` WHERE `animal_id` = ".$animal_id. " ORDER BY `animal_weight`.`date` DESC, `animal_weight`.`weight_id` DESC");
	while($result = $res->fetch(PDO::FETCH_ASSOC)){
		if($kara < $karamax){
			$kara++;
		}
		else{
			$date = wordwrap($result['date'], 5, "<br>\n", true);
			//$date = substr($result['date'], 5);
			$date = str_replace('-', '/', $date);
			echo "<td  align='center'>".$date."</td>";
			$num++;
			if ($num > 15) {
				break;
			}
		}
		
	}
	for($num; $num < 16; $num++){
		echo "<td  align='center'>　　　　</td>";
	}
	?>
	</tr>
	<tr height="50">
	<th>BW<br>(単位:kg)</th>
	<?php
	$kara = 0;
	$num = 0;
	$res = $pdo->query("SELECT * FROM `animal_weight` WHERE `animal_id` = ".$animal_id." ORDER BY `date` DESC,`weight_id` DESC");
	while($result = $res->fetch(PDO::FETCH_ASSOC)){
		if($kara < $karamax){//表示開始までぐるぐる
			$kara++;
		}
		else{//表示スタート
			/*-9999じゃなければ表示したい*/
			if($result['bw'] != -9999){
				if($result['after'] != ""){
					echo "<td align='center' ondblclick=wdisp('bw','".$result['date']."','".$result['weight_id']."')>".$result['bw']."<br>".$result['after']."</td>";
				}
				else {
					echo "<td align='center'  style='width: 66px' ondblclick=wdisp('bw','".$result['date']."','".$result['weight_id']."')>".$result['bw']."</td>";
				}
			}
			else{
				echo "<td align='center' ondblclick=wdisp('bw','".$result['date']."','".$result['weight_id']."')>　　　　</td>";
			}
			$num++;
			if ($num > 15) {//12件出力したら爆発
					break;
			}
		}		
	}
	/*12件未満でリザルトが終了した場合空で埋める*/
	for($num; $num < 16; $num++){
		echo "<td  align='center'>　　　　</td>";
	}
	?>
	</tr>
	<tr height="50">  
	<th>BCS</th>
	<?php
	$kara = 0;
	$num = 0;
	$res = $pdo->query("SELECT * FROM `animal_weight` WHERE `animal_id` = ".$animal_id." ORDER BY `date` DESC,`weight_id` DESC");
	while($result = $res->fetch(PDO::FETCH_ASSOC)){
		if($kara < $karamax){//表示開始までぐるぐる
			$kara++;
		}
		else{//表示スタート
			/*-9999じゃなければ表示したい*/
			if($result['bcs'] != -9999){
				echo "<td  align='center' ondblclick=wdisp('bcs','".$result['date']."','".$result['weight_id']."')>".$result['bcs']."</td>";
			}
			else{
				echo "<td  align='center' ondblclick=wdisp('bcs','".$result['date']."','".$result['weight_id']."')>　　　　</td>";
			}
			$num++;
			if ($num > 15) {//12件出力したら爆発
					break;
			}
		}		
	}
	/*12件未満でリザルトが終了した場合空で埋める*/
	for($num; $num < 16; $num++){
		echo "<td  align='center'>　　　　</td>";
	}
	?>
	</tr>
	</table>
	</p>
	<form  method="post" action="../weight/wpageSeek.php">
	<p align="center">
	<?php
	$_SESSION['maxweightp'] = floor($weight_sum / 17) + 1;
	
	if (isset($_SESSION['weightp']) && $_SESSION['weightp'] > 1) {
		echo "<input name='op' type='submit' value='＜＜最初へ'/>";
		echo "<input name='pre' type='submit' value='＜前へ'/>";
	}
	if (isset($_SESSION['weightp'])){
		print("page:".$_SESSION['weightp']);
	}
	if (isset($_SESSION['weightp']) && $_SESSION['weightp'] < $_SESSION['maxweightp']) {
		echo "<input name='next' type='submit' value='次へ＞'/>";
		echo "<input name='end' type='submit' value='最後へ＞＞'/>";
	}
	?>
	</p>
	</form>
	<form method="post" action="../weight/weight.php">
	<p align="center">日付<input type="date" name="date"/>
					   BW<input  type="number" name="BW" step="0.1"/>
					  BCS<select name="BCS">
					  	<option value="1">1</option>
					  	<option value="2">2</option>
					  	<option selected value="3">3</option>
					  	<option value="4">4</option>
					  	<option value="5">5</option>
					  </select>
<input type="checkbox" name="after" value="（食後）">食後
					  <input type="submit" value="追加" />
	</p>
	</form>
	<form  method="post" action="../weight/wprint.php">
	<p align="center">
	<?php
		echo "<input name='print' type='submit' value='このページを印刷'/>";
	?>
	</p>
	</form>
	</dd>
	</dl>

<dl id="contents02">
<?php
?>
<dt><a href="#contents02">血液</a></dt>
<dd>
<form method="post" action="../blood/blood.php">
<p><strong>名前：
	<?php
	$res = $pdo->query("SELECT * FROM `animal` WHERE `animal_id` = ".$animal_id);
	$result = $res->fetch(PDO::FETCH_ASSOC);
	print($result['animal_name']);
	$_SESSION['select_blood'] =  $result['animal_family'];
	?>
	</strong></p>
<p align="center"><table border="1" cellspacing="0" cellpadding="0" class="style">
<tr>
<td  align='center' rowspan="2">検査項目</td>
<td  align='center' colspan="2">正常値</td>
<!--<td  align='center'>1-3</td>-->
<?php
	$res = $pdo->query("SELECT * FROM `blood_examination` WHERE `animal_id` = ".$animal_id. " ORDER BY `blood_examination`.`date` DESC, `blood_examination`.`blood_id` DESC");
	while($result = $res->fetch(PDO::FETCH_ASSOC)){
		$blood_sum++;
	}
	$karamax = 12 * ($_SESSION['bloodp'] - 1);
	$kara = 0;
	$num = 0;
	$res = $pdo->query("SELECT * FROM `blood_examination` WHERE `animal_id` = ".$animal_id. " ORDER BY `blood_examination`.`date` DESC, `blood_examination`.`blood_id` DESC");
	while($result = $res->fetch(PDO::FETCH_ASSOC)){
		if($kara < $karamax){
			$kara++;
		}
		else{
			$date = wordwrap($result['date'], 5, "<br>\n", true);
			//$date = substr($result['date'], 5);
			$date = str_replace('-', '/', $date);
			echo "<td  align='center' rowspan='2'>".$date."</td>";
			$num++;
			if ($num > 11) {
				break;
			}
		}
		
	}
	for($num; $num < 12; $num++){
		echo "<td  align='center' rowspan='2'>　　　　</td>";
	}
?>
<td  align='center' rowspan="2">入力</br>
	<input type="date" name="date"/>
</td>
</tr>
<tr>
<!--<td  align='center'>2-1</td>-->
<td  align='center'>
	<?php
	if($_SESSION['select_blood'] == "dog_blood"){
		echo "犬";
	}
	else if($_SESSION['select_blood'] == "cat_blood"){
		echo "猫";
	}
	else{
		echo "基準値未登録";
		$_SESSION['select_blood'] = "dog_blood";
	}
	?>
</td>
<td  align='center'>単位</td>
<!--<td  align='center'>2-4</td>
<td  align='center'>2-5</td>
<td  align='center'>2-6</td>
<td  align='center'>2-7</td>
<td  align='center'>2-8</td>
<td  align='center'>2-9</td>
<td  align='center'>2-10</td>
<td  align='center'>2-11</td>
<td  align='center'>2-12</td>
<td  align='center'>2-13</td>
<td  align='center'>2-14</td>
<td  align='center'>2-15</td>-->
</tr>
<tr>
<td align='center'>WBC</td>
<td align='center' nowrap>
<?php
echo blood_standard("WBC");
?>
</td>
<td align='center'>102/μl</td>
<?php
	echo blood_echo("WBC");
?>
<td align='center'><input type="number" name="WBC" step="0.1"/></td>
</tr>
<tr>
<td align='center'>RBC</td>
<td align='center' nowrap>
<?php
echo blood_standard("RBC");
?>
</td>
<td align='center'>10?/μl</td>
<?php
	echo blood_echo("RBC");
?>
<td align='center'><input type="number" name="RBC" step="0.1"/></td>
</tr>
<tr>
<td align='center'>Hb</td>
<td align='center' nowrap>
<?php
echo blood_standard("Hb");
?>
</td>
<td align='center'>g/dl</td>
<?php
	echo blood_echo("Hb");
?>
<td align='center'><input type="number" name="Hb" step="0.1"/></td>
</tr>
<tr>
<td align='center'>PCV</td>
<td align='center' nowrap>
<?php
echo blood_standard("PCV");
?>
</td>
<td align='center'>%</td>
<?php
	echo blood_echo("PCV");
?>
<td align='center'><input type="number" name="PCV" step="0.1"/></td>
</tr>
<tr>
<td align='center'>MCV</td>
<td align='center' nowrap>
<?php
echo blood_standard("MCV");
?>
</td>
<td align='center'>fl</td>
<?php
	echo blood_echo("MCV");
?>
<td align='center'><input type="number" name="MCV" step="0.1"/></td>
</tr>
<tr>
<td align='center'>MCH</td>
<td align='center' nowrap>
<?php
echo blood_standard("MCH");
?>
</td>
<td align='center'>pg</td>
<?php
	echo blood_echo("MCH");
?>
<td align='center'><input type="number" name="MCH" step="0.1"/></td>
</tr>
<tr>
<td align='center'>MCHC</td>
<td align='center' nowrap>
<?php
echo blood_standard("MCHC");
?>
</td>
<td align='center'>g/dl</td>
<?php
	echo blood_echo("MCHC");
?>
<td align='center'><input type="number" name="MCHC" step="0.1"/></td>
</tr>
<tr>
<td align='center'>PLT</td>
<td align='center' nowrap>
<?php
echo blood_standard("PLT");
?>
</td>
<td align='center'>10?/μl</td>
<?php
	echo blood_echo("PLT");
?>
<td align='center'><input type="number" name="PLT" step="0.1"/></td>
</tr>
<tr>
<td align='center'>II</td>
<td align='center' nowrap>
	＜5
<?php
	//echo blood_standard("II");
?>
</td>
<td align='center'>/</td>
<?php
	echo blood_echo("II");
?>
<td align='center'><input type="number" name="II" step="0.1"/></td>
</tr>
<tr>
<td align='center'>Ht</td>
<td align='center' nowrap>
<?php
echo blood_standard("Ht");
?>
</td>
<td align='center'>%</td>
<?php
	echo blood_echo("Ht");
?>
<td align='center'><input type="number" name="Ht" step="0.1"/></td>
</tr>
<tr>
<td align='center'>GLU</td>
<td align='center' nowrap>
<?php
echo blood_standard("GLU");
?>
</td>
<td align='center'>mg/dl</td>
<?php
	echo blood_echo("GLU");
?>
<td align='center'><input type="number" name="GLU" step="0.1"/></td>
</tr>
<tr>
<td align='center'>BUN</td>
<td align='center' nowrap>
<?php
echo blood_standard("BUN");
?>
</td>
<td align='center'>mg/dl</td>
<?php
	echo blood_echo("BUN");
?>
<td align='center'><input type="number" name="BUN" step="0.1"/></td>
</tr>
<tr>
<td align='center'>CRE</td>
<td align='center' nowrap>
<?php
echo blood_standard("CRE");
?>
</td>
<td align='center'>mg/dl</td>
<?php
	echo blood_echo("CRE");
?>
<td align='center'><input type="number"  name="CRE" step="0.1"/></td>
</tr>
<tr>
<td align='center'>UN/CR</td>
<td align='center' nowrap>
<?php
echo blood_standard("UN/CR");
?>
</td>
<td align='center'></td>
<?php
	echo blood_echo("UN/CR");
?>
<td align='center'><input type="number"  name="UN/CR" step="0.1"/></td>
</tr>
<tr>
<td align='center'>IP</td>
<td align='center' nowrap>
<?php
echo blood_standard("IP");
?>
</td>
<td align='center'>mg/dl</td>
<?php
	echo blood_echo("IP");
?>
<td align='center'><input type="number"  name="IP" step="0.1"/></td>
</tr>
<tr>
<td align='center'>Ca</td>
<td align='center' nowrap>
<?php
echo blood_standard("Ca");
?>
</td>
<td align='center'>mg/dl</td>
<?php
	echo blood_echo("Ca");
?>
<td align='center'><input type="number"  name="Ca" step="0.1"/></td>
</tr>
<tr>
<td align='center'>TP</td>
<td align='center' nowrap>
<?php
echo blood_standard("TP");
?>
</td>
<td align='center'>g/dl</td>
<?php
	echo blood_echo("TP");
?>
<td align='center'><input type="number"  name="TP" step="0.1"/></td>
</tr>
<tr>
<td align='center'>ALB</td>
<td align='center' nowrap>
<?php
echo blood_standard("ALB");
?>
</td>
<td align='center'>g/dl</td>
<?php
	echo blood_echo("ALB");
?>
<td align='center'><input type="number"  name="ALB" step="0.1"/></td>
</tr>
<tr>
<td align='center'>ALT/GPT</td>
<td align='center' nowrap>
<?php
echo blood_standard("ALT/GPT");
?>
</td>
<td align='center'>IU/l</td>
<?php
	echo blood_echo("ALT/GPT");
?>
<td align='center'><input type="number" name="ALT/GPT" step="0.1"/></td>
</tr>
<tr>
<td align='center'>AST/GOT</td>
<td align='center' nowrap>
<?php
echo blood_standard("AST/GOT");
?>
</td>
<td align='center'>IU/l</td>
<?php
	echo blood_echo("AST/GOT");
?>
<td align='center'><input type="number"  name="AST/GOT" step="0.1"/></td>
</tr>
<tr>
<td align='center'>ALP</td>
<td align='center' nowrap>
<?php
echo blood_standard("ALP");
?>
</td>
<td align='center'>IU/l</td>
<?php
	echo blood_echo("ALP");
?>
<td align='center'><input type="number"  name="ALP" step="0.1"/></td>
</tr>
<tr>
<td align='center'>TBIL</td>
<td align='center' nowrap>
<?php
echo blood_standard("TBIL");
?>
</td>
<td align='center'>mg/dl</td>
<?php
	echo blood_echo("TBIL");
?>
<td align='center'><input type="number"  name="TBIL" step="0.1"/></td>
</tr>
<tr>
<td align='center'>TCHO</td>
<td align='center' nowrap>
<?php
echo blood_standard("TCHO");
?>
</td>
<td align='center'>mg/dl</td>
<?php
	echo blood_echo("TCHO");
?>
<td align='center'><input type="number"  name="TCHO" step="0.1"/></td>
</tr>
<tr>
<td align='center'>GGT</td>
<td align='center' nowrap>
<?php
echo blood_standard("GGT");
?>
</td>
<td align='center'>U/l</td>
<?php
	echo blood_echo("GGT");
?>
<td align='center'><input type="number"  name="GGT" step="0.1"/></td>
</tr>
<tr>
<td align='center'>NH3</td>
<td align='center' nowrap>
<?php
echo blood_standard("NH3");
?>
</td>
<td align='center'>mg/dl</td>
<?php
	echo blood_echo("NH3");
?>
<td align='center'><input type="number"  name="NH3" step="0.1"/></td>
</tr>
<tr>
<td align='center'>CPK</td>
<td align='center' nowrap>
<?php
echo blood_standard("CPK");
?>
</td>
<td align='center'>U/l</td>
<?php
	echo blood_echo("CPK");
?>
<td align='center'><input type="number"  name="CPK" step="0.1"/></td>
</tr>
<tr>
<td align='center'>LIP</td>
<td align='center' nowrap>
<?php
echo blood_standard("LIP");
?>
</td>
<td align='center'>U/l</td>
<?php
	echo blood_echo("LIP");
?>
<td align='center'><input type="number"  name="LIP" step="0.1"/></td>
</tr>
<tr>
<td align='center'>AMYL</td>
<td align='center' nowrap>
<?php
echo blood_standard("AMYL");
?>
</td>
<td align='center'>IU/l</td>
<?php
	echo blood_echo("AMYL");
?>
<td align='center'><input type="number"  name="AMYL" step="0.1"/></td>
</tr>
<tr>
<td align='center'>LDH</td>
<td align='center' nowrap>
<?php
echo blood_standard("LDH");
?>
</td>
<td align='center'>U/l</td>
<?php
	echo blood_echo("LDH");
?>
<td align='center'><input type="number"  name="LDH" step="0.1"/></td>
</tr>
<tr>
<td align='center'>TG</td>
<td align='center' nowrap>
<?php
echo blood_standard("TG");
?>
</td>
<td align='center'>mg/dl</td>
<?php
	echo blood_echo("TG");
?>
<td align='center'><input type="number"  name="TG" step="0.1"/></td>
</tr>
<tr>
<td align='center'>Na</td>
<td align='center' nowrap>
<?php
echo blood_standard("Na");
?>
</td>
<td align='center'>mEq/dl</td>
<?php
	echo blood_echo("Na");
?>
<td align='center'><input type="number"  name="Na" step="0.1"/></td>
</tr>
<tr>
<td align='center'>K</td>
<td align='center' nowrap>
<?php
echo blood_standard("K");
?>
</td>
<td align='center'>mEq/dl</td>
<?php
	echo blood_echo("K");
?>
<td align='center'><input type="number"  name="K" step="0.1"/></td>
</tr>
<tr>
<td align='center'>Cl</td>
<td align='center' nowrap>
<?php
echo blood_standard("Cl");
?>
</td>
<td align='center'>mEq/dl</td>
<?php
	echo blood_echo("Cl");
?>
<td  align='center'><input type="number"  name="Cl" step="0.1"/></td>
</tr>
<tr>
<td  align='center' colspan="3">その他</td>
<?php
	$kara = 0;
	$num = 0;
	$res = $pdo->query("SELECT * FROM `blood_examination` WHERE `animal_id` = ".$animal_id. " ORDER BY `blood_examination`.`date` DESC, `blood_examination`.`blood_id` DESC");
	while($result = $res->fetch(PDO::FETCH_ASSOC) ){
		if($kara < $karamax){
			$kara++;
		}
		else{
			if ($result['other'] == '') {
				echo "<td  align='center'></td>";
			}else{
				$other = mb_substr($result['other'], 0, 2);
				echo "<td  align='center'>".$other."...<br><input type=button value=確認 onclick=alert('".$result['other']."')>";
			}
			
			$num++;
			if ($num > 11) {
				break;
			}
		}
	}
	for($num; $num < 12; $num++){
		echo "<td  align='center'></td>";
	}
?>
<td  align='center'><input type="text" name="other"/><br>
	<input type="submit" value="追加" />
</td>
</tr>
</table>
</p>
</form>
<form  method="post" action="../blood/bpageSeek.php">
	<p align="center">
	<?php
	$_SESSION['maxbloodp'] = floor($blood_sum / 13) + 1;
	
	if (isset($_SESSION['bloodp']) && $_SESSION['bloodp'] > 1) {
		echo "<input name='op' type='submit' value='＜＜最初へ'/>";
		echo "<input name='pre' type='submit' value='＜前へ'/>";
	}
	if (isset($_SESSION['bloodp'])){
		print("page:".$_SESSION['bloodp']);
	}
	if (isset($_SESSION['bloodp']) && $_SESSION['bloodp'] < $_SESSION['maxbloodp']) {
		echo "<input name='next' type='submit' value='次へ＞'/>";
		echo "<input name='end' type='submit' value='最後へ＞＞'/>";
	}
	?>
	</p>
</form>
<form  method="post" action="../blood/bprint.php">
	<p align="center">
	<?php
		echo "<input name='print' type='submit' value='このページを印刷'/>";
	?>
	</p>
</form>
</dd>
</dl>

<!--<dl id="contents03">
<dt><a href="#contents03">CONTENTS【03】</a></dt>
<dd>
<p><strong>CONTENTS【03】</strong></p>
<p>ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。</p>
<p>ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。</p>
<p>ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。</p>
<p>ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。</p>
<p>ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。</p>
<p>ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。</p>
</dd>
</dl>-->

</div><!--/#tab_area-->
<script type="text/javascript">
	window.onload = function(){
 
    var lineChartData =
    {
        labels : [
		<?php
        //echo '"2014/09/09","8/21","8/23","8/30","9/26","10/1","10/8","10/15","10/22","10/29","11/5","11/12","12/3","1/7","1/14","1/21"';
$karamax = 16 * ($_SESSION['weightp'] - 1);
        $kara = 0;
		$num = 0;
		$res = $pdo->query("SELECT * FROM `animal_weight` WHERE `animal_id` = ".$animal_id. " ORDER BY `animal_weight`.`date` DESC, `animal_weight`.`weight_id` DESC");
		while($result = $res->fetch(PDO::FETCH_ASSOC)){
			if($kara < $karamax){
				$kara++;
			}
			else{
				$date = wordwrap($result['date'], 5, "<br>\n", true);
				//$date = substr($result['date'], 5);
				$date = str_replace('-', '/', $date);
				echo '"'.$result['date'].'",';
				$num++;
				if ($num > 15) {
					break;
				}
			}
			
		}
		for($num; $num < 16; $num++){
			echo '"",';
		}
        ?>
		],
        datasets : [
        {
            fillColor :        "rgba(255,0,0,0.5)",
            strokeColor :      "rgba(255,0,0,1.0)",
            pointColor :       "rgba(255,0,0,1.0)",
            pointStrokeColor : "rgba(255,0,0,1.0)",
            data : [
			<?php
            $kara = 0;
			$num = 0;
			$res = $pdo->query("SELECT * FROM `animal_weight` WHERE `animal_id` = ".$animal_id." ORDER BY `date` DESC,`weight_id` DESC");
			while($result = $res->fetch(PDO::FETCH_ASSOC)){
				if($kara < $karamax){//表示開始までぐるぐる
					$kara++;
				}
				else{//表示スタート
					/*-9999じゃなければ表示したい*/
					if($result['bw'] != -9999){
						echo $result['bw'].",";
					}
					else{
						echo ",";
					}
					$num++;
					if ($num > 15) {//12件出力したら爆発
							break;
					}
				}		
			}
			/*12件未満でリザルトが終了した場合空で埋める*/
			for($num; $num < 16; $num++){
				echo ",";
			}
			?>
			]
        },
        /*{
            fillColor :        "rgba(0,255,0,0.5)",
            strokeColor :      "rgba(0,255,0,1.0)",
            pointColor :       "rgba(0,255,0,1.0)",
            pointStrokeColor : "rgba(0,255,0,1.0)",
            data : [100,100,120,140,150]
        },
        {
            fillColor :        "rgba(0,0,255,0.5)",
            strokeColor :      "rgba(0,0,255,1.0)",
            pointColor :       "rgba(0,0,255,1.0)",
            pointStrokeColor : "rgba(0,0,255,1.0)",
            data : [410,490,650,720,690]
        }*/]
    };
    
 	var option = {
 		scaleOverride: true,
 		 // Number - Y軸値のステップ数
        scaleSteps: <?php
        echo $_SESSION['scale_num'];
        ?>,
        // Number - Y軸値のステップする大きさ(10にすると0,10,20,30というように増加)
        scaleStepWidth : <?php
        echo $_SESSION['scale_width'];
        ?>,
        // Number - Y軸値の始まりの値
        scaleStartValue : <?php
        echo $_SESSION['scale_min'];
        ?>,
        bezierCurve : false,
	}
	
    function show() {
        var ctx = document.getElementById("lineChartCanvas").getContext("2d");
        new Chart(ctx).Line(lineChartData,option);
    }
    show();
}
</script>
</td>
</tr>
</table>
<?php
function blood_echo($arg_1){
	$karamax = 12 * ($_SESSION['bloodp'] - 1);//ページ内で出力するデータまで何件空回りさせるか
	try{
	if(isset($_SESSION["animal_id"])){
		$animal_id = $_SESSION["animal_id"];
	}else{
		$animal_id = 1;
	}
	$pdo = new PDO ( "mysql:host=mysql.miraiserver.com; dbname=u661551261_wan", "u661551261_wan", "u661551261" );//DBアクセス
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	}
	catch ( PDOException $e ) {
		//print('Error:'.$e->getMessage());
		//print ("接続に失敗しました") ;
	}
	$blood = $arg_1;
	$kara = 0;
	$num = 0;
	$max = 0;
	$min = 0;
	$str = "";//echo用返り値
	$res = $pdo->query("SELECT * FROM `dog_blood`");
	while($result = $res->fetch(PDO::FETCH_ASSOC)){
		$max = $result[$blood."_max"];
		$min = $result[$blood."_min"];
	}
	$res = $pdo->query("SELECT * FROM `blood_examination` WHERE `animal_id` = ".$animal_id. " ORDER BY `blood_examination`.`date` DESC, `blood_examination`.`blood_id` DESC");
	//echo "SELECT * FROM `blood_examination` WHERE `animal_id` = ".$animal_id. " ORDER BY `blood_examination`.`date` ASC, `blood_examination`.`blood_id` ASC";
	while($result = $res->fetch(PDO::FETCH_ASSOC)){
		if($kara < $karamax){//表示開始までぐるぐる
			$kara++;
		}
		else{//表示スタート
			/*-9999じゃなければ表示したい*/
			if($result[$blood] != -9999){
				if ($result[$blood] > $max) {
					$str .= "<td align='right' ondblclick=disp('".$blood."','".$result['date']."','".$result['blood_id']."')><b><font color='red'>↑</font></b></font></b>".$result[$blood]."</td>";
				}
				elseif ($result[$blood] < $min) {
					$str .= "<td align='right' ondblclick=disp('".$blood."','".$result['date']."','".$result['blood_id']."')><b><font color='blue'>↓</font></b>".$result[$blood]."</td>";
				}
				else {
					$str .= "<td align='right' ondblclick=disp('".$blood."','".$result['date']."','".$result['blood_id']."')>".$result[$blood]."</td>";
				}
				
			}
			else{
				$str .= "<td  align='center' ondblclick=disp('".$blood."','".$result['date']."','".$result['blood_id']."')>　　　　</td>";
			}
			$num++;
			if ($num > 11) {//12件出力したら爆発
					break;
			}
		}		
	}
	/*12件未満でリザルトが終了した場合空で埋める*/
	for($num; $num < 12; $num++){
		$str .= "<td  align='center'>　　　　</td>";
	}
	return $str;
}

function blood_standard($arg_1){
	try{
	if(isset($_SESSION["animal_id"])){
		$animal_id = $_SESSION["animal_id"];
	}else{
		$animal_id = 1;
	}
	$pdo = new PDO ( "mysql:host=mysql.miraiserver.com; dbname=u661551261_wan", "u661551261_wan", "u661551261" );//DBアクセス
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	}
	catch ( PDOException $e ) {
		//print('Error:'.$e->getMessage());
		//print ("接続に失敗しました") ;
	}
	$blood = $arg_1;
	$max = 0;
	$min = 0;
	$str = "";//echo用返り値
	$res = $pdo->query("SELECT * FROM `".$_SESSION['select_blood']."`");
	while($result = $res->fetch(PDO::FETCH_ASSOC)){
		$max = $result[$blood."_max"];
		$min = $result[$blood."_min"];
	}
	if ($blood == "LIP") {
		$str = "＜".$max;
	}else{
		$str = $min."～".$max;
	}
	return $str;
}
?>
<script type="text/javascript">
<!--

function disp(arg1,arg2,arg3){

	// 入力ダイアログを表示 ＋ 入力内容を user に代入
	user = window.prompt("修正後の数値を入力してください", "");

	// 入力内容が 整数または少数の場合は blood_up.php にジャンプ
	if(user.match(/^-?[0-9]+$/)||user.match(/^[0-9]+\.[0-9]+$/)){

		location.href = "../blood/blood_up.php?blood="+arg1+"&date="+arg2+"&num="+user+"&blood_id="+arg3;

	}

	// 入力内容が一致しない場合は警告ダイアログを表示
	else if(!user.match(/^-?[0-9]+$/)&&!user.match(/^[0-9]+\.[0-9]+$/)){

		window.alert('数値を入力してください');

	}

	// 空の場合やキャンセルした場合は警告ダイアログを表示
	else{

		window.alert('キャンセルされました');

	}

}

function wdisp(arg1,arg2,arg3){

	// 入力ダイアログを表示 ＋ 入力内容を user に代入
	user = window.prompt("修正後の数値を入力してください", "");

	// 入力内容が 整数または少数の場合は blood_up.php にジャンプ
	if(user.match(/^-?[0-9]+$/)||user.match(/^[0-9]+\.[0-9]+$/)){

		location.href = "../weight/weight_up.php?weight="+arg1+"&date="+arg2+"&num="+user+"&weight_id="+arg3;

	}

	// 入力内容が一致しない場合は警告ダイアログを表示
	else if(!user.match(/^-?[0-9]+$/)&&!user.match(/^[0-9]+\.[0-9]+$/)){

		window.alert('数値を入力してください');

	}

	// 空の場合やキャンセルした場合は警告ダイアログを表示
	else{

		window.alert('キャンセルされました');

	}

}

// -->
</script>