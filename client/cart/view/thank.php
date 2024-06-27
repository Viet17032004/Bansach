
<div class="container_my padding_X">








<?php

$inforOrder = getSession('infor_order');
$code_cart = getSession('code_cart');

if(empty(getSession('infor_order')) || empty(getSession('code_cart')) || !isLogin()){
    redirect(_WEB_HOST_ROOT);
}

$errorQuantity = true;
$user_id = isLogin()['user_id'];
$allCart = getRaw("SELECT * FROM cart WHERE user_id='$user_id'");

foreach ($allCart as $key => $value) {
    $book_id = $value['book_id'];
    $detailBook = getRow("SELECT quantity FROM book WHERE id='$book_id'");
    if($value['quantity'] > $detailBook['quantity']){
        $errorQuantity = false;
    }
}


$body = getRequest('get');

if(!empty($errorQuantity)):
if(!empty($body['vnp_BankTranNo'])){


        $user_id = isLogin()['user_id'];
        $fullname = $inforOrder['fullname'];
        $email = $inforOrder['email'];
        $phone = $inforOrder['phone'];
        $address = $inforOrder['address'];
        $allCart = getRaw("SELECT * FROM cart WHERE user_id='$user_id'");
   
        foreach ($allCart as $key => $value) {
            $book_id = $value['book_id'];
            $detailBook = getRow("SELECT * FROM book WHERE id='$book_id'");
            $dataInsert = [
                'book_id' => $book_id,
                'code_cart' => $code_cart,
                'title' => $detailBook['title'],
                'image' => $detailBook['image'],
                'quantity' => $value['quantity'],
                'price' => $detailBook['price'],
                'create_at' => date('Y-m-d H:i:s')
            ];
            $quantity = $detailBook['quantity']-$value['quantity'];
            if(insert('cart_order', $dataInsert)){
                $dataUpdate = [
                    'quantity' => $quantity
                ];
                update("book", $dataUpdate, "id='$book_id'");
            }
        }

        $dataInsertOrder = [
        'user_id' => $user_id,
        'code_order' => $code_cart,
        'pay_type' => 'vnpay',
        'fullname' => $fullname,
        'email' => $email,
        'phone' => $phone,
        'address' => $address,
        'total' => $body['vnp_Amount']/100,
        'status' => 1,
        'status_pay' => 1,
        'create_at' => date('Y-m-d H:i:s')
        ];

        $dataInsertVnpay = [
            'code_cart' => $code_cart,
            'vnp_Amount' => $body['vnp_Amount']/100,
            'vnp_BankCode' => $body['vnp_BankCode'],
            'vnp_BankTranNo' => $body['vnp_BankTranNo'],
            'vnp_CardType' => $body['vnp_CardType'],
            'vnp_OrderInfo' => $body['vnp_OrderInfo'],
            'vnp_PayDate' => date('Y-m-d H:i:s'),
            'vnp_TmnCode' => $body['vnp_TmnCode'],
            'vnp_TransactionNo' => $body['vnp_TransactionNo'],
            'create_at' => date('Y-m-d H:i:s'),
        ];

        if(insert('tbl_vnpay', $dataInsertVnpay) && insert('order_pro', $dataInsertOrder)){
            delete('cart', "user_id='$user_id'");
            removeSession('code_cart');
            removeSession('infor_order');
            view('text_thank', 'client', 'cart');
        }

}elseif(empty($body['resultCode']) && !empty($body['partnerCode'])){

    $user_id = isLogin()['user_id'];
    $fullname = $inforOrder['fullname'];
    $email = $inforOrder['email'];
    $phone = $inforOrder['phone'];
    $address = $inforOrder['address'];
    $allCart = getRaw("SELECT * FROM cart WHERE user_id='$user_id'");

    foreach ($allCart as $key => $value) {
        $book_id = $value['book_id'];
        $detailBook = getRow("SELECT * FROM book WHERE id='$book_id'");
        $dataInsert = [
            'book_id' => $book_id,
            'code_cart' => $code_cart,
            'title' => $detailBook['title'],
            'image' => $detailBook['image'],
            'quantity' => $value['quantity'],
            'price' => $detailBook['price'],
            'create_at' => date('Y-m-d H:i:s')
        ];
        $quantity = $detailBook['quantity']-$value['quantity'];
        if(insert('cart_order', $dataInsert)){
            $dataUpdate = [
                'quantity' => $quantity
            ];
            update("book", $dataUpdate, "id='$book_id'");
        }
    }

    $dataInsertOrder = [
        'user_id' => $user_id,
        'code_order' => $code_cart,
        'pay_type' => 'momo',
        'fullname' => $fullname,
        'email' => $email,
        'phone' => $phone,
        'address' => $address,
        'total' => $body['amount'],
        'status' => 1,
        'status_pay' => 1,
        'create_at' => date('Y-m-d H:i:s')
        ];

    $dataInsertMoMoATM = [
        'code_cart' => $code_cart,
        'partnerCode' => $body['payType'],
        'orderId' => $body['orderId'],
        'amount' => $body['amount'],
        'orderInfo' => $body['orderInfo'],
        'orderType' => $body['orderType'],
        'transId' => $body['transId'],
        'payType' => $body['payType'],
        'create_at' => date('Y-m-d H:i:s'),
    ];

    if(insert('tbl_momo', $dataInsertMoMoATM) && insert('order_pro', $dataInsertOrder)){
        delete('cart', "user_id='$user_id'");
        removeSession('code_cart');
        removeSession('infor_order');
        view('text_thank', 'client', 'cart');
    }

}elseif(!empty($body['pay_type'])){

    $pay_type = $body['pay_type'];

    if($pay_type == 'cash' OR $pay_type == 'cash_online'){  

    $user_id = isLogin()['user_id'];
    $fullname = $inforOrder['fullname'];
    $email = $inforOrder['email'];
    $phone = $inforOrder['phone'];
    $address = $inforOrder['address'];
    $allCart = getRaw("SELECT * FROM cart WHERE user_id='$user_id'");

    foreach ($allCart as $key => $value) {
        $book_id = $value['book_id'];
        $detailBook = getRow("SELECT * FROM book WHERE id='$book_id'");
        $dataInsert = [
            'book_id' => $book_id,
            'code_cart' => $code_cart,
            'title' => $detailBook['title'],
            'image' => $detailBook['image'],
            'quantity' => $value['quantity'],
            'price' => $detailBook['price'],
            'create_at' => date('Y-m-d H:i:s')
        ];
        $quantity = $detailBook['quantity']-$value['quantity'];
        if(insert('cart_order', $dataInsert)){
            $dataUpdate = [
                'quantity' => $quantity
            ];
            update("book", $dataUpdate, "id='$book_id'");
        }
    }

    $dataInsertOrder = [
        'user_id' => $user_id,
        'code_order' => $code_cart,
        'pay_type' => $body['pay_type'],
        'fullname' => $fullname,
        'email' => $email,
        'phone' => $phone,
        'address' => $address,
        'total' => $body['amount'],
        'status' => 1,
        'status_pay' => 0,
        'create_at' => date('Y-m-d H:i:s')
        ];

    if(insert('order_pro', $dataInsertOrder)){
        delete('cart', "user_id='$user_id'");
        removeSession('code_cart');
        removeSession('infor_order');
        view('text_thank', 'client', 'cart');
    }

    }else{
        setFlashData('msg', 'Thanh toán thất bại');
        setFlashData('type', 'danger');
        redirect('?module=book');
    }   

}else{


    setFlashData('msg', 'Thanh toán thất bại');
    setFlashData('type', 'danger');
    redirect('?module=cart');
}

else:
    setFlashData('msg', 'Không đủ số lượng hàng');
    setFlashData('type', 'danger');
    redirect('?module=cart');
endif;

?>
















</div>