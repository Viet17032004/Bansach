<?php

$body = getRequest('get');

if(!empty($body['cart_id'])){
    $cart_id = $body['cart_id'];
    $detailCart = getRow("SELECT book_id, quantity FROM cart WHERE id='$cart_id'");
    if(!empty($detailCart)){
        $book_id = $detailCart['book_id'];
        $quantity = $detailCart['quantity']+1;
        $detailBook = getRow("SELECT id, quantity FROM book WHERE id='$book_id'");
        // if($quantity > 10) $quantity = 10;
        $dataUpdate = [
            'quantity' => $quantity
        ];
        // $downBook = $detailBook['quantity']-1;
        // if($downBook >= 0){
            if($detailCart ['quantity'] < $detailBook['quantity']):
            if(update('cart', $dataUpdate, "id='$cart_id'")){
                // if($quantity < 10) update('book', ['quantity'=>$downBook], "id='$book_id'");
                // setFlashData('msg', 'Thêm sản phẩm thành công');
                // setFlashData('type', 'success');
            }else{
                setFlashData('msg', 'Thêm sản phẩm thất bại');
                setFlashData('type', 'danger');
            } 
            else:
                setFlashData('msg', 'Không đủ hàng');
                setFlashData('type', 'danger');
            endif;
        // }else{
        //     setFlashData('msg', 'Hết hàng');
        //     setFlashData('type', 'danger');
        // }
    }else{
        setFlashData('msg', 'Thêm sản phẩm thất bại');
        setFlashData('type', 'danger');
    }
}else{
    setFlashData('msg', 'Thêm sản phẩm thất bại');
    setFlashData('type', 'danger');
}

redirect($_SERVER['HTTP_REFERER']);


?>