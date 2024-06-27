<?php

$id_group = _MY_DATA['id_group'];

if(empty(checkPermission($id_group, 'book', 'delete'))){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}

$body = getRequest('get');

if(!empty($body['id'])){
    $id = $body['id'];
    $detailBook = getRow("SELECT id FROM book WHERE id='$id'");
    if(!empty($detailBook)){
        
        $allCart = getRaw("SELECT id FROM cart WHERE book_id='$id'");
        $allCartOrder = getRaw("SELECT id FROM cart_order WHERE book_id='$id'");
        $allStar = getRaw("SELECT id FROM star_rating WHERE book_id='$id'");
        $allComment = getRaw("SELECT id FROM comment WHERE book_id='$id'");

        if(empty($allCart) && empty($allCartOrder) && empty($allStar) && empty($allComment)){
            if(delete('book', "id='$id'")){
                setFlashData('msg', 'Xóa thành công');
                setFlashData('type', 'success');
            }else{
                setFlashData('msg', 'Lỗi hệ thống');
                setFlashData('type', 'danger');
            }
        }else{
            setFlashData('msg', 'sách này vẫn còn liên kết');
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