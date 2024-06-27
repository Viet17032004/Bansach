

<?php

$group_id = _MY_DATA['id_group'];

if(!checkPermission($group_id, 'book', 'lists')){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}

$body = getRequest('get');

$count = 0;
$filter = '';
$urlFilter = '';

if(!empty($body['keywork'])){
    $keywork = $body['keywork'];
    $filter .= " WHERE b.title LIKE '%$keywork%' ";
    $urlFilter .= "&keywork=$keywork";
}

if(!empty($body['book_type_id'])){
    $book_type_id = $body['book_type_id'];

    if(!empty($filter)){
        $filter .= " AND `book_type_id` = '$book_type_id' ";
    }else{
        $filter .= " WHERE `book_type_id` = '$book_type_id' ";        
    }
    $urlFilter .= "&book_type_id=$book_type_id";
}




// phân trang
if(!empty($body['page'])){
    $page = $body['page'];
}else{
    $page = 1;
}

require _WEB_PATH_ROOT.'/admin/book/model/board.php';

$msg = getFlashData('msg');
$type = getFlashData('type');

?>


<div class="container_my">

    <?php getAlert($msg, $type); ?>
    <?php if(checkPermission($group_id, 'book', 'add')): ?>
    <a href="?module=<?php echo $module; ?>&action=add" class="btn btn-primary mb-3">Thêm <i class="fa fa-plus mx-1"></i></a>
    <?php endif; ?>
    <form action="" method="get" class="mx-0 row">

        <input type="hidden" name="module" value="<?php echo $module; ?>">

        <div class="form-group col-7">
            <input type="text" name="keywork" value="<?php echo !empty($keywork)?$keywork:''; ?>" class="form-control">
        </div>

        <div class="form-group col-3">
            <select name="book_type_id" class="form-control">
                <option value="">Chọn</option>
                <?php
                    if(!empty($allBookType)):
                        foreach ($allBookType as $key => $value):
                ?>
                <option <?php echo !empty($book_type_id) && $book_type_id == $value['id']?'selected':''; ?> value="<?php echo $value['id']; ?>"><?php echo $value['name'].' - '.$value['id']; ?></option>
                <?php endforeach; endif; ?>
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
                <th width="15%" class="board_th">Tiêu đề</th>
                <th width="15%" class="board_th">Ảnh</th>
                <th width="7%" class="board_th">Số hàng</th>
                <th width="30%" class="board_th">Mô tả</th>
                <?php if(checkPermission($group_id, 'book', 'approve')): ?>
                <th width="10%" class="board_th">Trạng thái</th>
                <?php endif; ?>
                <th class="board_th">Giá</th>
                <?php if(checkPermission($group_id, 'book', 'fix')): ?>
                <th width="5%" class="board_th">Sửa</th>
                <?php endif; ?>
                <?php if(checkPermission($group_id, 'book', 'delete')): ?>
                <th width="5%" class="board_th">Xóa</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
        <?php

        // echo '<pre>';
        // print_r($allBook);
        // echo '</pre>';

        if(!empty($allBook)):
        foreach ($allBook as $key => $item): 
        extract($item);

        $count++;

        ?>

            <tr>
                <td class="board_td text-center"><?php echo $count; ?></td>
                <td class="board_td">
                    <p><?php echo $title; ?></p>
                    <p>loại: <?php echo $t_name; ?></p>
                </td>
                <td class="board_td text-center"><img width="80%" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/'.$image; ?>" alt=""></td>
                <td class="board_td text-center"><?php echo $quantity; ?></td>
                <td class="board_td text-center"><?php echo html_entity_decode($description); ?></td>
                <?php if(checkPermission($group_id, 'book', 'approve')): ?>
                <td class="board_td text-center"><a href="?module=<?php echo $module.'&action=approve&id='.$id; ?>" class="btn btn-<?php echo !empty($status)?'success':'danger'; ?>"><?php echo !empty($status)?'Duyệt':'Chưa duyệt'; ?></a></td>
                <?php endif; ?>
                <td class="board_td text-center"><?php echo $price; ?> VND</td>
                <?php if(checkPermission($group_id, 'book', 'fix')): ?>
                <td class="board_td text-center">
                    <a href="<?php echo '?module='.$module.'&action=fix&id='.$id; ?>" class="btn btn-warning"><i class="fa fa-wrench"></i></a>
                </td>
                <?php endif; ?>
                <?php if(checkPermission($group_id, 'book', 'delete')): ?>
                <td class="board_td text-center">
                    <a href="?module=book&action=delete&id=<?php echo $id; ?>" onclick="return confirm('bạn có chắc chắc muốn quá không !!!');" class="btn btn-danger"><i class="fa fa-trash-alt "></i></a>
                </td>
                <?php endif; ?>
            </tr>

        <?php

        endforeach;
        else:
            echo '<td colspan="10" class="text-center board_td text-danger">Không có dữ liệu</td>';
        endif;

        ?>
        </tbody>
    </table>

    <br>

<?php
    if(!empty($totalPage) && $totalPage > 1 ):

        $back = $page-1;
        if($back < 1){
            $back = 1;
        }
        $next = $page+1;
        if($next > $totalPage){
            $next = $totalPage;
        }

?>    

    <nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item d-<?php echo $page==1?'none':'block'; ?>">
        <a class="page-link" href="<?php echo "?module=$module$urlFilter&page=$back"; ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
        </a>
        </li>

<?php

        $pageS = $page-2;
        if($pageS < 1){
            $pageS = 1;
        }
        $pageE = $page+2;
        if($pageE > $totalPage){
            $pageE = $totalPage;
        }    

        for ($i=$pageS; $i <= $pageE; $i++):

?>

        <li class="page-item <?php echo $page==$i?'active':''; ?>"><a class="page-link" href="<?php echo "?module=$module$urlFilter&page=$i"; ?>"><?php echo $i; ?></a></li>

<?php

        endfor;

?>

        <li class="page-item d-<?php echo $page==$totalPage?'none':'block'; ?>">
        <a class="page-link" href="<?php echo "?module=$module$urlFilter&page=$next"; ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
        </a>
        </li>
    </ul>
    </nav>

<?php endif; ?>    

</div>


