<?php
    require('db_connect.php');

    $memos = $db->query('select * from data order by updatedAt desc');
    if(!$memos){
        die($db->error);
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memo - ホーム</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="header wrapper">
        <h1 class="page-title header__title">Memo(ホーム画面)</h1>
        <p>
            <a href="create.html" class="header__link">→新規メモを作成</a>
        </p>
    </header>
    <main>
        <div class="memo-list wrapper">
            <?php while($memo = $memos->fetch_assoc()): ?>
                <article class="memo-list__content">
                    <a href="memo.php?id=<?php echo $memo['id'] ?>" class="memo-list__link">
                        <h2 class="memo-list__title"><?php echo htmlspecialchars(mb_substr($memo['title'], 0, 24)); ?></h2>
                        <p class="memo-list__time"><time><?php echo htmlspecialchars($memo['updatedAt']); ?></time></p>
                    </a>
                </article>
            <?php endwhile; ?>
        </div>
    </main>
</body>
</html>