<?php

$group_id = _MY_DATA['id_group'];

if(!checkPermission($group_id, 'statistics', 'lists')){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}

require _WEB_PATH_ROOT . '/admin/statistics/model/book.php';
$count = 0;

?>
<div class="container_my">
    <a href="?module=statistics&action=charts">
        <h5>Biểu đồ thống kê</h5>
    </a>
    <a href="?module=statistics&action=allbook_detail">
        <h5 style="margin-top: 10px;">
            Xem thống kê tất cả các sản phẩm
        </h5>
    </a>
    <table class="w-100">
        <thead>
            <tr>
                <th width="8%" class="board_th">STT</th>
                <th class="board_th" width="10%">Danh mục sách</th>
                <th class="board_th">Giá cao nhất</th>
                <th class="board_th">Giá thấp nhất</th>
                <th class="board_th">Số lượng sản phẩm hiện tại</th>
                <th class="board_th">Số lượng sản phẩm đã bán</th>
                <th class="board_th">Tổng số sản phẩm ban đầu</th>
                <th class="board_th">Doanh thu</th>
                <th class="board_th">Xem thêm</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $all_doanhthu = 0;
            $allcountBook_sold = 0;
            $allcountBook = 0;
            $sum_typebook = 0;
            // $allDoanhthu = 0;
            if (!empty($allBookType)) {
                foreach ($allBookType as $value) {
                    // extract($value);
                    $count++;
            ?>
                    <tr>
                        <td class="board_td text-center"><?php echo $count; ?></td>
                        <td class="board_td text-center"><?= $value['name']; ?></td>
                        <td class="board_td text-center">
                            <?php
                            if (!empty($Price_type)) {
                                foreach ($Price_type as $item) {
                                    if ($value['id'] == $item['book_type_id']) {
                                        echo $item['price_max'];
                                    }
                                }
                            }
                            ?>
                        </td>
                        <td class="board_td text-center">
                            <?php
                            if (!empty($Price_type)) {
                                $sum = 0;
                                foreach ($Price_type as $item) {
                                    if ($value['id'] == $item['book_type_id']) {
                                        echo $item['price_min'];
                                    }
                                }
                            }
                            ?>
                        </td>
                        <!-- số sản phẩm còn lại -->
                        <td class="board_td text-center">
                            <?php
                            if (!empty($allBook)) {
                                $countB = 0;
                                foreach ($allBook as $item) {
                                    if ($value['id'] == $item['book_type_id']) {
                                        $countB += $item['quantity'];
                                    }
                                }
                                $allcountBook += $countB;
                                echo $countB;
                            }
                            ?>
                        </td>
                        <!-- số lượng đã bán -->
                        <td class="board_td text-center">
                            <?php
                            if (!empty($countBookSold)) {
                                $sum = 0;
                                $price_book = 0;
                                foreach ($countBookSold as $cb) {
                                    if ($value['id'] == $cb["book_type_id"]) {
                                        $sum += $cb["sum"];
                                    }
                                }
                                $allcountBook_sold += $sum;
                                echo $sum;
                            }
                            ?>
                        </td>
                        <!--  Tổng số sản phẩm -->
                        <td class="board_td text-center">
                            <?php
                            $all = 0;
                            if (isset($countB) && isset($sum)) {
                                $all = $countB + $sum;
                                echo $all;
                            } else if (isset($sum) && empty($countB)) {
                                $all = $countB;
                                echo $count;
                            } else {
                                echo $all;
                            }
                            ?>
                        </td>

                        <!-- Doanh thu của danh mục -->
                        <td class="board_td text-center">
                            <?php
                            if (!empty($countBookSold)) {
                                foreach ($countBookSold as $Bsold) {
                                    if ($value['id'] == $Bsold['book_type_id']) {
                                        $sum_typebook += $Bsold['sum'] * $Bsold['price'];
                                    }
                                }
                                echo $sum_typebook;
                                $all_doanhthu += $sum_typebook;
                                $sum_typebook = 0;
                            }
                            ?>
                        </td>
                        <td class="board_td text-center">
                            <a href="?module=statistics&action=book_detail&book_type_id=<?php echo $value['id']; ?>">Chi tiết</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo '<td colspan="7" class="text-center board_td text-danger">Không có dữ liệu</td>';
            }
            ?>
    </table>
    <hr>
    <table class="w-100">
        <tr>
            <th class="board_th">Tổng số lượng sản phẩm hiện tại</th>
            <th class="board_th">Tổng số lượng sản phẩm đã bán</th>
            <th class="board_th">Tổng số lượng sản phẩm ban đầu </th>
            <th class="board_th">Tổng doanh thu</th>
        </tr>
        <tr>
            <td class="board_td text-center">
                <?php
                if (!empty($allcountBook)) {
                    echo $allcountBook;
                } else {
                    $allcountBook = 0;
                    echo $allcountBook;
                }
                ?>
            </td>
            <td class="board_td text-center">
                <?php
                if (!empty($allcountBook_sold)) {
                    echo $allcountBook_sold;
                } else {
                    $allcountBook_sold = 0;
                    echo $allcountBook_sold;
                }
                ?>

            </td>
            <td class="board_td text-center">
                <?php
                $allSp = 0;
                if (isset($allcountBook) && isset($allcountBook_sold)) {
                    $allSp = $allcountBook + $allcountBook_sold;
                    echo $allSp;
                } else {
                    echo $allSP;
                }
                ?>
            </td>
            <td class="board_td text-center">
                <?php
                if (!empty($all_doanhthu)) {
                    echo $all_doanhthu;
                }
                ?>
            </td>
        </tr>
    </table>
    <hr>





</div>