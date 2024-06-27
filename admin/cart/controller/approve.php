<?php

$body = getRequest('get');

if(!empty($body['id'])){
    $id = $body['id'];
    $detailOrder = getRow("SELECT * FROM order_pro WHERE id='$id'");
    if(!empty($detailOrder)){
        $status = $detailOrder['status'] + 1;
        if($status > 4){
            $status = 1;
        }
        $dataUpdate = [
            'status' => $status
        ];
        if(update('order_pro', $dataUpdate, "id='$id'")){
            setFlashData('msg', 'Cập nhập đơn hàng thành công !!!');
            setFlashData('type', 'success');
        }else{
            setFlashData('msg', 'Lỗi hện thống !!!');
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