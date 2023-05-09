<?php
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    if(!$id){
        echo 'メモが正しく指定されていません';
        exit();
    }
    require('db_connect.php');
    $stmt = $db->prepare('select * from data where id=?');
    if(!$stmt){
        die($db->error);
    }
    $stmt->bind_param('i', $id);
    $ret = $stmt->execute();
    if(!$ret){
        die($db->error);
    }
    $stmt->bind_result($id, $title, $document, $createdAt, $updatedAt);
    $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memo(削除画面)</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="header wrapper">
        <h1 class="page-title">Memo(削除画面)</h1>
        <p>
            <a href="memo.php?id=<?php echo $id; ?>" class="header__link">→メモへ戻る</a>
        </p>
    </header>
    <div class="memo-delete wrapper">
        <h2 class="memo-delete__title">
                <span class="memo-delete__sub-title">〜タイトル〜</span><br>
                <span><?php echo htmlspecialchars($title); ?></span>
        </h2>
        <hr>
        <p class="memo-delete__document">
            <span class="memo-delete__sub-title">〜内容〜</span><br>
            <span><?php echo htmlspecialchars($document); ?></span>
        </p>
        <p class="memo-delete__time">
            <span>最終更新日時 : </span>
            <span><time><?php echo $updatedAt; ?></time></span>
        </p>
        <form action="delete_do.php" class="memo-delete__form">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type=submit class="memo-delete__btn">削除する</button>
        </form>
    </div>
</body>
</html>