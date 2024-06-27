<?php

$id_group = _MY_DATA['id_group'];

if(empty(checkPermission($id_group, 'exam', 'delete'))){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}

$body = getRequest('get');

if(!empty($body['id'])){
    $id = $body['id'];
    $detailExam = getRow("SELECT id FROM exam WHERE id='$id'");
    if(!empty($detailExam)){

        $allMakeExam = getRaw("SELECT id FROM make_exam WHERE exam_id='$id'");
        $allQuestion = getRaw("SELECT id FROM question_exam WHERE exam_id='$id'");
        $allResultExam = getRaw("SELECT id FROM result_exam WHERE exam_id='$id'");

        if(empty($allMakeExam) && empty($allQuestion) && empty($allResultExam)){
            if(delete('exam', "id='$id'")){
                setFlashData('msg', 'Xóa thành công !!!');
                setFlashData('type', 'success');
            }else{
                setFlashData('msg', 'Lỗi hệ thống !!!');
                setFlashData('type', 'danger');
            }
        }else{
            setFlashData('msg', 'bài kiểm tra này vẫn còn liên kết !!!');
            setFlashData('type', 'danger');
        }

    }else{
        setFlashData('msg', 'url này không tồn tại !!!');
        setFlashData('type', 'danger');
    }
}else{
    setFlashData('msg', 'url này lỗi !!!');
    setFlashData('type', 'danger');
}

redirect($_SERVER['HTTP_REFERER']);

?>