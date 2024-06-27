<?php

$body = getRequest('get');

if(!empty($body['cart_id'])){
    $cart_id = $body['cart_id'];
    $detailCart = getRow("SELECT book_id, quantity FROM cart WHERE id='$cart_id'");
    if(!empty($detailCart)){
        $book_id = $detailCart['book_id'];
        $quantity = $detailCart['quantity']-1;
        if($quantity <= 0) $quantity = 1;
        $dataUpdate = [
            'quantity' => $quantity
        ];

        if(update('cart', $dataUpdate, "id='$cart_id'")){
            // $detailBook = getRow("SELECT id, quantity FROM book WHERE id='$book_id'");
            // $downBook = $detailBook['quantity']+1;
            // echo $downBook;
            // // die;
            // if($quantity > 1) update('book', ['quantity'=>$downBook], "id='$book_id'");
            // setFlashData('msg', 'Giảm sản phẩm thành công');
            // setFlashData('type', 'success');
        }else{
            setFlashData('msg', 'Giảm sản phẩm thất bại');
            setFlashData('type', 'danger');
        }
    }else{
        setFlashData('msg', 'Giảm sản phẩm thất bại');
        setFlashData('type', 'danger');
    }
}else{
    setFlashData('msg', 'Giảm sản phẩm thất bại');
    setFlashData('type', 'danger');
}

redirect($_SERVER['HTTP_REFERER']);


?>