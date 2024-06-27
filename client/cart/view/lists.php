


<?php

if(!isLogin()){
    setFlashData('msg', 'Vui lòng đăng nhập để xem giỏ hàng !!!');
    setFlashData('type', 'danger');
    redirect(_WEB_HOST_ROOT );
}

$user_id = _MY_DATA['id'];

require _WEB_PATH_ROOT.'/client/cart/model/lists.php';

$arrPro = [];

$sumPrice = 0;

$msg = getFlashData('msg');
$type = getFlashData('type');

?>

<?php getAlert($msg, $type); ?>

<div class="box_cart">


    <div>

        <table class="w-100">
            <thead>
                <tr>
                    <th class="board_th">Sản phẩm</th>
                    <th width="17%" class="board_th">Giá sản phẩm</th>
                    <th width="25%" class="board_th">Số lượng</th>
                    <th width="15%" class="board_th">Giá tổng</th>
                    <th width="10%" class="board_th">Xóa</th>
                </tr>
            </thead>
        </table>

        <hr>

<?php

if(!empty($allCart)):
    foreach ($allCart as $key => $value):
        $id = $value['id'];
        $book_id = $value['book_id'];
        $detailBook = getRow("SELECT * FROM book WHERE id='$book_id'");
        $price = $detailBook['price']*$value['quantity'];
        $sumPrice += $price;
        $arrPro[$key]['id'] = $detailBook['id'];
        $arrPro[$key]['quantity'] = $value['quantity'];
        $arrPro[$key]['price'] = $detailBook['price'];
?>

        <div class="item_cart">

        <div class="infor_pro d-flex flex-row bd-highlight">
            <img src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/'.$detailBook['image']; ?>" alt="" class="w-25">
            <p class="ml-2 my-auto"><?php echo $detailBook['title']; ?></p>
        </div>

        <div class="price_pro m-auto">
            <h5 class="text-primary"><?php echo $detailBook['price']; ?> VND</h5>
        </div>

        <div class="number_pro m-auto text-center">
                <a href="<?php echo _WEB_HOST_ROOT."/?module=cart&action=minus_cart&cart_id=$id"; ?>" class="btn btn-primary my-auto"><i class="fa fa-minus"></i></a>
                <input type="number" class="w-25 form-control m-0 d-inline-block" value="<?php echo $value['quantity']; ?>">
                <a href="<?php echo _WEB_HOST_ROOT."/?module=cart&action=add_cart&cart_id=$id"; ?>" class="btn btn-primary my-auto"><i class="fa fa-plus"></i></a>
        </div>

        <div class="final_price_pro m-auto">
            <h5 class="text-warning"><?php echo $price; ?> VND</h5>
        </div>

        <div class="remove_pro m-auto">
            <a href="<?php echo _WEB_HOST_ROOT."/?module=cart&action=remove_cart&cart_id=$id"; ?>" class="btn btn-danger"><i class="fa fa-times"></i></a>
        </div>
        </div>
        <br>

<?php

    endforeach;
else:
?>

<div class="my-3">
    <h3 class="text-center text-danger" style="margin: 70px 0;">CHƯA CÓ SẢN PHẨM NÀO</h3>
</div>

<?php
endif;

?>

    </div>


<?php

$strPro = json_encode($arrPro);

if(is_Post()){

    

    $data = getRequest();

    if(empty($data['address'])){
        $errors['address'] = 'Vui lòng điền thông tin';
    }else if(strlen(trim($data['address'])) < 20){
        $errors['address'] = 'Địa chỉ phải lớn hơn 20 ký tự';
    }

    if(empty($data['phone'])){
        $errors['phone'] = 'Vui lòng điền thông tin';
    }else{
        if(!preg_match('~^0[0-9]{9}$~', $data['phone'])){
            $errors['phone'] = 'Đây không phải số điện thoại';
        }
    }

    if(empty($errors)){

        $dataInfor = [
            'user_id' => $user_id,
            'phone' => $data['phone'],
            'address' => $data['address']
        ];

        setSession('infor_order', $dataInfor);

        redirect("?module=cart&action=order");

        // $dataInsert = [
        //     'user_id' => $user_id,
        //     'code_order' => $data['code_order'],
        //     'phone' => $data['phone'],
        //     'address' => $data['address'],
        //     'total' => $data['total'],
        //     'arr_pro' => $strPro,
        //     'status' => 1,
        //     'status_pay' => 0,
        //     'create_at' => date('Y-m-d H:i:s')
        // ];

        // if(insert('order_pro', $dataInsert)){
        //     // remove cart old.
        //     // delete("cart", "user_id='$user_id'");
        //     $allOrder = getRaw("SELECT id, code_order FROM order_pro WHERE user_id='$user_id'");
        //     $lastIdOrder = count($allOrder)-1;
        //     $idOrder = $allOrder[$lastIdOrder]['id'];
        //     setFlashData('msg', 'Tạo đơn hàng thành công | Mã đơn là: '.$allOrder[$lastIdOrder]['code_order']);
        //     setFlashData('type', 'success');
        //     redirect(_WEB_HOST_ROOT."?module=cart&action=qr_book&id=$idOrder");
        // }else{
        //     setFlashData('msg', 'Lỗi hệ thống');
        //     setFlashData('type', 'danger');
        // }
        
        

    }else{
        setFlashData('msg', 'Vui lòng kiểm tra form');
        setFlashData('type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $data);
    }

    // redirect('?module=cart');

}

$msg = getFlashData('msg');
$type = getFlashData('type');
$errors = getFlashData('errors');
$old = getFlashData('old');



if(empty($old)){
    $old = $detailUser;
}

?>

<div class="submit_cart">

<h2 class="text-primary">Tổng giá: <span class="text-warning"><?php echo $sumPrice; ?></span> VNĐ</h2>

<div class="text-end">
    <a <?php echo empty($allCart)?'onclick="return confirm(`Bạn chưa có đơn hàng nào`);"':'href="?module=cart&action=order"'; ?>  class="btn btn-danger">Mua ngay</a>
</div>

</div>




</div>