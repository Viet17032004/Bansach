

<?php

$data = [
    'titlePage' => 'Cảm ơn'
];

layout('header', 'client', $data);

?>


<div class="container_my padding_X">

<?php


if(!isLogin() || empty(getSession('cart_book'))){
    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
    redirect("?module=book");
}

$inforOrder = getSession('cart_book');

$body = getRequest('get');

    $user_id = isLogin()['user_id'];

    $book_id = $inforOrder['book_id'];

    $code_cart = $inforOrder['code_cart'];

    $pay_type = $inforOrder['pay_type'];

if(!empty($body['vnp_BankTranNo'])){


    $user_id = $user_id;
    $fullname = $inforOrder['fullname'];
    $email = $inforOrder['email'];
    $phone = $inforOrder['phone'];
    $address = $inforOrder['address'];

        $detailBook = getRow("SELECT * FROM book WHERE id='$book_id'");
        $dataInsert = [
            'book_id' => $book_id,
            'code_cart' => $code_cart,
            'title' => $detailBook['title'],
            'image' => $detailBook['image'],
            'quantity' => $inforOrder['quantity'],
            'price' => $detailBook['price'],
            'create_at' => date('Y-m-d H:i:s')
        ];
        $quantity = $detailBook['quantity']-$inforOrder['quantity'];
        if(insert('cart_order', $dataInsert)){
            $dataUpdate = [
                'quantity' => $quantity
            ];
            update("book", $dataUpdate, "id='$book_id'");
        }

    $dataInsertOrder = [
    'user_id' => $user_id,
    'code_order' => $code_cart,
    'pay_type' => 'vnpay',
    'fullname' => $fullname,
    'email' => $email,
    'phone' => $phone,
    'address' => $address,
    'total' => $inforOrder['total'],
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
        removeSession('cart_book');
        removeSession('data_book');
        view('text_thank', 'client', 'cart');
    }



}elseif(empty($body['resultCode']) && !empty($body['partnerCode'])){

    $user_id = $user_id;
    $fullname = $inforOrder['fullname'];
    $email = $inforOrder['email'];
    $phone = $inforOrder['phone'];
    $address = $inforOrder['address'];

        $detailBook = getRow("SELECT * FROM book WHERE id='$book_id'");
        $dataInsert = [
            'book_id' => $book_id,
            'code_cart' => $code_cart,
            'title' => $detailBook['title'],
            'image' => $detailBook['image'],
            'quantity' => $inforOrder['quantity'],
            'price' => $detailBook['price'],
            'create_at' => date('Y-m-d H:i:s')
        ];
        $quantity = $detailBook['quantity']-$inforOrder['quantity'];
        if(insert('cart_order', $dataInsert)){
            $dataUpdate = [
                'quantity' => $quantity
            ];
            update("book", $dataUpdate, "id='$book_id'");
        }

    $dataInsertOrder = [
    'user_id' => $user_id,
    'code_order' => $code_cart,
    'pay_type' => 'momo',
    'fullname' => $fullname,
    'email' => $email,
    'phone' => $phone,
    'address' => $address,
    'total' => $inforOrder['total'],
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
        removeSession('cart_book');
        removeSession('data_book');
        view('text_thank', 'client', 'cart');
    }

}elseif(!empty($pay_type)){

    echo 123;

    if($pay_type == 'cash' OR $pay_type == 'cash_online'){
    $user_id = $user_id;
    $fullname = $inforOrder['fullname'];
    $email = $inforOrder['email'];
    $phone = $inforOrder['phone'];
    $address = $inforOrder['address'];

    $detailBook = getRow("SELECT * FROM book WHERE id='$book_id'");
    $dataInsert = [
        'book_id' => $book_id,
        'code_cart' => $code_cart,
        'title' => $detailBook['title'],
        'image' => $detailBook['image'],
        'quantity' => $inforOrder['quantity'],
        'price' => $detailBook['price'],
        'create_at' => date('Y-m-d H:i:s')
    ];
    $quantity = $detailBook['quantity']-$inforOrder['quantity'];
    if(insert('cart_order', $dataInsert)){
        $dataUpdate = [
            'quantity' => $quantity
        ];
        update("book", $dataUpdate, "id='$book_id'");
    }

    $dataInsertOrder = [
    'user_id' => $user_id,
    'code_order' => $code_cart,
    'pay_type' => $pay_type,
    'fullname' => $fullname,
    'email' => $email,
    'phone' => $phone,
    'address' => $address,
    'total' => $inforOrder['total'],
    'status' => 1,
    'status_pay' => 0,
    'create_at' => date('Y-m-d H:i:s')
    ];
        
    if(insert('order_pro', $dataInsertOrder)){
        removeSession('cart_book');
        removeSession('data_book');
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
    redirect('?module=book');
}


?>


</div>


<?php layout('footer', 'client'); ?>