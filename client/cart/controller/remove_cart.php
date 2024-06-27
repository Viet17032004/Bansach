
<?php

$body = getRequest('get');

if(!empty($body['cart_id'])){
    $cart_id = $body['cart_id'];
    $detailCart = getRow("SELECT quantity, book_id FROM cart WHERE id='$cart_id'");
    if(!empty($detailCart)){
        // $book_id = $detailCart['book_id'];
        // $quantity = $detailCart['quantity'];
        if(delete('cart', "id='$cart_id'")){
            // $detailBook = getRow("SELECT quantity FROM book WHERE id='$book_id'");
            // $dataUpdate = [
            //     'quantity' => $detailBook['quantity']+$quantity
            // ];
            // update('book', $dataUpdate, "id='$book_id'");
            setFlashData('msg', 'Xóa sản phẩm thành công');
            setFlashData('type', 'success');
        }else{
            setFlashData('msg', 'Xóa sản phẩm thất bại');
            setFlashData('type', 'danger');
        }

    }else{
        setFlashData('msg', 'Xóa sản phẩm thất bại');
        setFlashData('type', 'danger');
    }
}else{
    setFlashData('msg', 'Xóa sản phẩm thất bại');
    setFlashData('type', 'danger');
}

redirect($_SERVER['HTTP_REFERER']);


?>


?>