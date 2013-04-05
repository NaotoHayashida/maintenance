<?php
	session_start();
	require_once "php_functions/common_functions.php";
	require_once "php_functions/ichiran_functions.php";
	echo sentoTagCreate("行事登録",kaishibi,shuryobi);
	echo "<body>\n";
  $edit= $_GET['edit'];
	$update_id = $_GET["id"];
	$mode = $_POST["mode"];
	$action = $_POST["action"];													//実行条件判断
	$gyojikubun =  $_POST["gyojikubun"];										//行事区分
	$title = $_POST["title"];													//タイトル
	$comment = $_POST["comment"];												//コメント
	$anchor = $_POST["anchor"];													//アンカー
	$kaishibi = $_POST["kaishibi"];												//期間の開始日
	$shuryobi = $_POST["shuryobi"];												//期間の終了日
	define("title_max",80);														//タイトル文字数制限
	define("comment_max",80);													//コメント文字数制限

if(isset($_POST["k_cal"])){
	$k_cal = 1;																//カレンダーに公開
}
else{
	$k_cal = 0;																//カレンダーに公開
}
if(isset($_POST["k_new"])){
	$k_new = 1;																//新着情報に公開
}
else{
	$k_new = 0;																//新着情報に公開
}



//リロード時にデータを反映
if($mode == "insert"){
	$h_gyojikubun = $_POST["gyojikubun"];
	$h_title = $_POST["title"];
	$h_comment = $_POST["comment"];
	$h_anchor = $_POST["anchor"];
	$h_kaishibi = $_POST["kaishibi"];
	$h_shuryobi = $_POST["shuryobi"];
	$calendar_kokai = $_POST["k_cal"];
	$shinchaku_kokai = $_POST["k_new"];
}

//プレビュー表示時用のフォームデータを保存
	$_SESSION["check_gyojikubun"] = $gyojikubun;
	$_SESSION["check_title"] = $title;
	$_SESSION["check_comment"] = $comment;
	$_SESSION["check_anchor"] = $anchor;
	$_SESSION["check_kaishibi"] = $kaishibi;
	$_SESSION["check_shuryobi"] = $shuryobi;
	$_SESSION["check_k_cal"] = $_POST["k_cal"];
	$_SESSION["check_k_new"] = $k_new;

//編集遷移判断
	$_SESSION["check_id"] = $_GET["id"];

	//●DB接続
	if (dbConnect($dbconn) == false)
	{
		//エラー処理
		exit(dbErrorMessageCreate("DB接続に失敗しました。"));
	}
	
//Updateするためのデータをテキストボックスに反映させるために抽出
if($update_id != ""){
	$sql = 	"select * from gyoji where id = $update_id ";
	$result = pg_query($dbconn, $sql);

	if ($result == false){
		exit(dbErrorMessageCreate("DB抽出に失敗しました。", $sql, $dbconn));
						}
						
	//$resultの結果を読み込み
	$row = pg_fetch_object($result);
	$h_gyojikubun = $row->gyoji_kubun;
	$h_title = $row->title;
	$h_comment = $row->comment;
	$h_anchor = $row->danraku_mei;
	$h_kaishibi = TimeChange($row->kaishi_bi);
	$h_shuryobi = TimeChange($row->shuryo_bi);
	$calendar_kokai = $row->calendar_kokai;
	$shinchaku_kokai = $row->shinchaku_kokai;
}

