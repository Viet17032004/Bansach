<?php

$id_group = _MY_DATA['id_group'];

if(empty(checkPermission($id_group, 'blog', 'delete'))){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}

$body = getRequest('get');

if(!empty($body['id'])){
    $id = $body['id'];
    $detailBlog = getRow("SELECT id FROM blog WHERE id='$id'");
    if(!empty($detailBlog)){
        if(delete('blog', "id='$id'")){
            setFlashData('msg', 'Xóa thành công');
            setFlashData('type', 'success');
        }else{
            setFlashData('msg', 'Lỗi hệ thống');
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