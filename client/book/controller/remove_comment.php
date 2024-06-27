<?php

$body = getRequest('get');

if(isLogin() && !empty($body['id'])){
    $id = $body['id'];
    $user_id = isLogin()['user_id'];

    $detailComment = getRow("SELECT id FROM comment WHERE id='$id' AND user_id='$user_id'");
    if(!empty($detailComment)){
        removeComment($id);
    }else{
        setFlashData('msg', 'url này không tồn tại');
        setFlashData('type', 'danger');
        redirect("?module=book");
    }

}else{
    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
    redirect("?module=book");
}

?>