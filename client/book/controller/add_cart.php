<?php

if(!isLogin()){
    setFlashData("msg", "Bạn phải đăng nhập");
    setFlashData("type", "danger");
    redirect($_SERVER['HTTP_REFERER']);
}else{
    $user_id = isLogin()['user_id'];
}

$body = getRequest("get");

if(!empty($body['id'])){
    $id = $body['id'];
    $detailBook = getRow("SELECT id, quantity FROM book WHERE id='$id'");
    if(!empty($detailBook)){
        if($detailBook['quantity'] > 0){
            $detailCart = getRow("SELECT id, quantity FROM cart WHERE user_id='$user_id' AND book_id='$id'");
            if(!empty($detailCart)){
                // if($detailCart['quantity'] >= 10){
                if(false){
                    // setFlashData("msg", "Bạn không thể thêm quá 10 sản phẩm");
                    // setFlashData("type", "danger");
                }else{
                    $cart_id = $detailCart['id'];
                    $quantity = $detailCart['quantity']+1;
                    $dataUpdate = [
                        'quantity' => $quantity
                    ];
                    if(update('cart', $dataUpdate, "id='$cart_id'")){
                        // $downBook = $detailBook['quantity']-1;
                        // update('book', ['quantity'=>$downBook], "id='$id'");
                        setFlashData("msg", "Thêm hàng thành công");
                        setFlashData("type", "success");
                    }else{
                        setFlashData("msg", "Thêm hàng thất bại");
                        setFlashData("type", "danger");
                    }
                }
            }else{
                $dataInsert = [
                    'user_id' => $user_id,
                    'book_id' => $id,
                    'quantity' => 1
                ];
                if(insert("cart", $dataInsert)){
                    // $downBook = $detailBook['quantity']-1;
                    // update('book', ['quantity'=>$downBook], "id='$id'");
                    setFlashData("msg", "Thêm hàng thành công");
                    setFlashData("type", "success");
                }else{
                    setFlashData("msg", "Thêm hàng thất bại");
                    setFlashData("type", "danger");
                }
            }
        }else{
            setFlashData("msg", "Hết hàng");
            setFlashData("type", "danger");
        }
    }else{
        setFlashData("msg", "url này lỗi");
        setFlashData("type", "danger");
    }
}else{
    setFlashData("msg", "url này lỗi");
    setFlashData("type", "danger");
}

redirect($_SERVER['HTTP_REFERER']);

?>