<?php

$body = getRequest('get');

$group_id = _MY_DATA['id_group'];

if(!checkPermission($group_id, 'order', 'detail')){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}


if(!empty($body['id'])){
    $id = $body['id'];
    require _WEB_PATH_ROOT.'/admin/cart/model/detail_order.php';
    if(!empty($detailOrder)){
        $code_cart = $detailOrder['code_order'];
        $arrPro = getRaw("SELECT * FROM cart_order WHERE code_cart='$code_cart'");
        $textStatus = '';
        $colorStatus = '';
        if($detailOrder['status'] == 0){
            $textStatus = 'Đã hủy';
            $colorStatus = 'danger';
        }elseif($detailOrder['status'] == 1){
            $textStatus = 'Đơn mới';
            $colorStatus = 'warning';
        }elseif($detailOrder['status'] == 2){
            $textStatus = 'Đang xử lí';
            $colorStatus = 'info';
        }elseif($detailOrder['status'] == 3){
            $textStatus = 'Đang giao';
            $colorStatus = 'primary';
        }elseif($detailOrder['status'] == 4){
            $textStatus = 'Đã giao';
            $colorStatus = 'success';
        }
    }else{
        setFlashData('msg', 'url này không tồn tại');
        setFlashData('type', 'danger');
        redirect('?module=cart');
    }
}else{
    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
    redirect('?module=cart');
}

if(is_Post()){

    $data = getRequest();

    $errors = [];

    if(empty($errors)){
        $dataUpdate = [
            'status' => $data['status'],
            'note' => $data['note'],
            'update_at' => date('Y-m-d H:i:s')
        ];
        if(update('order_pro', $dataUpdate, "id='$id'")){
            setFlashData('msg', 'Cập nhập thành công');
            setFlashData('type', 'success');
        }else{
            setFlashData('msg', 'Lỗi hệ thống');
            setFlashData('type', 'danger');
        }
    }


    // $arrId = $data['id'];

    // $arrNewPro = [];

    // foreach ($arrId as $key => $value) {
    //     $arrNewPro[$key]['id'] = $value;
    //     $arrNewPro[$key]['quantity'] = $data['quantity'][$key];
    //     $arrNewPro[$key]['price'] = $data['price'][$key];
    // }

    // if(!empty($data['id_remove'])){
    //     $id_remove = $data['id_remove'];
    //     $arrPro = $arrNewPro;
    //     foreach ($arrPro as $key => $value) {
    //         if($value['id'] == $id_remove){
    //             unset($arrPro[$key]);
    //         }
    //     }
    //     $arrPro = array_values($arrPro);
    //     $strPro = json_encode($arrPro);
    //     if(update('order_pro', ['arr_pro'=>$strPro], "id='$id'")){
    //         setFlashData('msg', 'Cập nhập đơn hàng thành công !!!');
    //         setFlashData('type', 'success');
    //     }else{
    //         setFlashData('msg', 'Lỗi hệ thống');
    //         setFlashData('type', 'danger');
    //     }
    // }else{
    //     $strNewPro = json_encode($arrNewPro);
    //     $dataUpdate = [
    //         'arr_pro' => $strNewPro,
    //         'total' => $data['total'],
    //         'update_at' => date('Y-m-d H:i:s')
    //     ];
    //     if(update('order_pro', $dataUpdate, "id='$id'")){
    //         setFlashData('msg', 'Cập nhập đơn hàng thành công !!!');
    //         setFlashData('type', 'success');
    //     }else{
    //         setFlashData('msg', 'Lỗi hệ thống');
    //         setFlashData('type', 'danger');
    //     }
    // }

    redirect("?module=cart&action=detail_order&id=$id#center");

}

$count = 0;


$totalPrice = 0;

$msg = getFlashData('msg');
$type = getFlashData('type');

foreach ($arrPro as $key => $value) {
    $totalPrice += $value['price'] * $value['quantity'];
}


?>


<div class="container_my" id="center">

<?php getAlert($msg, $type); ?>


<!-- <form action="" method="post"> -->

    <h2 class="text-primary">Giá đơn: <span class="total_price_cart text-warning"><?php echo $totalPrice; ?></span> VND</h2>
    <input type="hidden" name="total" value="<?php echo $totalPrice; ?>" class="input_total_price_cart">
    <br>

    <div class="row mx-0">
    <div class="col-8">

    <table class="w-100">
        <thead>
            <tr>
                <th class="board_th" width="5%">STT</th>
                <th class="board_th" width="">Sản phẩm</th>
                <th class="board_th" width="17%">Giá mua</th>
                <th class="board_th" width="17%">Số lượng</th>
                <th class="board_th" width="17%">Giá tổng</th>
                <!-- <th class="board_th"  width="5%">Xóa</th> -->
            </tr>
        </thead>
        <tbody>
