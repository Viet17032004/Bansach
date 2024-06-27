
<?php


$body = getRequest('get');

$myData = _MY_DATA; 

// $inforOrder = getSession('infor_order');

$user_id = $myData['id'];
// $phone = $inforOrder['phone'];
// $address = $inforOrder['address'];

$detailUser = getRow("SELECT * FROM user WHERE id='$user_id'");

$allCart = getRaw("SELECT * FROM cart WHERE user_id='$user_id'");

if(empty($allCart)){
    setFlashData('msg', 'Bạn không có đơn hàng nào');
    setFlashData('type', 'danger');
    redirect('?module=cart');
}

$count = 0;

$totalPrice = 0;

$msg = getFlashData("msg");
$type = getFlashData("type");
$errors = getFlashData('errors');
$old = getFlashData('old');

if(empty($old)){
    $old = $detailUser;
}

?>

<div class="container_my padding_X py-2">

<?php getAlert($msg, $type); ?>

<div class="detail_course">

<div class="detail_course_content_left">


<div class="p-3 my-3 bg-white bra-10" id="form" style="border: 3px solid #007bff;">
<h5>Thông tin người đặt</h5>
<hr>

<!-- <h6 class="mb-2">Người đặt: <?php echo $detailUser['fullname']; ?></h6>
<h6 class="mb-2">Email: <?php echo $detailUser['email']; ?></h6>
<h6 class="mb-2">Số điện thoại: <?php echo $phone; ?></h6>
<h6 class="mb-2">Địa chỉ: <?php echo $address; ?></h6> -->

<form action="?module=cart&action=handle_pay" method="POST" class="row m-0">

<div class="form-group col-6">
    <label for="">Tên người nhận</label>
    <input type="text" class="form-control" name="fullname" value="<?php echo !empty($old['fullname'])?$old['fullname']:''; ?>">
    <?php !empty($errors['fullname'])?formError($errors['fullname']):''; ?>
</div>

<div class="form-group col-6">
    <label for="">Số điện thoại</label>
    <input type="text" class="form-control" name="phone" value="<?php echo !empty($old['phone'])?$old['phone']:''; ?>">
    <?php !empty($errors['phone'])?formError($errors['phone']):''; ?>   
</div>

<div class="form-group col-6">
    <label for="">Email</label>
    <input type="text" class="form-control" name="email" value="<?php echo !empty($old['email'])?$old['email']:''; ?>">
    <?php !empty($errors['email'])?formError($errors['email']):''; ?>
</div>

<div class="form-group col-6">
    <label for="">Địa chỉ</label>
    <input type="text" class="form-control" name="address" value="<?php echo !empty($old['address'])?$old['address']:''; ?>">
    <?php !empty($errors['address'])?formError($errors['address']):''; ?>
</div>


</div>

<div class="p-3 my-3 bg-white bra-10" style="border: 3px solid #ffc107;">
<h5>Thông tin đơn hàng</h5>
<hr>

<table class="w-100">
    <thead>
        <tr>
            <th width="5%" class="board_th">STT</th>
            <th width="" class="board_th">Thông tin sản phẩm</th>
            <th width="17%" class="board_th">Giá sản phẩm</th>
            <th width="17%" class="board_th">Số lượng</th>
            <th width="17%" class="board_th">Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(!empty($allCart)):
                foreach ($allCart as $key => $value):
                    $count++;
        ?>
        <tr>
            <td class="board_td text-center"><?php echo $count; ?></td>
            <?php
                $book_id = $value['book_id'];
                $detailBook = getRow("SELECT * FROM book WHERE id='$book_id'");
                $sumPrice = $detailBook['price']*$value['quantity'];
                $totalPrice += $sumPrice;
            ?>
            <td class="board_td d-flex justify-content-start">
                    <img width="20%%" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/'.$detailBook['image']; ?>" alt="">
                    <div class="p-4">
                        <h6 class="d-block my-auto"><?php echo $detailBook['title']; ?></h6>
                    </div>
            </td>
            <td class="board_td text-center"><?php echo $detailBook['price']; ?> VND</td>
            <td class="board_td text-center"><?php echo $value['quantity']; ?> sản phẩm</td>
            <td class="board_td text-center"><?php echo $sumPrice; ?> VND</td>
        </tr>
        <?php endforeach; endif; ?>
    </tbody>
</table>

<h5 class="text-primary mt-3">Tổng giá: <span class="text-warning"><?php echo $totalPrice; ?></span> VND</h5>

</div>

</div>

<div class="detail_course_content_right">
    
    <div class="card my-3 mx-auto pay_type" style="width: 80%;">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <h5>Chọn phương thức thanh toán</h5>
                <?php !empty($errors['pay_type'])?formError($errors['pay_type']):''; ?>
            </li>
            <li class="list-group-item">
                    <input type="hidden" name="total" value="<?php echo $totalPrice; ?>">
                    <div class="form-group">
                        <input type="radio" name="pay_type" value="cash"> TIỀN MẶT <img width="20%" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/cash.jpg'; ?>" alt="">
                    </div>
                    <div class="form-group">
                        <input type="radio" name="pay_type" value="cash_online"> CHUYỂN TIỀN <img width="20%" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/cash_online.jpeg'; ?>" alt="">
                    </div>
                    <div class="form-group">
                        <input type="radio" name="pay_type" value="momo_qr"> MOMO QR <img width="20%" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/momo.webp'; ?>" alt="">
                    </div>
                    <div class="form-group">
                        <input type="radio" name="pay_type" value="momo_atm"> MOMO ATM <img width="20%" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/momo.webp'; ?>" alt="">
                    </div>
                    <div class="form-group">
                        <input type="radio" name="pay_type" value="vnpay"> VNPAY <img width="20%" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/vnpay.jpg'; ?>" alt="">
                    </div>
                    <div class="form-group">
                        <input type="radio" name="pay_type" value="paypal"> PAYPAL <img width="20%" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/paypal.jpg'; ?>" alt="">
                    </div>
                </li>
                <li class="list-group-item">
                        <input type="submit" name="redirect"  value="Mua ngay" class="btn btn-danger mx-auto d-block">
                </form>
                </li>
                <!-- <li class="list-group-item text-center">
                    <form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded" action="?module=cart&action=handle_momo_qr">
                        <input type="submit" class="btn text-light" value="Thanh toán MOMO QR" style="background-color: #ea4aaa;">
                    </form>
                    <hr>
                    <form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded" action="?module=cart&action=handle_momo_atm">
                        <input type="submit" class="btn text-light" value="Thanh toán MOMO ATM" style="background-color: #ea4aaa;">
                    </form>
                </li> -->
        </ul>
    </div>

</div>

</div>



</div>