//UPdate実行
if($update_id != ""and $edit==TRUE and $mode == "insert" ){
	//リロード時にデータを反映
	$h_gyojikubun = $_POST["gyojikubun"];
	$h_title = $_POST["title"];
	$h_comment = $_POST["comment"];
	$h_anchor = $_POST["anchor"];
	$h_kaishibi = $_POST["kaishibi"];
	$h_shuryobi = $_POST["shuryobi"];
	$calendar_kokai = $_POST["k_cal"];
	$shinchaku_kokai = $_POST["k_new"];

	//エラー処理　1ならUPdateしない
	$error =0 ;
//	echo	"UPdate実行 \n";
	$sql = 	"select * from gyoji where id = $update_id ";
	$result = pg_query($dbconn, $sql);

	
	//$resultの結果を読み込み
	$row = pg_fetch_object($result);
	$check_gyojikubun = $row->gyoji_kubun;
	$check_kaishibi = TimeChange($row->kaishi_bi);
	$check_shuryobi = TimeChange($row->shuryo_bi);
	if($check_gyojikubun != $gyojikubun or $check_kaishibi != $kaishibi or $check_shuryobi != $shuryobi){
		$sql =	"select * from gyoji ".
				"where gyoji_kubun =" . $gyojikubun . " and ((kaishi_bi >= '" . $kaishibi . "' and kaishi_bi <= '" . $shuryobi . "' and id <>" . $update_id . ") ".
				"or ( shuryo_bi >= '" .$kaishibi . "' and shuryo_bi <= '" . $shuryobi . "' and id <>" . $update_id . " ) ".
				"or (kaishi_bi <= '" . $kaishibi  . "' and shuryo_bi >= '" . $shuryobi . "' and id <>" . $update_id . ") );";
				
				
		
		$result = pg_query($dbconn, $sql);

			if ($result == false){
				exit(dbErrorMessageCreate("DB抽出に失敗しました。", $sql, $dbconn));
								}
								
			if(pg_num_rows($result) != 0){
//				echo "同じ行事区分で、期間が重複しているデーターが存在するので登録できません。update<br>";
				
				$error = 1;
			}
		}
		
		//エラーがなかった場合　updateを実行する
		if($error == 0){
			if($action == "実行"){
				$sql = 	"update gyoji set ".
				"gyoji_kubun = " . $gyojikubun . ",title = '" . $title . "'," .
				"comment = '" . $comment . "', danraku_mei = '" . $anchor . "',".
				"sakusei_sha = '" . $_SERVER['REMOTE_USER'] . "', kaishi_bi = '" . $kaishibi . "',".
				"shuryo_bi = '" . $shuryobi . "', calendar_kokai = '" . $k_cal . "', shinchaku_kokai = '" . $k_new . "'".
				"where id = " . $update_id . ";";
				
	//			$_SESSION['gyoji-iti_ID'] 			= $update_id;
				
				pg_query($dbconn, "BEGIN"); //トランザクション開始
				$result = pg_query($dbconn, $sql);

				if ($result == false)
				{
					pg_query($dbconn, "ROLLBACK");
					exit(dbErrorMessageCreate("DB登録に失敗しました。", $sql, $dbconn));
				}
				pg_query($dbconn, "COMMIT");
				echo "<script language='JavaScript'>document.location = 'gyoji_ichiran.php';</script>";
			}
			else if($action == "トップページのプレビュー"){
				echo "<script language='JavaScript'>window.open('../new/index.html?preview=gyoji_preview');</script>";
			}
			else if($action == "博物館のご案内のプレビュー"){
				echo "<script language='JavaScript'>window.open('../new/museum/index.html?preview=gyoji_preview');</script>";
			}
		}
	

}



?>
		<div class="all">
			<form action="" id='form' name="form" method="POST">
				<div class="header">
				<h2>行事登録<?php if($edit==TRUE){echo"(編集)";}
else if($update_id !=""){echo"(追加登録)";} 
else{echo"(新規登録)";}?>
				</h2>
				</div>
				<div class="kyotsu">
				<p><a href="menu.php">管理メニュー</a></p>
				<p><a href="gyoji_ichiran.php">行事一覧</a></p>
				</div>
				<div class="gyoji-left1">
					<p class="toroku1">行事区分</p>
				</div>
				<div class="gyoji-right1">
						<p class="toroku2">
							<select name="gyojikubun" class="gyojikubun">
								<?php echo "<option value=''"; if($h_gyojikubun == ''){echo " selected";}echo "> </option>\n";
								echo "<option value='1'";if($h_gyojikubun == '1'){echo " selected";}echo ">".gyojiKubunNameGet(1)."</option>\n";
								echo "<option value='2'";if($h_gyojikubun == '2'){echo " selected";}echo ">".gyojiKubunNameGet(2)."</option>\n";
								echo "<option value='3'";if($h_gyojikubun == '3'){echo " selected";}echo ">".gyojiKubunNameGet(3)."</option>\n"; ?>
							</select>
						</p>
                  <span class="gyojicomment"></span>
				</div>
				<div class="gyoji-left1">
					<p class="toroku1" >タイトル</p>
						<p>残り<span class="counttitle">80</span>文字</p>
				</div>
				<div class="gyoji-right1">
