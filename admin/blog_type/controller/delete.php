<?php

$id_group = _MY_DATA['id_group'];

if(empty(checkPermission($id_group, 'blog_type', 'delete'))){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}

$body = getRequest('get');

if(!empty($body['id'])){
    $id = $body['id'];
    $detailBlogType = getRow("SELECT id FROM blog_type WHERE id='$id'");
    if(!empty($detailBlogType)){
        $allBlog = getCountRows("SELECT id FROM blog WHERE blog_type_id='$id'");
        if(empty($allBlog)){
            if(delete('blog_type', "id='$id'")){
                setFlashData('msgdl', 'Xóa thành công');
                setFlashData('typedl', 'success');
            }else{
                setFlashData('msgdl', 'Lỗi hệ thống');
                setFlashData('typedl', 'danger');
            }
        }else{
            setFlashData('msgdl', 'Vẫn còn tin tức sử dụng loại tin tức này');
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