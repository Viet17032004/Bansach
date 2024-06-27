<div class="container_my padding_X">

<?php

echo $_SERVER['REQUEST_METHOD'];

$body = getRequest('post');


if(!empty($body['pay_type'])){

if($body['pay_type'] == 'cash' || $body['pay_type'] == 'cash_online'){

    redirect("?module=exam&action=thank&pay_type=$pay_type");

    // setFlashData('msg', 'Phương thức này đang bảo trì');
    // setFlashData('type', 'danger');
    // redirect($_SERVER['HTTP_REFERER']);

}elseif($body['pay_type'] == 'vnpay'){
 
    $dataVNPay = [
        'price' => $body['price'],
        'exam_id' => $body['exam_id']
    ];

    controller('pay_vnpay', 'client', 'exam', $dataVNPay);


}elseif($body['pay_type'] == 'momo_qr'){

    $dataMoMo = [
        'price' => $body['price'],
        'exam_id' => $body['exam_id']
    ];

    controller('handle_momo_atm', 'client', 'exam', $dataMoMo);

}elseif($body['pay_type'] == 'momo_atm'){

    $dataMoMo = [
        'price' => $body['price'],
        'exam_id' => $body['exam_id']
    ];

    controller('handle_momo_atm', 'client', 'exam', $dataMoMo);

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

?>

</div>