

<?php

$group_id = _MY_DATA['id_group'];

if(!checkPermission($group_id, 'comment', 'comment_book')){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}

$body = getRequest('get');

$count = 0;
$filter = '';
$urlFilter = '';

if(!empty($body['keywork'])){
    $keywork = $body['keywork'];
    $filter .= " AND `comment` LIKE '%$keywork%' ";
    $urlFilter .= "&keywork=$keywork";
}


if(!empty($body['page'])){
    $page = $body['page'];
}else{
    $page = 1;
}

require _WEB_PATH_ROOT.'/admin/comment/model/board_book.php';


$msg = getFlashData('msg');
$type = getFlashData('type');

?>


<div class="container_my">

    <?php getAlert($msg, $type); ?>
    <form action="" method="get" class="mx-0 row">

        <input type="hidden" name="module" value="<?php echo $module; ?>">
        <input type="hidden" name="action" value="<?php echo 'lists_book'; ?>">

        <div class="form-group col-10">
            <input type="text" name="keywork" value="<?php echo !empty($keywork)?$keywork:''; ?>" class="form-control">
        </div>

        <div class="form-group col-2">
            <input type="submit" value="Tìm" class="form-control btn btn-primary">
        </div>

    </form>
<?php
    
        ?>
    <table class="w-100">
        <thead>
            <tr>
                <th width="2%" class="board_th">STT</th>
                <th width="5%" class="board_th">Tên danh mục</th>
                <th width="5%" class="board_th">Tên sản phẩm</th>
                <th width="15%" class="board_th">Nội dung</th>
                <th width="10%" class="board_th">Thông tin người bình luận </th>
                <th width="10%" class="board_th">Ngày bình luận</th>
                <th width="5%" class="board_th">Chi tiết</th>
                <th width="5%" class="board_th">Xóa</th>
            </tr>
        </thead>
        <tbody>
        <?php
        
        if(!empty($allComment) ):
        foreach ($allComment  as $key => $item): 
        extract($item);

        $count++;

        ?>
        
                        
            <tr>
                <td class="board_td text-center"><a href=""></a><?php echo $id; ?></td>    
                <td class="board_td text-center"><a href=""><?php echo $name; ?></a></td>
                <td class="board_td text-center"><a href=""><?php echo $title; ?></a></td>
                <td class="board_td "><?php echo $comment; ?></td>
                
                

                    <td class="board_td text-left"> 
                        <p>Tên: <a href=""><?php echo $fullname; ?></a></p> 
                        <p>Email: <a href=""><?php echo $email; ?></a></p> 
                        <p>Số điện thoại: <a href=""><?php echo $phone; ?></a></p> 
                    </td>
                 
                <td class="board_td text-center"><a href=""><?php echo getTimeFormat($create_at, 'Y/m/d'); ?></a></td>
                <td class="board_td text-center">
                    <a href="?module=comment&action=children_book&id=<?php echo $id; ?>" onclick="" class="btn btn-success"> <i class="fa fa-comment"></i></a>
                </td>
                <td class="board_td text-center">
                    <a href="" onclick="return confirm('bạn có chắc chắc muốn quá không !!!');" class="btn btn-danger"><i class="fa fa-trash-alt "></i></a>
                </td>
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


