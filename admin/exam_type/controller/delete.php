<?php

$id_group = _MY_DATA['id_group'];

if(empty(checkPermission($id_group, 'exam_type', 'delete'))){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}

$body = getRequest('get');

if(!empty($body['id'])){
    $id = $body['id'];
    $detailExamType = getRow("SELECT id FROM exam_type WHERE id='$id'");
    if(!empty($detailExamType)){
        $allExam = getCountRows("SELECT id FROM exam WHERE exam_type_id='$id'");
        if(empty($allExam)){
            if(delete('exam_type', "id='$id'")){
                setFlashData('msgdl', 'Xóa thành công');
                setFlashData('typedl', 'success');
            }else{
                setFlashData('msgdl', 'Lỗi hệ thống');
                setFlashData('typedl', 'danger');
            }
        }else{
            setFlashData('msgdl', 'Vẫn còn bài kiểm tra sử dụng loại bài kiểm tra này');
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