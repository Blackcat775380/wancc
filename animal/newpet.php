<?php
//セッション開始
session_start();
//初期設定
mb_language('Japanese');
ini_set('mbstring.detect_order', 'auto');
ini_set('mbstring.http_input'  , 'auto');
ini_set('mbstring.http_output' , 'pass');
ini_set('mbstring.internal_encoding', 'UTF-8');
ini_set('mbstring.script_encoding'  , 'UTF-8');
ini_set('mbstring.substitute_character', 'none');
mb_regex_encoding('UTF-8');
//飼い主id
if(isset($_SESSION['owner_id'])){
    $id = $_SESSION['owner_id'];
}else{
    $id = 1;
}
//DBアクセス
try{
    $dbh = new PDO ( "mysql:host=mysql.miraiserver.com;charset=utf8; dbname=u661551261_wan", "u661551261_wan", "u661551261" );
    if ($dbh == null){
        print('接続に失敗しました。<br>');
    }
}catch ( PDOException $e ) {
    print('Error:'.$e->getMessage());
}
//カルテNo
$karte_id = "";
//動物の名前
$animal_name = "";
//登録No
$animal_number = "";
//マイクロチップ
$microchip = "";
//動物種別
$animal_family = "";
//種類
$animal_type = "";
//毛色
$hair_color = "";
//生年月日
$birth = "";
//性別
$sex = "";
//性格
$personality = "";
//写真？
$image_url ="";
//ボタン表示名
$button_name = "更新";
//飛ぶ先編集
$form_action="newpet_change.php";
//GET処理
if(isset($_GET['id'])){
    $pieces = explode("k", $_GET['id']);
    if($pieces[0] == md5($animal_id = $pieces[1]) and is_numeric($animal_id)){
        $res = $dbh->query("SELECT * FROM  `animal` , `owner` WHERE  `animal`.`owner_id` =  `owner`.`owner_id` and `animal_id` = ".$animal_id);
        $result = $res->fetch(PDO::FETCH_ASSOC);

        $karte_id = $result['karte_id'];
        $animal_name = $result['animal_name'];
        $animal_number = $result['animal_number'];
        $microchip = $result['microchip'];
        $animal_family = $result['animal_family'];
        $animal_type = $result['animal_type'];
        $hair_color = $result['hair_color'];
        $birth = $result['birth'];
        $sex = $result['sex'];
        $personality = $result['personality'];
        $image_url = $result['image_url'];
    }else{
        $form_action = "newpet_resist.php";
        $button_name = "追加登録";
    }
}else{
    $form_action = "newpet_resist.php";
    $button_name = "追加登録";
}
$array = array("", "", "", "", "");
if(strcmp($result['animal_family'],"dog_blood") == 0){
    $array['0'] = "selected";
}
if(strcmp($result['animal_family'],"cat_blood") == 0){
    $array['1'] = "selected";
}
if(strcmp($result['animal_family'],"rabbit") == 0){
    $array['2'] = "selected";
}
if(strcmp($result['animal_family'],"muridae") == 0){
    $array['3'] = "selected";
}
if(strcmp($result['animal_family'],"caviidae") == 0){
    $array['4'] = "selected";
}
$sexarray = array("", "", "", "");
if(strcmp($result['sex'],"♂") == 0){
    $sexarray['0'] = "selected";
}
if(strcmp($result['sex'],"♀") == 0){
    $sexarray['1'] = "selected";
}
if(strcmp($result['sex'],"c") == 0){
    $sexarray['2'] = "selected";
}
if(strcmp($result['sex'],"s") == 0){
    $sexarray['3'] = "selected";
}
?>

