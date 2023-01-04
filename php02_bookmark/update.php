<?php
$id = $_POST["id"];
$name = $_POST['name'];
$url = $_POST['url'];
$content = $_POST['content'];

//2. DB接続します
try {
    //ID:'root', Password: xamppは 空白 ''
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
}

//３．データ登録SQL作成

// 1. SQL文を用意
$stmt = $pdo->prepare('UPDATE gs_bm_table SET name = :name, url = :url, content = :content, 
                       date = sysdate() WHERE id = :id;');

//  2. バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':url', $url, PDO::PARAM_STR);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if ($status === false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit('ErrorMessage:'.$error[2]);
} else {
    //５．index.phpへリダイレクト
    header('Location: index.php');
}
?>
















//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//2. $id = $_POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更
//1. POSTデータ取得




//2. DB接続します
//*** function化する！  *****************
try {
  $db_name = 'gs_db'; //データベース名
  $db_id   = 'root'; //アカウント名
  $db_pw   = ''; //パスワード：MAMPは'root'
  $db_host = 'localhost'; //DBホスト
  $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}

//３．データ登録SQL作成
$stmt = $pdo->prepare('UPDATE gs_bm_table SET WHERE id = :id;');
//name = :name,
//url = :url,
                                           //content = :content, 
                                            

// 数値の場合 PDO::PARAM_INT
// 文字の場合 PDO::PARAM_STR
//$stmt->bindValue(':name',    $name,    PDO::PARAM_STR);
//$stmt->bindValue(':url',     $url,     PDO::PARAM_STR);
//$stmt->bindValue(':content', $content, PDO::PARAM_STR); //PARAM_INTなので注意
$stmt->bindValue(':id',      $id,      PDO::PARAM_INT); //PARAM_INTなので注意
$status = $stmt->execute();

//４．データ登録処理後
if ($status === false) {
    //*** function化する！******\
       $error = $stmt->errorInfo();
   exit('SQLError:' . print_r($error, true));
} else {
   header('Location: index.php');
   exit();
}
?>