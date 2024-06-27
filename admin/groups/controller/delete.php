<?php

$id_group = _MY_DATA['id_group'];

if(empty(checkPermission($id_group, 'group', 'delete'))){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}

$body = getRequest('get');

if(!empty($body['id'])){
    $id = $body['id'];
    $detailGroup = getRow("SELECT id FROM groups WHERE id='$id'");
    if(!empty($detailGroup)){
        $allUser = getCountRows("SELECT id FROM user WHERE id_group='$id'");
        if(empty($allUser)){
            if(delete('groups', "id='$id'")){
                setFlashData('msgdl', 'Xóa thành công');
                setFlashData('typedl', 'success');
            }else{
                setFlashData('msgdl', 'Lỗi hệ thống');
                setFlashData('typedl', 'danger');
            }
        }else{
            setFlashData('msgdl', 'Vẫn còn tài khoản có cấp bậc này');
            setFlashData('typedl', 'danger');
        }
    }else{
        setFlashData('msgdl', 'Url này không tồn tại !!!');
        setFlashData('typedl', 'danger');
    }
}else{
    setFlashData('msgdl', 'url này lỗi !!!');
    setFlashData('typedl', 'danger');
}

redirect($_SERVER['HTTP_REFERER']);

?>