<!DOCTYPE html>
<html>
	<head data-gwd-animation-mode="quickMode">
	<title>ペット登録編集削除</title>
	<link rel="shortcut icon" href="../assets/pad.png" type="image/png">
	<link rel="stylesheet" type="text/css" href="./css/menu.css">
    <link rel="stylesheet" type="text/css" href="./css/owner.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="generator" content="Google Web Designer 1.1.3.1119">
    <style type="text/css">
      html, body {
        width: 100%;
        height: 100%;
        margin: 0px;
      }
      body {
		background-image: url("../assets/02.jpg");
		background-repeat: repeat;
		font-family: "Lucida Grande", "segoe UI", "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", Meiryo, Verdana, Arial, sans-serif;
		//font-family: "Lucida Grande", "segoe UI", "ヒラギノ丸ゴ ProN W4", "Hiragino Maru Gothic ProN", Meiryo, Arial, sans-serif;
		//font-size:0.9em
        //background-color: transparent;
        -webkit-transform: perspective(1400px) matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
        -webkit-transform-style: preserve-3d;
      }
      @-webkit-keyframes gwd-empty-animation {
        0% {
          opacity: 0.001;
        }
        100% {
          opacity: 0;
        }
      }
      body .event-1-animation {
        -webkit-animation: gwd-empty-animation 0.7s linear 0s 1 normal forwards;
      }
      body.label-1 .event-1-animation {
        -webkit-animation: gwd-empty-animation-label-1 0.7s linear -0.1s 1 normal forwards;
      }
      @-webkit-keyframes gwd-empty-animation-label-1 {
        0% {
          opacity: 0.001;
        }
        100% {
          opacity: 0;
        }
      }
      body .event-2-animation {
        -webkit-animation: gwd-empty-animation 0.1s linear 0s 1 normal forwards;
      }
      body.label-1 .event-2-animation {
        -webkit-animation: gwd-empty-animation-label-1 0.1s linear -0.1s 1 normal forwards;
      }
      .gwd-div-qy5c {
        position: absolute;
        width: 86px;
        height: 34px;
        left: 52px;
        top: 95px;
        font-family:'Times New Roman';
        text-align: left;
        color: rgb(0, 0, 0);
      }
      .gwd-div-nqu3 {
        width: 86px;
      }
      .gwd-div-xu8v {
        width: 86px;
        left: 150px;
        top: 48px;
      }
      .gwd-div-6u3h {
        position: absolute;
        width: 700px;
        height: 700px;
        color: rgb(0, 0, 0);
        left: 398.5px;
        top: 113px;
      }
      .gwd-div-m5ke {
        position: absolute;
        width: 700px;
        height: 98px;
        font-family:'Times New Roman';
        text-align: left;
        left: 398.5px;
        top: 48px;
      }
      .gwd-div-4uqm {
        position: absolute;
        width: 86px;
        height: 34px;
        font-family:'Times New Roman';
        text-align: left;
        color: rgb(0, 0, 0);
        left: 41px;
        top: 48px;
      }
      .gwd-div-9rtm {
        position: absolute;
        width: 132px;
        height: 97px;
        font-family:'Times New Roman';
        text-align: left;
        color: rgb(0, 0, 0);
        left: 76px;
        top: 661px;
      }
      .gwd-div-vk70 {
        position: absolute;
        width: 195px;
        height: 683px;
        left: 41px;
        top: 113px;
      }
    </style>
    <script type="text/javascript">
<!--

function disp(num){
    // 「OK」時の処理開始 ＋ 確認ダイアログの表示
    if(window.confirm('本当にいいんですね？')){
        location.href = "Pet_delete.php?id="+num;
    }
    // 「OK」時の処理終了
    // 「キャンセル」時の処理開始
    else{
        window.alert('キャンセルされました'); // 警告ダイアログを表示
    }
    // 「キャンセル」時の処理終了
}

// -->
    </script>
  </head>
  
  <body>
<div class="nav">
	<ul class="nl clearFix">
		<li class="item1">
			<a href="../top.html">ホーム</a>
		</li>
		<li class="item1">
			<a href="Owner_Search.html">前に戻る</a>
		</li>
	</ul>