<!--				<p class="toroku2"><input type="text" name="title" size="30" maxlength="40" value="<?= $h_title ?>"/></p>-->
					<p class="toroku2">
						<textarea cols="40" rows="4" name="title" class="title"><?= $h_title; ?></textarea></p>
						<span class="titletext"> </span>
			
				</div>
				<div class="gyoji-left1">
					<p class="toroku1">コメント</p>
					<p>残り<span class="countcomment">256</span>文字</p>

				</div>
				<div class="gyoji-right1">
					<p class="toroku2">
					<textarea cols="40" rows="4" name="comment" class="comment"><?= $h_comment; ?></textarea></p>
						<span class="commenttext"></span>
					</div>
				<div class="gyoji-left1">
					<p class="toroku1" >段落名
					残り<span class="countanchor">30</span>文字
					</p>
					
				</div>
				<div class="gyoji-right1">
					<p class="toroku2">
			<input type="text" name="anchor" class="anchor" size="30" value="<?= $h_anchor; ?>"/></p>
						<span class="anchortext"></span>
				</div>
				<div class="gyoji-left1">
					<p class="toroku1">期間</p>
				</div>
				<div class="gyoji-right1">
					<p class="toroku2"><input type="text" name="kaishibi" maxlength='10' size="10" id="jquery-ui-datepicker-from" value="<?= $h_kaishibi; ?>" />～<input type="text" name="shuryobi" maxlength='10' size="10" id="jquery-ui-datepicker-to" value="<?php echo $h_shuryobi; ?>"/></p>
				</div>
				<div class="gyoji-left2">
					<pre class="toroku1">カレンダーに公開 <?php echo "<input type='checkbox' name='k_cal' class='k_cal' value='t'";if($calendar_kokai == 't'){echo " checked='checked'";}echo ">	\n"; ?></pre>
					<p class="toroku1">
						<input type="submit" name="action" value="トップページのプレビュー" class="button-pre" onclick="return stay_here();">
					</p>
				</div>
				<div class="gyoji-right2">
					<pre class="toroku2">新着情報に公開 <?php echo "<input type='checkbox' name='k_new' class='k_new' value='t'";if($shinchaku_kokai == 't'){echo " checked='checked'";}echo ">	\n"; ?></pre>
					<p class="toroku2">
						<input type="submit" name="action" value="博物館のご案内のプレビュー" class="button-pre" onclick="return stay_here();">
					</p>
				</div>
				<div class="kyotsu">
					<p>
						<input type="hidden" name="preview" value="gyoji_preview">
						<input type="hidden" name="mode" value="insert">
						<input type="submit" name="action" value="実行" class="button" onclick="return stay_here();">
					</p>
				</div>
<?php 	//UPDATEしたさい重複チェックに引っかかった場合のエラー文			
		if($error == 1){echo	"<p style='color:red; font-weight: bold;'>同じ行事区分で、期間が重複しているデーターが存在するので登録できません。</p>";}	?>
			</form>
		</div>
	</body>
</html>

<script language="JavaScript">
<!--
function stay_here(){
	if (gyojitoroku_minyuryoku_check() == false) return false;
	form.target = "";
	document.getElementById('form').action = '';
}

function goToHakubutsukan_preview(){
	if (gyojitoroku_minyuryoku_check() == false) return false;
	form.target = "newwindow";
	window.open("","newwindow");
	document.getElementById('form').action = 'test1.php';//../museum/index.php
	document.getElementById('submit').click();
}

function goToTop_preview(){
	if (gyojitoroku_minyuryoku_check() == false) return false;
	form.target = "newwindow";
	window.open("","newwindow");
	document.getElementById('form').action = 'test2.php';//../index.php
	document.getElementById('submit').click();
}

