<?php
require('db_connect.php');

$stmt = $db->prepare('select * from data where id=?');
if(!$stmt){
    die($db->error);
}
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$stmt->bind_param('i', $id);
$result = $stmt->execute();
if(!$result){
    echo '指定されたメモが存在しません';
}
$stmt->bind_result($id, $title, $document, $createdAt, $updatedAt);
$stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memo - <?php echo htmlspecialchars($title); ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="header wrapper">
        <h1 class="page-title">Memo(詳細ページ)</h1>
        <p>
            <a href="/Memo" class="header__link">→一覧へ戻る</a>
        </p>
        <p>
            <a href="update.php?id=<?php echo $id; ?>" class="header__link">メモを編集</a> | 
            <a href="delete.php?id=<?php echo $id; ?>" class="header__link">メモを削除</a> 
        </p>
    </header>
    <main>
        <div class="memo-detail wrapper">
            <h2 class="memo-detail__title">
                <span class="memo-detail__sub-title">〜タイトル〜</span><br>
                <span><?php echo htmlspecialchars($title); ?></span>
            </h2>
            <hr>
            <p class="memo-detail__document">
                <span class="memo-detail__sub-title">〜内容〜</span><br>
                <span><?php echo htmlspecialchars($document); ?></span>
            </p>
            <p class="memo-detail__time">
                <span>最終更新日時 : </span>
                <span><time><?php echo $updatedAt; ?></time></span>
            </p>
        </div>
    </main>
</body>
</html>