</div>

    <div class="gwd-animation-event event-1-animation" data-event-name="event-1" data-event-time="700"></div>
    <gwd_animation_label_element data-label-name="label-1" data-label-time="100" data-label-animation-class-name="label-1"></gwd_animation_label_element>
    <div class="gwd-animation-event event-2-animation" data-event-name="event-2" data-event-time="100"></div>
   <!-- <div class="gwd-div-qy5c gwd-div-nqu3 gwd-div-xu8v"><a href="Owner_Search.html">・前に戻る</a></div> -->
    <div class="gwd-div-6u3h" id="main">
      <form method="post" action="<?php echo $form_action ?>" class="contact" enctype="multipart/form-data">
        <!-- <p>以下のフォームにご入力の上、「入力内容の確認画面へ」ボタンをクリックしてください。</p> -->
        <input type="hidden" name="animal_id" value="<?php print($animal_id) ?>"><br><br><br>
        <table>
          <tbody>
            <tr>
              <th>
                <label for="karute">カルテNo</label>
              </th>
              <td class="required"></td>
              <td>
                <input type="text" name="karute" id="karute" size="50" value="<?php print($karte_id) ?>">
                <br>
              </td>
            </tr>
            <tr>
              <th>
                <label for="name">動物の名前</label>
              </th>
              <td class="required">
                <img src="./images/required1.gif" alt="必須" width="26" height="15">
              </td>
              <td>
                <input type="text" name="name" id="name" size="50" value="<?php print($animal_name) ?>" required>
                <br> <span class="supplement">例） レオ</span>
              </td>
            </tr>
            <tr>
              <th>
                <label for="number">登録No.</label>
              </th>
              <td class="required"></td>
              <td>
                <input type="text" name="number" id="number" size="50" value="<?php print($animal_number) ?>">
                <br> <span class="supplement">例） H26-000000</span>
              </td>
            </tr>
            <tr>
              <th>
                <label for="mnumber">マイクロチップ</label>
              </th>
              <td class="required"></td>
              <td>
                <input type="text" name="mnumber" id="mnumber" size="50" value="<?php print($microchip) ?>">
                <br> <span class="supplement">例） 000000000000000</span>
              </td>
            </tr>
            <tr>
              <th>
                <label for="ka">動物種別</label>
              </th>
              <td class="required">
                <img src="./images/required1.gif" alt="必須" width="26" height="15">
              </td>
              <td>
                <select name="ka">
                <option value="dog_blood" <?php print($array['0']); ?> >イヌ</option>
                <option value="cat_blood" <?php print($array['1']); ?> >ネコ</option>
                <option value="rabbit" <?php print($array['2']); ?> >ウサギ</option>
                <option value="muridae" <?php print($array['3']); ?> >ネズミ</option>
                <option value="caviidae" <?php print($array['4']); ?> >テンジクネズミ</option>
                </select>
              </td>
            </tr>
            <tr>
              <th>
                <label for="type">種類</label>
              </th>
              <td class="required"></td>
              <td>
                <input type="text" name="type" id="type" size="50" value="<?php print($animal_type) ?>">
                <br> <span class="supplement">例） アメリカンショートヘアー</span>
                <br>
              </td>
            </tr>
            <tr>
              <th>
                <label for="color">毛色</label>
              </th>
              <td class="required"></td>
              <td>
                <input type="text" name="color" id="color" size="50" value="<?php print($hair_color) ?>">
                <br> <span class="supplement">例） シルバータビー</span>
                <br>
              </td>
            </tr>
            <tr>
              <th>
                <label for="date">生年月日</label>
              </th>
              <td class="required">
              </td>
              <td>
                <input id="date" type="date" name="date" value="<?php print($birth) ?>">
              </td>
            </tr>
            <tr>
              <th>
                <label for="sex">性別</label>
              </th>
              <td class="required">
                <img src="./images/required1.gif" alt="必須" width="26" height="15">
              </td>
              <td>
                <select name="sex">
                  <option value="♂" <?php print($sexarray['0']); ?> ><font color="#000000">♂</font></option>
                  <option value="♀" <?php print($sexarray['1']); ?> ><font color="#000000">♀</font></option>
                  <option value="c"  <?php print($sexarray['2']); ?> >C</option>
                  <option value="s"  <?php print($sexarray['3']); ?> >S</option>
                </select>
              </td>
            </tr>
            <tr>
              <th>
                <label for="personality">性格</label>
              </th>
              <td class="required"></td>
              <td>
                <input type="text" name="personality" id="personality" size="50" value="<?php print($personality) ?>">
                <br> <span class="supplement">例） 穏やかで、陽気</span>
                <br>
              </td>
            </tr>
            <tr>
              <th>
                <label for="file">写真</label>
              </th>
              <td class="required"></td>
              <td>
                <input type="file" name="upfile" size="50">
                <br>
              </td>
            </tr>
          </tbody>
        </table>
        <p class="button">
			<!-- <input type="submit" name="submit" value="<?php print($button_name) ?>" style="width:100px;height:50px"> -->
			<?php
			if(strcmp($button_name,"追加登録")==0){
				echo '<input type="image" src="../animal/images/signup_1.png" name="button1" alt="追加登録">';
			}else{
				echo '<input type="image" src="../animal/images/kousin.png" name="button1" alt="更新">';
			}
			?>
        </p>
      </form>
    </div>
    <div class="gwd-div-m5ke" style="background-color : #FFFFFF"><h3>
<?php
    $sql = 'SELECT * FROM  `owner` WHERE  `owner`.`owner_id` = '.$id;
    $stmt = $dbh->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    print($result['owner_name']."さま");
    print("  郵便番号：".substr($result['postal_code'], 0, 3)."-".substr($result['postal_code'], 3, 4));
    print("<br>  自宅番号：".$result['home_number']);
    print("  携帯番号：".$result['phone_number']);
?>
    </h3>
		<img src="./images/required1.gif" alt="必須" width="26" height="15">マークの項目は入力必須となります。
	</div>
    <!-- <div class="gwd-div-9rtm">＋（追加）</div> -->
    <!-- <div class="gwd-div-4uqm"><a href="../top.html">・ホームへ</a></div> -->
    <div class="gwd-div-vk70">
<?php
    $sql = "SELECT * FROM  `animal` WHERE  `animal`.`owner_id` = ".$id;
    $stmt = $dbh->query($sql);
    print('<table border="1"  bgcolor="#FFFFFF">');
    print('<tr><td colspan="2">ペット一覧</td></tr>');
    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        disp($result);
    }
    print('<tr><td colspan="2"><a href="?id=new"><img src="../assets/petregistration_2.png" class="gwd-img-yia2"></a></td></tr>');
    print('</table>');

function disp($result){
    $id_animal = $result['animal_id'];
    $id_md5 = md5($id_animal)."k".$id_animal."k";
    print('<tr><td><a href="newpet.php?id='.$id_md5.'">');
    print("ペット名：".$result['animal_name']."</a></td>");
    print('<td><input type="button" value="削除" onClick="disp('.$id_animal.')"></td></tr>');
    print('<tr><td colspan="2"><img border="0"');
    print("src=../animal/img/".noimg($result['image_url']));
    print(' width="200" height="200"></td></tr>');
}
function noimg($image_url){
	if(strlen($image_url) > 4){
		return $image_url;
	}else{
		return "noimage.jpg";
	}
}
?>
    </div>
  </body>

</html>