function gyojitoroku_minyuryoku_check(){
	
	var gyojikubun_chk = minyuryoku_check("gyojikubun");

	if(gyojikubun_chk == false){
		alert('正しく入力してください');
		return false;
	}
	var title_chk = minyuryoku_check("title");

	if(title_chk == false){
		alert('タイトルが未入力です。');
		return false;
	}

	var kaishibi_chk = minyuryoku_check("kaishibi");

	if(kaishibi_chk == false){
		alert('開始日が未入力です。');
		return false;
	}

	var shuryobi_chk = minyuryoku_check("shuryobi");

	if(shuryobi_chk == false){
		alert('終了日が未入力です。');
		return false;
	}
	if(document.form.gyojikubun.value == 3){
		var anchor_chk = minyuryoku_check("anchor");
		if(anchor_chk == false){
			alert('段落名が未入力です。');
			return false;
		}
	}
	var kaishibi = document.form.kaishibi.value;
	var shuryobi = document.form.shuryobi.value;
	var kikan_chk = isValidPeriod(kaishibi,shuryobi,true);


	if(kikan_chk == false){
		alert('期間に誤りがあります。');
		return false;
	}
}

//-->
</script>
<?php

			if($edit == "" and $mode == "insert"){
	//●重複チェック
	$sql =	"select * from gyoji ".
			"where gyoji_kubun =" . $gyojikubun . " and ((kaishi_bi >= '" . $kaishibi . "' and kaishi_bi <= '" . $shuryobi . "') or ( shuryo_bi >= '" .
			$kaishibi . "' and shuryo_bi <= '" . $shuryobi . "') or (kaishi_bi <= '" . $kaishibi  . "' and shuryo_bi >= '" . $shuryobi . "'));";
	$result = pg_query($dbconn, $sql);

	if ($result == false)
	{
		exit(dbErrorMessageCreate("DB抽出に失敗しました。", $sql, $dbconn));
	}

	if(pg_num_rows($result) == 0){
		if($action == "実行"){
			//●DB登録
			$sql =	"select max(hyoji_yusendo) as maxa from gyoji";
			$result = pg_query($dbconn, $sql);

			if ($result == false){
				exit(dbErrorMessageCreate("DB抽出に失敗しました。", $sql, $dbconn));
			}
			else{
				$row1 = pg_fetch_object($result);
				$yusendo = $row1->maxa + 1;
				//pg_free_result($result)  //メモリの解放

				$sql = 	"insert into gyoji (hyoji_yusendo,gyoji_kubun, title, comment, danraku_mei, ".
						"sakusei_sha, kaishi_bi, shuryo_bi, calendar_kokai, shinchaku_kokai)".
						"values (" . $yusendo . " ," . $gyojikubun . "," . "'" . $title . "'" . "," . "'" . $comment . "'" . "," . "'" . $anchor . "'" . ", '" . $_SERVER['REMOTE_USER'] . "'," .
						"'" . $kaishibi . "'" . "," . "'" . $shuryobi . "'" . "," . "'" . $k_cal . "'" . "," . "'" . $k_new . "');";

				pg_query($dbconn, "BEGIN"); //トランザクション開始
				$result = pg_query($dbconn, $sql);

				if ($result == false)
				{
					pg_query($dbconn, "ROLLBACK");
					exit(dbErrorMessageCreate("DB登録に失敗しました。", $sql, $dbconn));
				}
				pg_query($dbconn, "COMMIT");
				//検索条件を初期化
				$_SESSION['gyoji-iti_first_access'] = NULL;
				echo "<script language='JavaScript'>document.location = 'gyoji_ichiran.php';</script>";
			}
		}
		else if($action == "トップページのプレビュー"){
			echo "<script language='JavaScript'>window.open('../new/index.html?preview=gyoji_preview');</script>";
		}
		else if($action == "博物館のご案内のプレビュー"){
			echo "<script language='JavaScript'>window.open('../new/museum/index.html?preview=gyoji_preview');</script>";
		}
	}
	else{
		echo "<p style='color:red; font-weight: bold;'>同じ行事区分で、期間が重複しているデーターが存在するので登録できません。</p>";

	}
}
?>
