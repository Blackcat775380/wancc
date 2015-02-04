<meta charset="UTF-8"/>
 <div id="primary">
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
 try{
	$animal_id = $_SESSION["animal_id"];
	$pdo = new PDO ( "mysql:host=mysql.miraiserver.com; dbname=u661551261_wan", "u661551261_wan", "u661551261" );//DBアクセス
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$pdo->query('SET NAMES utf8');
	$blood_sum = 0;
}
catch ( PDOException $e ) {
	//print('Error:'.$e->getMessage());
	//print ("接続に失敗しました") ;
}
 ?>
 <p　class=""><strong>名前：
	<?php
	$res = $pdo->query("SELECT * FROM `animal` WHERE `animal_id` = ".$animal_id);
	$result = $res->fetch(PDO::FETCH_ASSOC);
	print($result['animal_name']);
	$_SESSION['select_blood'] =  $result['animal_family'];
	?>
	</strong></p>
<p align="center"><table border="1" cellspacing="0" cellpadding="0" class="style">
<tr>
<td align='center' rowspan="2">検査項目</td>
<td align='center' colspan="2">正常値</td>
<!--<td align='center'>1-3</td>-->
<?php
	$res = $pdo->query("SELECT * FROM `blood_examination` WHERE `animal_id` = ".$animal_id." ORDER BY `date` DESC,`blood_id` DESC");
	while($result = $res->fetch(PDO::FETCH_ASSOC)){
		$blood_sum++;
	}
	$karamax = 12 * ($_SESSION['bloodp'] - 1);
	$kara = 0;
	$num = 0;
	$res = $pdo->query("SELECT * FROM `blood_examination` WHERE `animal_id` = ".$animal_id." ORDER BY `date` DESC,`blood_id` DESC");
	while($result = $res->fetch(PDO::FETCH_ASSOC)){
		if($kara < $karamax){
			$kara++;
		}
		else{
			//$date = wordwrap($result['date'], 5, "<br>\n", true);
			//$date = substr($result['date'], 5);
			$date = str_replace('-', '/', $result['date']);
			echo "<td align='center' rowspan='2'>".$date."</td>";
			$num++;
			if ($num > 11) {
				break;
			}
		}
		
	}
	for($num; $num < 12; $num++){
		echo "<td align='center' rowspan='2'>ㅤㅤㅤㅤㅤ</td>";
	}
?>
</tr>
<tr>
<!--<td align='center'>2-1</td>-->
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
<td align='center'>単位</td>
<!--<td align='center'>2-4</td>
<td align='center'>2-5</td>
<td align='center'>2-6</td>
<td align='center'>2-7</td>
<td align='center'>2-8</td>
<td align='center'>2-9</td>
<td align='center'>2-10</td>
<td align='center'>2-11</td>
<td align='center'>2-12</td>
<td align='center'>2-13</td>
<td align='center'>2-14</td>
<td align='center'>2-15</td>-->
</tr>
<tr>
<td align='center'>WBC</td>
<td align='center' nowrap>
<?php
echo blood_standard("WBC");
?>
</td>
<td align='center'>10²/μl</td>
<?php
	echo blood_echo("WBC");
?>
</tr>
<tr>
<td align='center'>RBC</td>
<td align='center' nowrap>
<?php
echo blood_standard("RBC");
?>
</td>
<td align='center'>10⁴/μl</td>
<?php
	echo blood_echo("RBC");
?>
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
</tr>
<tr>
<td align='center'>PLT</td>
<td align='center' nowrap>
<?php
echo blood_standard("PLT");
?>
</td>
<td align='center'>10⁴/μl</td>
<?php
	echo blood_echo("PLT");
?>
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
</tr>
<tr>
<td align='center' colspan="3">その他</td>
<?php
	$kara = 0;
	$num = 0;
	$res = $pdo->query("SELECT * FROM `blood_examination` WHERE `animal_id` = ".$animal_id. " ORDER BY `blood_examination`.`date` DESC, `blood_examination`.`blood_id` DESC");
	while($result = $res->fetch(PDO::FETCH_ASSOC) ){
		if($kara < $karamax){
			$kara++;
		}
		else{
			//$other = mb_substr($result['other'], 0, 2);
			echo "<td align='center'>".$result['other']."</td>";
			$num++;
			if ($num > 11) {
				break;
			}
		}
	}
	for($num; $num < 12; $num++){
		echo "<td align='center'></td>";
	}
