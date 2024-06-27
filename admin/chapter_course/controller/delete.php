<?php

$id_group = _MY_DATA['id_group'];

if(empty(checkPermission($id_group, 'chapter_course', 'delete'))){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}

$body = getRequest('get');

if(!empty($body['id'])){
    $id = $body['id'];
    $detailChapter = getRow("SELECT id FROM chapter_course WHERE id='$id'");
    if(!empty($detailChapter)){
        $allExercise = getCountRows("SELECT id FROM exercise_course WHERE chapter_id='$id'");
        if(empty($allExercise)){
            if(delete('chapter_course', "id='$id'")){
                setFlashData('msgdl', 'Xóa thành công');
                setFlashData('typedl', 'success');
            }else{
                setFlashData('msgdl', 'Lỗi hệ thống');
                setFlashData('typedl', 'danger');
            }
        }else{
            setFlashData('msgdl', 'Chương này vẫn còn bài');
            setFlashData('typedl', 'danger');
        }
    }else{
        setFlashData('msgdl', 'url này không tồn tại !!!');
        setFlashData('typedl', 'danger');
    }
}else{
    setFlashData('msgdl', 'url này lỗi !!!');
    setFlashData('typedl', 'danger');
}

redirect($_SERVER['HTTP_REFERER']);

?>