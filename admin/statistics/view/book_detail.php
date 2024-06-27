<?php

$group_id = _MY_DATA['id_group'];

if(!checkPermission($group_id, 'statistics', 'lists')){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}

require _WEB_PATH_ROOT . '/admin/statistics/model/book.php';
$count = 0;
?>
<div class="container_my">

    <a href="?module=statistics&action=book">
        <h5 style="padding: 15px;">
            Quay lại
        </h5>
    </a>

    <table class="w-100">
        <thead>
            <tr>
                <th class="board_th">STT</th>
                <th class="board_th" width="10%">Tên sách</th>
                <th class="board_th">Giá bán</th>
                <th class="board_th">Số sản phẩm còn lại</th>
                <th class="board_th">Số sản phẩm đã bán</th>
                <th class="board_th">Tổng số lượng sản phẩm</th>
                <th class="board_th">Doanh thu</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $body = getRequest('get');
            $id_bt = $_GET['book_type_id'];
            $temp = 0;
            $temp2 = 0;
            $book_sold = 0;
            $doanhthu = 0;
            $allbook = 0;
            if (!empty($book_detail)) {
                foreach ($book_detail as $b) {
                    if ($id_bt == $b['id']) {
                        $count++;
            ?>
                        <tr>
                            <td class="board_td text-center"><?php echo $count; ?></td>
                            <td width="20%" class="board_td text-center"><?php echo $b['title']; ?></td>
                            <td class="board_td text-center"><?php echo $b['price']; ?></td>
                            <td class="board_td text-center"><?php echo $b['quantity']; ?></td>
                            <td class="board_td text-center">
                                <?php
                                $sum = 0;
                                if (!empty($countBookSold)) {
                                    // $price_book = 0;
                                    foreach ($countBookSold as $cb) {
                                        if ($id_bt == $cb["book_type_id"] && $cb['book_id'] == $b['book_id']) {
                                            $temp = $cb['sum'];
                                            echo $cb['sum'];
                                            $temp2 = $cb['sum'];
                                        }
                                    }
                                    if ($temp == 0) {
                                        echo $temp;
                                    }
                                }
                                ?>
                            </td>
                            <td class="board_td text-center">
                                <?php
                                if (isset($allbook) && isset($cb['quantity'])) {
                                    $allbook += $temp + $b['quantity'];
                                    echo $allbook;
                                    $temp = 0;
                                    $b['quantity'] = 0;
                                    $allbook = 0;
                                }
                                ?>
                            </td>
                            <td class="board_td text-center">
                                <?php
                                if (!empty($temp2) && !empty($b['price'])) {
                                    $doanhthu = $b['price'] * $temp2;
                                    $temp2 = 0;
                                }
                                echo $doanhthu;
                                $doanhthu = 0;
                                ?>
                            </td>
                        </tr>
            <?php
                    }
                }
            } else {
                echo '<td colspan="7" class="text-center board_td text-danger">Không có dữ liệu</td>';
            }
            ?>
        </tbody>

    </table>
  

</div>