?>
</tr>
</table>
</p>
</form>
<form  method="post" action="bpageSeek.php">
	<p align="center">
	<?php
	$_SESSION['maxbloodp'] = floor($blood_sum / 13) + 1;
	if (isset($_SESSION['bloodp'])){
		print("page:".$_SESSION['bloodp']);
	}
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
</td>
</tr>
</table>
</div><!--/#tab_area-->
<script type="text/javascript">
	window.onload = function(){
 
    var lineChartData =
    {
        labels : [
        //"2014/09/09","8/21","8/23","8/30","9/26","10/1","10/8","10/15","10/22","10/29","11/5","11/12","12/3","1/7","1/14","1/21"
        <?php
        //echo '"2014/09/09","8/21","8/23","8/30","9/26","10/1","10/8","10/15","10/22","10/29","11/5","11/12","12/3","1/7","1/14","1/21"';
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


<?php
function blood_echo($arg_1){
	$karamax = 12 * ($_SESSION['bloodp'] - 1);//ページ内で出力するデータまで何件空回りさせるか
	try{
	$animal_id = $_SESSION["animal_id"];
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
	$res = $pdo->query("SELECT * FROM `".$_SESSION['select_blood']."`");
	while($result = $res->fetch(PDO::FETCH_ASSOC)){
		$max = $result[$blood."_max"];
		$min = $result[$blood."_min"];
	}
	$res = $pdo->query("SELECT * FROM `blood_examination` WHERE `animal_id` = ".$animal_id. " ORDER BY `blood_examination`.`date` DESC, `blood_examination`.`blood_id` DESC");
	while($result = $res->fetch(PDO::FETCH_ASSOC)){
		if($kara < $karamax){//表示開始までぐるぐる
			$kara++;
		}
		else{//表示スタート
			/*-9999じゃなければ表示したい*/
			if($result[$blood] != -9999){
				if ($result[$blood] > $max) {
					$str .= "<td align='right'><b><font color='red'>↑</font></b></font></b>".$result[$blood]."</td>";
				}
				elseif ($result[$blood] < $min) {
					$str .= "<td align='right'><b><font color='blue'>↓</font></b>".$result[$blood]."</td>";
				}
				else {
					$str .= "<td align='right'>".$result[$blood]."</td>";
				}
				
			}
			else{
				$str .= "<td align='center'>　　　　</td>";
			}
			$num++;
			if ($num > 11) {//12件出力したら爆発
					break;
			}
		}		
	}
	/*12件未満でリザルトが終了した場合空で埋める*/
	for($num; $num < 12; $num++){
		$str .= "<td align='center'>ㅤㅤㅤ</td>";
	}
	return $str;
}

function blood_standard($arg_1){
	try{
	$animal_id = $_SESSION["animal_id"];
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
<style type="text/css">
@charset "UTF-8";

/* -----------------------------------------------

	===== TOC =====
	
	* common.css
	* layout.css
	* module.css
	* accesebility.css
	* print.css

----------------------------------------------- */


/* common.css
----------------------------------------------- */

body {
	line-height: 0;
	letter-spacing: 1px;
	font-family: "ヒラギノ角ゴ Pro W3", Osaka, "ＭＳ Ｐゴシック", sans-serif;
	font-size: 5pt;
	color: #000000;
	background-color: #FFFFFF;
}

a:link,
a:visited {
	text-decoration: underline;
	font-weight: bold;
	color: #000000;
}

address {
	font-style: normal;
}

p{
	line-height: 0;
}

img {
	border: 0;
}


/* layout.css
----------------------------------------------- */

#wrapper,
#navi,
#primary,
#secondary,
#footer {
	float: none !important;
	width: auto !important;
	margin: 0 !important;
	padding: 0 !important;
}

#wrapper {
	margin: 0;
	padding: 0;
	border: 0;
	background: transparent;
}

#navi {
	display: none;
}

#primary {
	margin: 0 0 0 5%;
	font-family: "ヒラギノ明朝 Pro W3", "細明朝体", "ＭＳ Ｐ明朝", serif;
}

#secondary {
	display: none;
}

#footer {
	margin-top: 1em;
	border-top: 1px dashed #000000;
	text-align: right;
	font-size: 90%;
}

#footer ul {
	list-style-type: none;
}


/* module.css
----------------------------------------------- */

#primary h2 {
	display: none;
}

#primary h3 {
	border-top: 1px dotted #000000;
	border-bottom: 1px dotted #000000;
	margin: 10px 0 10px 0;
	padding: 8px;
	font-size: 50%;
	font-weight: bold;
}

#primary h4 {
	border-left: 5px solid #000000;
	margin: 10px 0 10px 0;
	padding: 0 0 0 10px;
}

#primary p,
#primary ul,
#primary ol,
#primary dl {
	margin: 0 0 20px 10px;
}

#primary table {
	width: 100%;
	height: 600px;
}

#primary table th,
#primary table td {
	font-size: 5px;
}




/* accesebility.css
----------------------------------------------- */

div.hidden,
p.hidden {
	display: none;
}


/* print.css
----------------------------------------------- */

a:link:after,
a:visited:after {
	content: " (" attr(href) ") ";
	font-size: 50%;
}
</style>