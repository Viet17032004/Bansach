<?php

$myData = _MY_DATA;
$id = $myData['id'];

$filter = '';
$urlFilter = '';

$body = getRequest('get');

if (!empty($body['keywork'])) {
    $keywork = $body['keywork'];
    $filter .= " AND `code_order` LIKE '%$keywork%' ";
    $urlFilter .= "&keywork=$keywork";
}

if (isset($body['status_pay']) && $body['status_pay'] != "") {
    $status_pay = $body['status_pay'];
    $filter .= " AND `status_pay` = '$status_pay' ";
    $urlFilter .= "&status_pay=$status_pay";
}

if (isset($body['status']) && $body['status'] != "") {
    $status = $body['status'];
    $filter .= " AND `status` = '$status' ";
    $urlFilter .= "&status=$status";
}

if(!empty($body['page'])){
    $page = $body['page'];
}else{
    $page = 1;
}

$numberOrder = getCountRows("SELECT id FROM order_pro WHERE user_id='$id' $filter");

$totalPage = ceil($numberOrder / _PAGE);

$limitS = ($page - 1) * _PAGE;
$limitE = _PAGE;

$allOrder = getRaw("SELECT * FROM order_pro WHERE user_id='$id' $filter LIMIT $limitS, $limitE");

$count = 0;

$msg = getFlashData('msg');
$type = getFlashData('type');

?>

<div class="profile_information bg-white border bra-10 p-3">

<?php getAlert($msg, $type); ?>

<h3>Các đơn hàng</h3>
<hr>
<p class="text-center mb-3">Sơ đồ trạng thái đơn hàng</p>

<div class="alert alert-light d-flex justify-content-around" style="border: 2px solid #007bff;" role="alert">
    <span class="btn btn-warning">Đơn mới</span>
    <span class="d-flex align-items-center font-weight-bolder">====></span>
    <span class="btn btn-info">Đang xử lí</span>
    <span class="d-flex align-items-center font-weight-bolder">====></span>
    <span class="btn btn-primary">Đang giao</span>
    <span class="d-flex align-items-center font-weight-bolder">====></span>
    <span class="btn btn-success">Đã giao</span>
</div>

<form action="" method="get" class="mx-0 row">

<input type="hidden" name="module" value="profile">
<input type="hidden" name="action" value="order">

<div class="form-group col-4">
    <input type="text" name="keywork" value="<?php echo !empty($keywork) ? $keywork : ''; ?>" class="form-control">
</div>

<div class="form-group col-3">
    <select name="status_pay" class="form-control">
        <option value="">Chọn</option>
        <option value="0" <?php echo isset($status_pay) && $status_pay != "" && $status_pay == 0?'selected':''; ?>>Chưa thanh toán</option>
        <option value="1" <?php echo isset($status_pay) && $status_pay != "" && $status_pay == 1?'selected':''; ?>>Đã thanh toán</option>
    </select>
</div>

<div class="form-group col-3">
    <select name="status" class="form-control">
        <option value="">Chọn</option>
        <option value="0" <?php echo isset($status) && $status != "" && $status == 0?'selected':''; ?>>Hủy đơn</option>     
        <option value="1" <?php echo isset($status) && $status != "" && $status == 1?'selected':''; ?>>Đơn mới</option>
        <option value="2" <?php echo isset($status) && $status != "" && $status == 2?'selected':''; ?>>Đang xử lí</option>       
        <option value="3" <?php echo isset($status) && $status != "" && $status == 3?'selected':''; ?>>Đang giao</option>   
        <option value="4" <?php echo isset($status) && $status != "" && $status == 4?'selected':''; ?>>Đã giao</option>
    </select>
</div>

<div class="form-group col-2">
    <input type="submit" value="Tìm" class="form-control btn btn-primary">
</div>

</form>

