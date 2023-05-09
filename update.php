<?php 
    require('db_connect.php');
    $stmt = $db->prepare('select * from data where id=?');
    if(!$stmt){
        die($db->error);
    }

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT); //URLの末尾からid番号を取得
    if(!$id){
        echo 'メモが正しく指定されていません';
        exit();
    }
    $stmt->bind_param('i', $id);
    $ret = $stmt->execute();
    if(!$ret){
        die($db->error);
    }

    $stmt->bind_result($id, $title, $document, $updatedAt, $updatedAt);
    $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memo(編集ページ)</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="header wrapper">
        <h1 class="page-title header__title">Memo(編集画面)</h1>
        <p>
            <a href="memo.php?id=<?php echo $id; ?>" class="header__link">→メモへ戻る</a>
        </p>
    </header>
    <div class="memo-update wrapper">
        <form action="update_do.php" method="post" class="memo-update__form">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="title">タイトル</label>
            <input class="memo-update__title" type="text" name="title" id="title" value="<?php echo $title; ?>">
            <label for="document">内容</label>
            <textarea class="memo-update__doc" name="document" id="document"><?php echo $document; ?></textarea>
            <button type="submit" class="memo-update__btn">メモを更新する</button>
        </form>
    </div>
</body>
</html>