

<?php

$body = getRequest('get');

if(!empty($body['id'])){
    $id = $body['id'];

    if(!isLogin()){
        setFlashData('msg', "Bạn cần phải đăng nhập mới có thể mua khóa học này");
        setFlashData('type', 'danger');
        redirect('?module=course&action=detail_course&course_id='.$id);
    }

    $detailCourse = getRow("SELECT * FROM course WHERE id='$id'");

    $allChapter = getCountRows("SELECT id FROM chapter_course WHERE course_id='$id'");

    $user_id = _MY_DATA['id'];

    if(!empty($detailCourse)){
        $detaiUser = getRow("SELECT email FROM user WHERE id='$user_id'");
    }else{
        setFlashData('msg', 'url này không tồn tại');
        setFlashData('type', 'danger');
        redirect("?module=course"); 
    }
}else{
    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
    redirect("?module=course"); 
}

$msg = getFlashData('msg');
$type = getFlashData('type');

getAlert($msg, $type);

?>




<div class="box_form_course">

    <div class="course_pro">
        <img src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/'.$detailCourse['image']; ?>" class="w-100 box_shadow" alt="">
        <hr>
        <h5 class="text-primary">Tiêu đề: <span class="text-warning"><?php echo $detailCourse['title']; ?></span></h5>
        <br>
        <h5 class="text-primary">Giá: <span class="text-warning"><?php echo !empty($detailCourse['discount'])?$detailCourse['discount']:$detailCourse['price']; ?></span> VND</h5>
        <br>
        <h5 class="text-primary">Chương: <span class="text-warning"><?php echo !empty($allChapter)?$allChapter:'0'; ?></span> chương</h5>
    </div>

    <div class="" style="border-left: 10px solid #ffc107;">
        <div class="form_course mx-auto ">
            <form action="?module=course&action=handle_pay" method="post">
                <h4 class="text-center text-warning ">CHỌN PHƯƠNG THỨC THANH TOÁN</h4>
                <input type="hidden" name="price" value="<?php echo !empty($detailCourse['discount'])?$detailCourse['discount']:$detailCourse['price']; ?>">
                <input type="hidden" name="id" value="<?php echo $detailCourse['id']; ?>">
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