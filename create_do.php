<?php 
    require('db_connect.php');
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    $document = filter_input(INPUT_POST, 'document', FILTER_SANITIZE_SPECIAL_CHARS);

    $stmt = $db->prepare('insert into data(title, document) values(?, ?)');
    if(!$stmt){
        die($db->error);
    }
    $stmt->bind_param('ss', $title, $document);
    $success = $stmt->execute();

    if($success){
        header('Location: /Memo');
    } else {
        echo 'エラーが発生しました。<br>';
        echo $db->error . '<br>';
        echo '<br>-><a href="create.html">新規メモ作成画面</a>';
    }
?>