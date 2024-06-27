<?php

$body = getRequest('get');

if(isLogin() && !empty(getSession('data_book'))){
    $dataBook = getSession('data_book');
    $id = $dataBook['book_id'];
    $quantity = $dataBook['quantity'];
    $user_id = isLogin()['user_id'];
    $detailBook = getRow("SELECT b.*, t.name AS 't_name' FROM book AS b INNER JOIN book_type AS t ON b.book_type_id=t.id WHERE b.id='$id'");
    if(!empty($detailBook)){

    }else{
        setFlashData('msg', 'url này không tồn tại');
        setFlashData('type', 'danger');
        redirect("?module=book");
    }
}else{
    setFlashData('msg', 'Vui lòng đăng nhập');
    setFlashData('type', 'danger');
    redirect("?module=book");
}


$msg = getFlashData('msg');
$type = getFlashData('type');
$errors = getFlashData('errors');
$old = getFlashData('old');

if(empty($old)) $old = _MY_DATA;

?>

<div class="container_my padding_X py-4">

<?php getAlert($msg, $type); ?>

    <div class="box_form_course" id="form">

        <div class="course_pro">
            <div class="col-12 row mx-0">
                <div class="col-5">
                    <img width="90%" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/'.$detailBook['image']; ?>" alt="">
                </div>
                <div class="col-7">
                    <p>Tiêu đề: <?php echo $detailBook['title']; ?></p>
                    <p>Danh mục: <?php echo $detailBook['t_name']; ?></p>
                    <p>Giá: <?php echo $detailBook['price']; ?> VND</p>
                </div>
            </div>
            <hr>
            <div class="col-12 pt-3">
                <h4 class="text-primary">Số lượng: <span class="text-warning"><?php echo $dataBook['quantity']; ?></span></h4>
                <br>
                <h4 class="text-primary">Tổng giá: <span class="text-warning"><?php echo $dataBook['quantity']*$detailBook['price']; ?></span> VND</h4>
                <br>
                <a href="?module=book&action=detail_book&id=<?php echo $detailBook['id']; ?>" class="btn btn-primary">Hủy mua</a>
            </div>
        </div>

        <div class="" style="border-left: 10px solid #ffc107;">
            <div class="form_course mx-auto ">
                <h3 class="text-warning text-center mb-3">Thông tin người dùng</h3>

                <form action="?module=book&action=handle_pay" method="post" class="row mx-0">
                    <input type="hidden" name="total" value="<?php echo $dataBook['quantity']*$detailBook['price']; ?>">
                    <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
                    <input type="hidden" name="book_id" value="<?php echo $id; ?>">
                    <div class="form-group col-6">
                        <label for="">Tên người nhận</label>
                        <input type="text" name="fullname" class="form-control" value="<?php echo !empty($old['fullname'])?$old['fullname']:''; ?>">
                        <?php !empty($errors['fullname'])?formError($errors['fullname']):''; ?>
                    </div>
                    <div class="form-group col-6">
                        <label for="">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo !empty($old['phone'])?$old['phone']:''; ?>">
                        <?php !empty($errors['phone'])?formError($errors['phone']):''; ?>
                    </div>
                    <div class="form-group col-6">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-control" value="<?php echo !empty($old['email'])?$old['email']:''; ?>">
                        <?php !empty($errors['email'])?formError($errors['email']):''; ?>
                    </div>
                    <div class="form-group col-6">
                        <label for="">Địa chỉ</label>
                        <input type="text" name="address" class="form-control" value="<?php echo !empty($old['address'])?$old['address']:''; ?>">
                        <?php !empty($errors['address'])?formError($errors['address']):''; ?>
                    </div>
                
                    <div class="form-group col-12 row mx-0">
                    <div class="form-group col-2 text-center">
                        <input type="radio" name="pay_type" value="cash"><br>
                        TIỀN MẶT 
                        <hr>
                        <img width="50%" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/cash.jpg'; ?>" alt="">
                    </div>
                    <div class="form-group col-2 text-center">
                        <input type="radio" name="pay_type" value="cash_online"><br>
                        TIỀN ONLINE
                        <hr>
                        <img width="50%" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/cash_online.jpeg'; ?>" alt="">
                    </div>
                    <div class="form-group col-2 text-center">
                        <input type="radio" name="pay_type" value="momo_qr"> <br>
                        MOMO QR
                        <hr>
                        <img width="50%" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/momo.webp'; ?>" alt="">
                    </div>
                    <div class="form-group col-2 text-center">
                        <input type="radio" name="pay_type" value="momo_atm"> <br>
                        MOMO ATM
                        <hr>
                        <img width="50%" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/momo.webp'; ?>" alt="">
                    </div>
                    <div class="form-group col-2 text-center">
                        <input type="radio" name="pay_type" value="vnpay"> <br>
                        VNPAY
                        <hr>
                        <img width="50%" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/vnpay.jpg'; ?>" alt="">
                    </div>
                    <div class="form-group col-2 text-center">
                        <input type="radio" name="pay_type" value="paypal"> <br>
                        PAYPAL
                        <hr>
                        <img width="50%" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/paypal.jpg'; ?>" alt="">
                    </div>
                    </div>   
                    <p class="text-danger text-center px-3 w-100 mb-2"><?php echo !empty($errors['pay_type'])?$errors['pay_type']:''; ?></p>
                    <div class="form-group col-12 my-0">
                        <input type="submit" class="btn w-100 btn-warning" name="redirect" value="Mua ngay">
                    </div>
                    
                </form>
            </div> 
        </div>



    </div>

</div>


