<!Doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>index | サイトネーム</title>
<meta name="description" content="">
<meta name="keywords" content="xxx,yyy,zzz">
<meta name="robots" content="noindex,nofollow">
</head>
<body>



<?php 
/*------------------------------------------------------------	
	○○用html吐き出し
*/




/*------------------------------------------------------------
	（１）csvデータ取り込み
*/
$list = file("link.csv"); 
$listLen = count($list); 



/*------------------------------------------------------------
	必要になりそうな処理
・改行を<br>タグに変換
・タグを除去
・$honbun = htmlspecialchars($honbun);
・文字コードを変換
・$honbun = mb_convert_encoding($honbun, "EUC-JP","AUTO");
・$honbun = nl2br($honbun);
・クオーテーションマークを変換
・if(get_magic_quotes_gpc()) { $honbun = stripslashes($honbun); } 
・$filename = rand( 1000000, 9999999) . ".html";
*/



/*------------------------------------------------------------
	（２）カンマ区切りの文字列を配列に再配置
*/
for($i=0;$i<$listLen;$i++){
  $data[$i] = split(",",$list[$i]);
}



/*------------------------------------------------------------
	（３）テンプレートの指定
*/
$contents = file_get_contents("template_a.php");



/*------------------------------------------------------------
	（４）テンプレートを元にファイル生成
*/
for($i=0;$i<$listLen;$i++){
	$page = $contents;
	$page = str_replace( "<%TEMP_a>", $data[$i][0], $page);
	$page = str_replace( "<%TEMP_b>", $data[$i][1], $page);
	$page = str_replace( "<%TEMP_c>", $data[$i][2], $page);	
	$page = str_replace( "<%TEMP_d>", $data[$i][3], $page);
	$page = str_replace( "<%TEMP_e>", $data[$i][4], $page);
	$page = str_replace( "<%TEMP_f>", $data[$i][5], $page);
	$handle = fopen( $data[$i][1].'.html', 'w');
	/*
	・パーミッションの設定必要？？？
	*/
	fwrite( $handle, $page);
	fclose( $handle );
}



/*------------------------------------------------------------
	（５）生成ファイルへのリンク
*/
echo '以下のページを生成しました！<br>';
for($i=0;$i<$listLen;$i++){
	echo '<a href="' . $data[$i][1] . '.html">' . $data[$i][1]. '.html</a><br>';
}



?>



</body>
</html>
