<?php

$group_id = _MY_DATA['id_group'];

if(!checkPermission($group_id, 'comment', 'remove_comment')){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}

$body = getRequest('get');

if(isLogin() && !empty($body['id'])){
    $id = $body['id'];
    $detailComment = getRow("SELECT id FROM comment WHERE id='$id'");
    if(!empty($detailComment)){
        removeComment($id);
    }else{
        setFlashData('msg', 'url này không tồn tại');
        setFlashData('type', 'danger');
        redirect("?module=comment&action=lists_book");
    }

}else{
    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
    redirect("?module=comment&action=lists_book");
}

?>