<?php

if(!empty($arrPro)):
    foreach ($arrPro as $key => $value):
        $count++;
        $sumPrice = $value['price']*$value['quantity'];

?>
            <tr>
                <td class="board_td text-center"><?php echo $count; ?></td>
                <?php
                    $book_id = $value['id'];
                ?>
                <td class="board_td">
                    <div class=" d-flex align-items-center">
                        <input type="hidden" name="id[]" value="<?php echo $book_id; ?>">
                        <img width="30%" src="<?php echo _WEB_HOST_IMAGE_CLIENT."/".$value['image']; ?>" alt="">
                        <div class="pl-2">
                            <p>Tên: <?php echo $value['title']; ?></p>
                            <p>Code: <?php echo $value['code_cart']; ?></p>
                        </div>    
                    </div>

                </td>
                <input type="hidden" name="price[]" value="<?php echo $value['price']; ?>">
                <td class="board_td text-center"><h5><span class="price_bought_cart"><?php echo $value['price']; ?></span> VND</h5></td>
                <td class="board_td text-center">
                    <span class="btn btn-warning btn_down_cart d-none"><i class="fa fa-minus"></i></span>
                    <input type="number" min="1" max="10" name="quantity[]" class="quantity_cart text-center form-control w-50 d-inline-block" disabled width="" value="<?php echo $value['quantity']; ?>">
                    <span class="btn btn-warning btn_up_cart d-none"><i class="fa fa-plus"></i></span>
                </td>
                <td class="board_td text-center"><h5><span class="sum_price_cart"><?php echo $sumPrice; ?></span> VND</h5></td>
                <!-- <td class="board_td text-center">
                    <input type="hidden" name="" class="id_remove" value="<?php echo $book_id; ?>">
                    <button type="submit"  onclick="return confirm('bạn có chắc chắc muốn quá không !!!');" class="btn btn-danger btn_remove_cart"><i class="fa fa-trash-alt "></i></button>
                </td> -->
            </tr>
<?php
    endforeach;
    endif;  
?>
        </tbody>
    </table>

    </div>
    


    <div class="col-4" >
        <div class="p-3" style="border: 3px solid #ffc107; border-radius: 10px;">
            <h5 class="text-primary">Thông tin khách hàng</h5>
            <hr>
            <h6>Tên người: <?php echo $detailOrder['fullname']; ?></h6>
            <h6>Email: <?php echo $detailOrder['email']; ?></h6>
            <h6>Số điện thoại: <?php echo $detailOrder['phone']; ?></h6>
            <h6>Địa chỉ: <?php echo $detailOrder['address']; ?></h6>
            <h6>Ngày tạo: <?php echo getTimeFormat($detailOrder['create_at'], 'Y/m/d'); ?></h6>
            <hr>
            <h5 class="text-primary">Trạng thái đơn hàng: <span class="text-<?php echo $colorStatus; ?>"><?php echo $textStatus; ?></span></h5>
            <h6>Ngày cập nhập: <?php echo getTimeFormat($detailOrder['create_at'], 'Y/m/d'); ?></h6>
            <form action="" method="post">
                <div class="form-group">
                    <select name="status" id="" class="form-control">
                        <option value="0" <?php echo $detailOrder['status']=='0'?'selected':''; ?>>Hủy đơn</option>
                        <option value="1" <?php echo $detailOrder['status']=='1'?'selected':''; ?>>Đơn mới</option>
                        <option value="2" <?php echo $detailOrder['status']=='2'?'selected':''; ?>>Đang xử lí</option>
                        <option value="3" <?php echo $detailOrder['status']=='3'?'selected':''; ?>>Đang giao</option>
                        <option value="4" <?php echo $detailOrder['status']=='4'?'selected':''; ?>>Đã giao</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea name="note" id="" cols="30" rows="3" class="form-control"><?php echo $detailOrder['note']; ?></textarea>
                </div>
                <div class="form-group" style="text-align: end;">
                    <input type="submit" value="Cập nhập" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

    </div>
    <br>

    <input type="submit" value="Cập nhập" class="btn btn-primary d-none ml-auto">

<!-- </form> -->

<hr>

<a href="?module=cart" class="btn btn-success">Danh sách</a>

</div>