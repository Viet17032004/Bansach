
<?php

if(!isLogin()){
    setFlashData("msg", 'Vui lòng đăng nhập để mua bài kiểm tra này');
    setFlashData("type", 'danger');
    redirect('?module=exam');
}

$body = getRequest('get');

if(!empty($body['id'])){
    $id = $body['id'];
    $detailExam = getRow("SELECT * FROM exam WHERE id='$id'");
    if(!empty($detailExam)){

    }else{
        setFlashData('msg', 'url này không tồn tại');
        setFlashData('type', 'danger');
        redirect(_WEB_HOST_ROOT);
    }
}else{
    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
    redirect(_WEB_HOST_ROOT);
}

$msg = getFlashData('msg');
$type = getFlashData('type');

?>

<?php getAlert($msg, $type); ?>

<div class="box_form_course">

    <div class="course_pro">
        <img src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/'.$detailExam['image']; ?>" class="w-100 box_shadow" alt="">
        <hr>
        <h5>Tiêu đề: <?php echo $detailExam['title']; ?></h5>
        <br>
        <h5>Giá: <?php echo !empty($detailExam['discount'])?$detailExam['discount']:$detailExam['price']; ?> VND</h5>
    </div>

    <div class="" style="border-left: 10px solid #ffc107;">
        <div class="form_course mx-auto ">
            <form action="?module=exam&action=handle_pay" method="post">
                <h4 class="text-center text-warning ">CHỌN PHƯƠNG THỨC THANH TOÁN</h4>
                <input type="hidden" name="price" value="<?php echo $detailExam['price']; ?>">
                <input type="hidden" name="id" value="<?php echo $detailExam['id']; ?>">
                <div class="row mx-0 py-4">
                    <div class="form-group col-3 text-center">
                        <input type="radio" name="pay_type" value="momo_qr"> <br>
                        MOMO QR
                        <hr>
                        <img width="100%" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/momo.webp'; ?>" alt="">
                    </div>
                    <div class="form-group col-3 text-center">
                        <input type="radio" name="pay_type" value="momo_atm"> <br>
                        MOMO ATM
                        <hr>
                        <img width="100%" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/momo.webp'; ?>" alt="">
                    </div>
                    <div class="form-group col-3 text-center">
                        <input type="radio" name="pay_type" value="vnpay"> <br>
                        VNPAY
                        <hr>
                        <img width="100%" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/vnpay.jpg'; ?>" alt="">
                    </div>
                    <div class="form-group col-3 text-center">
                        <input type="radio" name="pay_type" value="paypal"> <br>
                        PAYPAL
                        <hr>
                        <img width="100%" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/paypal.jpg'; ?>" alt="">
                    </div>
                </div> 
                <div class="form-group col-12 text-center">
                    <input type="submit" name="redirect" value="Mua Ngay" class=" w-75 btn btn-danger">
                </div>
            </form>
        </div> 
    </div>



</div>