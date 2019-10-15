<?php
// 関数ファイルの読み込み
include('functions.php');


// getで送信されたidを取得  aタグでid取得しているのでGET
$id = $_GET['id'];

//DB接続します
$pdo = connectToDb();  //connecttodbはfunctions.phpで定義しているもの


//データ登録SQL作成，指定したidのみ表示する
$sql = 'SELECT*FROM gs_bm_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//データ表示
if ($status == false) {
    // エラーのとき
    showSqlErrorMsg($stmt);
} else {
    // エラーでないとき
    $rs = $stmt->fetch();
    //var_dump($rs);
    // fetch()で1レコードを取得して$rsに入れる
    // $rsは配列で返ってくる．$rs["id"], $rs["task"]などで値をとれる
    // var_dump()で見てみよう
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bookmark</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <header>
        <div>
            <h1>Bookmark</h1>
        </div>
        <nav class="nav">
            <ul>
                <li class="btn"><a href="index.php">登録ページ</a></li>
                <li class="btn"><a href="select.php">一覧ページ</a></li>
            </ul>
        </nav>
    </header>

    <form action="update.php" method="POST">
        <div class="form_area">
            <label for="name">書籍名</label><br>
            <input type="text" name="name" value="<?= $rs['name'] ?>"><br>
            <label for="url">書籍のURL</label><br>
            <input type="url" name="url" value="<?= $rs['url'] ?>"><br>
            <label for="comment">感想コメント</label><br>
            <textarea name="comment"><?= $rs['comment'] ?></textarea>

        </div>

        <div class="hyouka">
            <input id="hoshi1" type="radio" name="hoshi" value="<?= $rs['hoshi'] ?>" />
            <label for="hoshi1">★</label>
            <input id="hoshi2" type="radio" name="hoshi" value="<?= $rs['hoshi'] ?>" />
            <label for="hoshi2">★</label>
            <input id="hoshi3" type="radio" name="hoshi" value="<?= $rs['hoshi'] ?>" />
            <label for="hoshi3">★</label>
            <input id="hoshi4" type="radio" name="hoshi" value="<?= $rs['hoshi'] ?>" />
            <label for="hoshi4">★</label>
            <input id="hoshi5" type="radio" name="hoshi" value="<?= $rs['hoshi'] ?>" />
            <label for="hoshi5">★</label>
        </div>


        <div class="submit">
            <button type="submit" class="button">登録</button>
        </div>

        <input type="hidden" name="id" value="<?= $rs['id'] ?>">

    </form>


</body>

</html>