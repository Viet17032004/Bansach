<?php

$id_group = _MY_DATA['id_group'];

if(empty(checkPermission($id_group, 'exercise_course', 'delete'))){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}

$body = getRequest('get');

if(!empty($body['id'])){
    $id = $body['id'];
    $detailExercise = getRow("SELECT id FROM exercise_course WHERE id='$id'");
    if(!empty($detailExercise)){
        if(delete('exercise_course', "id='$id'")){
            setFlashData('msgdl', 'Xóa thành công !!!');
            setFlashData('typedl', 'success');
        }else{
            setFlashData('msgdl', 'Lỗi hệ thống !!!');
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