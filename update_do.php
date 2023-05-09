<?php
    require('db_connect.php');

    $stmt = $db->prepare('update data set title=?, document=?, updatedAt=? where id=?');
    if(!$stmt){
        die($db->error);
    }

    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT); 
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    $document = filter_input(INPUT_POST, 'document', FILTER_SANITIZE_SPECIAL_CHARS);

    //タイムゾーンを日本に変更し、現在の日付時刻を取得
    date_default_timezone_set('Asia/Tokyo');
    $updatedAt = date('Y-m-d H:i:s');
    
    $stmt->bind_param('sssi', $title, $document, $updatedAt, $id);
    $ret = $stmt->execute();
    if($ret){
        header('Location: memo.php?id=' . $id);
    }else {
        echo 'エラーが発生しました。<br>';
        echo $db->error . '<br>';
        echo '<br>-><a href="update.php?id=<?php echo $id ?>">メモ更新画面へ</a>';
    }
?>