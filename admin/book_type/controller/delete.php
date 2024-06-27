<?php

$id_group = _MY_DATA['id_group'];

if(empty(checkPermission($id_group, 'book_type', 'delete'))){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}

$body = getRequest('get');

if(!empty($body['id'])){
    $id = $body['id'];
    $detailBookType = getRow("SELECT id FROM book_type WHERE id='$id'");
    if(!empty($detailBookType)){
        $allBook = getCountRows("SELECT id FROM book WHERE book_type_id='$id'");
        if(empty($allBook)){
            if(delete('book_type', "id='$id'")){
                setFlashData('msgdl', 'Xóa thành công');
                setFlashData('typedl', 'success');
            }else{
                setFlashData('msgdl', 'Lỗi hệ thống');
                setFlashData('typedl', 'danger');
            }
        }else{
            setFlashData('msgdl', 'Vẫn còn sách sử dụng loại sách này');
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