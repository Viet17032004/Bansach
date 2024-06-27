<div class="container_my padding_X">

<?php

$data = getRequest();

$errors = [];

if(empty($data['fullname'])){
    $errors['fullname'] = 'Vui lòng nhập thông tin';
}else{
    if(strlen(trim($data['fullname'])) < 5){
        $errors['fullname'] = 'Tên không thể dưới 5 ký tự';
    }
}

if(empty($data['email'])){
    $errors['email'] = 'Vui lòng nhập thông tin';
}else{
    if(!preg_match('~[^@]{2,64}@[^.]{2,253}\.[0-9a-z-.]{2,63}~', $data['email'])){
        $errors['email'] = 'Vui lòng nhập đúng định dạng email';
    }
}

if(empty($data['phone'])){
    $phone = $data['phone'];
    $errors['phone'] = 'Vui lòng nhập thông tin';
}else{
    if(!preg_match('~^0[0-9]{9}$~', $data['phone'])){
        $errors['phone'] = 'Vui lòng nhập đúng định dạng số điện thoại việt nam';
    }
}

if(empty($data['address'])){
    $errors['address'] = 'Vui lòng nhập thông tin';
}else{
        if(strlen(trim($data['address'])) < 20){
        $errors['address'] = 'Địa chỉ không thể dưới 20 ký tự';
    }
}

if(empty($data['pay_type'])){
    $errors['pay_type'] = 'Vui lòng chọn phương thức thanh toán';
}

if(empty($errors)){

    $dataOrder = [
        'code_cart' => 'CART-'.time().rand(0, 100),
        'fullname' => $data['fullname'],
        'email' => $data['email'],
        'phone' => $data['phone'],
        'address' => $data['address'],
        'book_id' => $data['book_id'],
        'quantity' => $data['quantity'],
        'pay_type' => $data['pay_type'],
        'total' => $data['total'],
    ];

    setSession('cart_book', $dataOrder);

}else{

    setFlashData('msg', 'Vui lòng kiểm tra form');
    setFlashData('type', 'danger');
    setFlashData('errors', $errors);
    setFlashData('old', $data);
    redirect("?module=book&action=buy_book#form");

}

if(!empty($data['pay_type'])){

if($data['pay_type'] == 'cash' || $data['pay_type'] == 'cash_online'){

     redirect("?module=book&action=thank");


}elseif($data['pay_type'] == 'vnpay'){

    controller('pay_vnpay', 'client', 'book');

}elseif($data['pay_type'] == 'momo_qr'){

    controller('handle_momo_atm', 'client', 'book');

}elseif($data['pay_type'] == 'momo_atm'){

    controller('handle_momo_atm', 'client', 'book');

}elseif($data['pay_type'] == 'paypal'){

    setFlashData('msg', 'Phương thức này đang bảo trì');
    setFlashData('type', 'danger');
    redirect($_SERVER['HTTP_REFERER']);
}

}else{
setFlashData('msg', 'Vui lòng chọn phương thức thanh toán');
setFlashData('type', 'danger');
redirect($_SERVER['HTTP_REFERER']);
}

?>

</div>