<?php
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    if(!$id){
        echo 'メモが正しく指定されていません';
        exit();
    }
    require('db_connect.php');

    $stmt = $db->prepare('delete from data where id=?');
    if(!$stmt){
        die($db->error);
    }
    $stmt->bind_param('i', $id);
    $success = $stmt->execute();
    if(!$success){
        echo 'エラーが発生しました。<br>';
        echo $db->error . '<br>';
        echo '-><a href="delete.php?id=<?php echo $id ?>">メモ更新画面へ</a>';
    }
    header('Location: /Memo');
?>