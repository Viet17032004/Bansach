<div class="container_my padding_X">

<?php

$errorQuantity = true;
$user_id = isLogin()['user_id'];
$allCart = getRaw("SELECT * FROM cart WHERE user_id='$user_id'");

foreach ($allCart as $key => $value) {
    $book_id = $value['book_id'];
    $detailBook = getRow("SELECT quantity FROM book WHERE id='$book_id'");
    if($value['quantity'] > $detailBook['quantity']){
        $errorQuantity = false;
        break;
    }
}

if(empty($errorQuantity)){
    setFlashData('msg', 'Không đủ số lượng hàng');
    setFlashData('type', 'danger');
    redirect('?module=cart');
    die;
}

$body = getRequest('post');

if(empty($body['fullname'])){
    $errors['fullname'] = 'Vui lòng nhập thông tin';
}else{
    if(strlen(trim($body['fullname'])) < 5){
        $errors['fullname'] = 'Tên không thể dưới 5 ký tự';
    }
}

if(empty($body['email'])){
    $errors['email'] = 'Vui lòng nhập thông tin';
}else{
    if(!preg_match('~[^@]{2,64}@[^.]{2,253}\.[0-9a-z-.]{2,63}~', $body['email'])){
        $errors['email'] = 'Vui lòng nhập đúng định dạng email';
    }else{
        // if(getCountRows("SELECT id FROM user WHERE email='$email' AND id<>'$id'")){
        //     $errors['email'] = 'Email này đã có trên hệ thống';
        // }
    }
}

if(empty($body['phone'])){
    $phone = $body['phone'];
    $errors['phone'] = 'Vui lòng nhập thông tin';
}else{
    if(!preg_match('~^0[0-9]{9}$~', $body['phone'])){
        $errors['phone'] = 'Vui lòng nhập đúng định dạng số điện thoại việt nam';
    }else{
        // if(getCountRows("SELECT id FROM user WHERE id<>'$id' AND phone='$phone'")){
        //     $errors['phone'] = 'Số điện thoại này đã có trên hệ thống';
        // }
    }
}

if(empty($body['address'])){
    $errors['address'] = 'Vui lòng nhập thông tin';
}else{
        if(strlen(trim($body['address'])) < 20){
        $errors['address'] = 'Địa chỉ không thể dưới 20 ký tự';
    }
}

if(empty($body['pay_type'])){
    $errors['pay_type'] = 'Vui lòng chọn phương thức thanh toán';
}

if(empty($errors)):

$arrInfor = [
    'fullname' => $body['fullname'],
    'email' => $body['email'],
    'phone' => $body['phone'],
    'address' => $body['address']
];

setSession('infor_order', $arrInfor);

$code_order = 'CART-'.strtotime(date('Y-m-d H:i:s')).rand(1,100);

if(!empty($body['pay_type'])){

if($body['pay_type'] == 'cash' || $body['pay_type'] == 'cash_online'){

    $pay_type = $body['pay_type'];
    $total = $body['total'];

    setSession('code_cart', $code_order);

    redirect("?module=cart&action=thank&pay_type=$pay_type&amount=$total");

    // setFlashData('msg', 'Phương thức này đang bảo trì');
    // setFlashData('type', 'danger');
    // redirect($_SERVER['HTTP_REFERER']);

}elseif($body['pay_type'] == 'vnpay'){
 
    $dataVNPay = [
        'code_order' => $code_order,
        'total' => $body['total']
    ];

    controller('pay_vnpay', 'client', 'cart', $dataVNPay);


}elseif($body['pay_type'] == 'momo_qr'){

    $dataMoMo = [
        'code_order' => $code_order,
        'total' => $body['total']
    ];

    controller('handle_momo_qr', 'client', 'cart', $dataMoMo);

}elseif($body['pay_type'] == 'momo_atm'){

    $dataMoMo = [
        'code_order' => $code_order,
        'total' => $body['total']
    ];

    controller('handle_momo_atm', 'client', 'cart', $dataMoMo);

}elseif($body['pay_type'] == 'paypal'){
    setFlashData('msg', 'Phương thức này đang bảo trì');
    setFlashData('type', 'danger');
    redirect($_SERVER['HTTP_REFERER']);
}

}else{
setFlashData('msg', 'Vui lòng chọn phương thức thanh toán');
setFlashData('type', 'danger');
redirect($_SERVER['HTTP_REFERER']);
}

else:

    setFlashData('msg', 'Vui lòng kiểm tra form');
    setFlashData('type', 'danger');
    setFlashData('errors', $errors);
    setFlashData('old', $body);
    redirect("?module=cart&action=order#form");

endif;

?>

</div>