<table class="w-100">
    <thead>
        <tr>
            <th width="5%" class="board_th">STT</th>
            <th width="" class="board_th">Thông tin</th>
            <th width="15%" class="board_th">Phương thức thanh toán</th>
            <th width="15%" class="board_th">Thanh toán</th>
            <th width="15%" class="board_th">Trạng thái</th>
            <th width="10%" class="board_th">Chi tiết</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            if(!empty($allOrder)):
                foreach ($allOrder as $key => $value):
                    $count++;
        ?>
        <tr>
            <td class="board_td text-center"><?php echo $count; ?></td>
            <td class="board_td">
                <h6 class="text-info"><?php echo $value['code_order']; ?></h6>
                <p class="text-info">Người nhận: <span class="text-primary"><?php echo $value['fullname']; ?></span></p>
                <p class="text-info">Số email: <span class="text-primary"><?php echo $value['email']; ?></span></p>
                <p class="text-info">Số điện thoại: <span class="text-primary"><?php echo $value['phone']; ?></span></p>
                <p class="text-info">Địa chỉ: <span class="text-primary"><?php echo $value['address']; ?></span></p>
                <p class="text-info">Tổng giá: <span class="text-primary"><?php echo $value['total']; ?></span> VND</p>
                <p class="text-info">Ngày mua: <span class="text-primary"><?php echo getTimeFormat($value['create_at'], 'Y-m-d'); ?></span></p>
            </td>
            <td class="board_td text-center">
            <?php if($value['pay_type'] == 'cash'): ?>
                    <span  class="text-primary">Tiền mặt</span>
                <?php elseif($value['pay_type'] == 'cash_online'): ?>
                    <span  class="text-primary">Chuyển khoản</span>
                <?php elseif($value['pay_type'] == 'momo'): ?>
                    <span  class="text-primary">MOMO</span>
                <?php elseif($value['pay_type'] == 'vnpay'): ?>
                    <span  class="text-primary">VN PAY</span>
                <?php elseif($value['pay_type'] == 'paypal'): ?>
                    <span  class="text-primary">PayPal</span>
                <?php endif; ?>
            </td>
            <td class="board_td text-center">
                <?php if(!empty($value['status_pay'])): ?>
                    <span class="text-success">Đã thanh toán</span>
                <?php else: ?>
                    <span class="text-danger">Chưa thanh toán</span>
                <?php endif; ?>
            </td>
            <td class="board_td text-center">
                <?php if($value['status'] == 0): ?>
                    <span  class=" text-danger">Hủy hàng</span>
                <?php elseif($value['status'] == 1): ?>
                    <span  class=" text-warning">Đơn mới</span>
                <?php elseif($value['status'] == 2): ?>
                    <span  class=" text-info">Đang xử lí</span>
                <?php elseif($value['status'] == 3): ?>
                    <span  class=" text-primary">Đang giao</span>
                <?php elseif($value['status'] == 4): ?>
                    <span  class=" text-success">Đã giao</span>
                <?php endif; ?>
            </td>
            <td class="board_td text-center"><a href="?module=profile&action=detail_order&id=<?php echo $value['id']; ?>" class="btn btn-success"><i class="fa fa-shopping-cart"></i></a></td>
        </tr>
        <?php endforeach; else: ?>
            <tr><td class="board_td text-center text-danger" colspan="8">Không có đơn hàng nào</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<br>

<?php
if (!empty($totalPage) && $totalPage > 1) :

    $back = $page - 1;
    if ($back < 1) {
        $back = 1;
    }
    $next = $page + 1;
    if ($next > $totalPage) {
        $next = $totalPage;
    }

?>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item d-<?php echo $page == 1 ? 'none' : 'block'; ?>">
                <a class="page-link" href="<?php echo "?module=$module&action=order$urlFilter&page=$back"; ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <?php

            $pageS = $page - 2;
            if ($pageS < 1) {
                $pageS = 1;
            }
            $pageE = $page + 2;
            if ($pageE > $totalPage) {
                $pageE = $totalPage;
            }

            for ($i = $pageS; $i <= $pageE; $i++) :

            ?>

                <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>"><a class="page-link" href="<?php echo "?module=$module$urlFilter&page=$i"; ?>"><?php echo $i; ?></a></li>

            <?php

            endfor;

            ?>

            <li class="page-item d-<?php echo $page == $totalPage ? 'none' : 'block'; ?>">
                <a class="page-link" href="<?php echo "?module=$module&action=order$urlFilter&page=$next"; ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>

<?php endif; ?>

</div>