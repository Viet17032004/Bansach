<?php

$group_id = _MY_DATA['id_group'];

if(!checkPermission($group_id, 'exam', 'approve')){
    redirect(_WEB_HOST_ERORR."/permission.php");
}

$body = getRequest('get');

if(!empty($body['id'])){
    $id = $body['id'];
    require _WEB_PATH_ROOT.'/admin/exam/model/approve.php';

    if(!empty($detailExam)){
        if($detailExam['status'] == 0){
            $statusUpdate = update(
                'exam',
                [
                    'status' => 1
                ],
                "id='$id'"
            );
        }
        if($detailExam['status'] == 1){
            $statusUpdate = update(
                'exam',
                [
                    'status' => 0
                ],
                "id='$id'"
            );
        }

        if($statusUpdate){
            setFlashData('msg', 'Cập nhật thành công !!!');
            setFlashData('type', 'success');
        }else{
            setFlashData('msg', 'Lỗi hệ thống');
            setFlashData('type', 'danger');
        }

    }else{
        setFlashData('msg', 'url này không tồn tại');
        setFlashData('type', 'danger');
    }
}else{
    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
}

redirect($_SERVER['HTTP_REFERER']);


?>