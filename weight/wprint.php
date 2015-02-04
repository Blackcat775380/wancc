<meta charset="UTF-8"/>
<style type="text/css">
 <!--
table.style td{
text-align: center;
vertical-align: middle;
}
 -->
 </style>
 <div id="primary">
 <?php
 session_start();
 try{
	if(isset($_SESSION["animal_id"])){
		$animal_id = $_SESSION["animal_id"];
	}else{
		$animal_id = 1;
	}
	$pdo = new PDO ( "mysql:host=mysql.miraiserver.com; dbname=u661551261_wan", "u661551261_wan", "u661551261" );//DBアクセス
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$pdo->query('SET NAMES utf8');
	$blood_sum = 0;
	$weight_sum = 0;
}
catch ( PDOException $e ) {
	//print('Error:'.$e->getMessage());
	//print ("接続に失敗しました") ;
}
 ?>
 <script src="../main/chart/Chart.js"></script>
<script src="../main/chart/main.js"></script>
 <p><strong>名前：
	<?php
	$res = $pdo->query("SELECT * FROM `animal` WHERE `animal_id` = ".$animal_id);
	$result = $res->fetch(PDO::FETCH_ASSOC);
	print($result['animal_name']);
	?>
	</strong></p>
<p align="center">
	<canvas id="lineChartCanvas"width="1100" height="500"></canvas><!--グラフ描写用キャンバス-->
</p>
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
			echo "<td>".$date."</td>";
			$num++;
			if ($num > 15) {
				break;
			}
		}
		
	}
	for($num; $num < 16; $num++){
		echo "<td>　　　　</td>";
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
					echo "<td align='center' ondblclick=wdisp('bw','".$result['date']."','".$result['weight_id']."')>".$result['bw']."</td>";
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
		echo "<td>　　　　</td>";
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
				echo "<td ondblclick=wdisp('bcs','".$result['date']."','".$result['weight_id']."')>".$result['bcs']."</td>";
			}
			else{
				echo "<td ondblclick=wdisp('bcs','".$result['date']."','".$result['weight_id']."')>　　　　</td>";
			}
			$num++;
			if ($num > 15) {//12件出力したら爆発
					break;
			}
		}		
	}
	/*12件未満でリザルトが終了した場合空で埋める*/
	for($num; $num < 16; $num++){
		echo "<td>　　　　</td>";
	}
	?>
	</tr>
	</table>
	</p>
	<form  method="post" action="wpageSeek.php">
	<p align="center">
	<?php
	$_SESSION['maxweightp'] = floor($weight_sum / 17) + 1;
	
	if (isset($_SESSION['weightp'])){
		print("page:".$_SESSION['weightp']);
	}
	?>
	</p>
	
	</form>
	<script type="text/javascript">
	window.onload = function(){
 
    var lineChartData =
    {
        labels : [
        //"2014/09/09","8/21","8/23","8/30","9/26","10/1","10/8","10/15","10/22","10/29","11/5","11/12","12/3","1/7","1/14","1/21"
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
            $karamax = 16 * ($_SESSION['weightp'] - 1);
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
	font-size: 15pt;
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
	height: 150px;
}

#primary table th,
#primary table td {
	font-size: 20px;
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