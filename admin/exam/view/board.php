

<?php

$group_id = _MY_DATA['id_group'];

if(!checkPermission($group_id, 'exam', 'lists')){
    redirect(_WEB_HOST_ERORR."/permission.php");
}

$body = getRequest('get');

$count = 0;
$filter = '';
$urlFilter = '';

if(!empty($body['keywork'])){
    $keywork = $body['keywork'];
    $filter .= " WHERE e.title LIKE '%$keywork%' ";
    $urlFilter .= "&keywork=$keywork";
}

if(!empty($body['exam_type'])){
    $exam_type = $body['exam_type'];

    if(!empty($filter)){
        $filter .= " AND `exam_type_id` = '$exam_type' ";
    }else{
        $filter .= " WHERE `exam_type_id` = '$exam_type' ";        
    }
    $urlFilter .= "&exam_type=$exam_type";
}

if(!empty($body['author_id'])){
    $author_id = $body['author_id'];

    if(!empty($filter)){
        $filter .= " AND `author_id` = '$author_id' ";
    }else{
        $filter .= " WHERE `author_id` = '$author_id' ";        
    }
    $urlFilter .= "&author_id=$author_id";
}

if(!empty($body['page'])){
    $page = $body['page'];
}else{
    $page = 1;
}

require _WEB_PATH_ROOT.'/admin/exam/model/board.php';

$msg = getFlashData('msg');
$type = getFlashData('type');

?>


<div class="container_my">

<?php getAlert($msg, $type); ?>
    <?php if(checkPermission($group_id, 'exam', 'add')): ?>
    <a href="?module=exam&action=add" class="btn btn-primary mb-3">Thêm <i class="fa fa-plus mx-1"></i></a>
    <?php endif; ?>
    <form action="" method="get" class="mx-0 row">

        <input type="hidden" name="module" value="<?php echo $module; ?>">

        <div class="form-group col-4">
            <input type="text" name="keywork" value="<?php echo !empty($keywork)?$keywork:''; ?>" class="form-control">
        </div>

        <div class="form-group col-3">
            <select name="exam_type" class="form-control">
                <option value="">Chọn</option>
                <?php
                    if(!empty($allExamType)):
                        foreach ($allExamType as $key => $value):
                ?>
                <option <?php echo !empty($exam_type) && $exam_type == $value['id']?'selected':''; ?> value="<?php echo $value['id']; ?>"><?php echo $value['name'].' - '.$value['id']; ?></option>
                <?php endforeach; endif; ?>
            </select>
        </div>

        <div class="form-group col-3">
            <select name="author_id" class="form-control">
                <option value="">Chọn</option>
                <?php
                    if(!empty($allAuthor)):
                        foreach ($allAuthor as $key => $value):
                ?>
                <option <?php echo !empty($author_id) && $author_id == $value['id']?'selected':''; ?> value="<?php echo $value['id']; ?>"><?php echo $value['fullname'].' - '.$value['email']; ?></option>
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
                <th width="15%" class="board_th">Thông tin</th>
                <th width="15%" class="board_th">Ảnh</th>
                <th width="5%" class="board_th">Loại exam</th>
                <th width="10%" class="board_th">Người đăng</th>
                <th width="15%" class="board_th">Giờ bán</th>
                <th width="15%" class="board_th">Giờ làm</th>
                <?php if(checkPermission($group_id, 'exam', 'approve')): ?>
                <th width="10%" class="board_th">Trạng thái</th>
                <?php endif; ?>
                <?php if(checkPermission($group_id, 'exam', 'fix')): ?>
                <th width="5%" class="board_th">Sửa</th>
                <?php endif; ?>
                <?php if(checkPermission($group_id, 'exam', 'delete')): ?>
                <th width="5%" class="board_th">Xóa</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
        <?php

        if(!empty($allExam)):
        foreach ($allExam as $key => $item): 
        $count++;

        ?>

            <tr>
                <td class="board_td text-center"><?php echo $count; ?></td>
                <td class="board_td">
                    <span>Tiêu đề: <a href="?module=question_exam&exam_id=<?php echo $item['id']; ?>"><?php echo $item['title']; ?></a></span> <br>
                    <span>Giá bán: <?php echo $item['price']; ?> VND</span> <br>
                </td>
                <td class="board_td text-center"><img width="90%" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/'.$item['image']; ?>" alt=""></td>
                <td class="board_td text-center"><?php echo $item['t_name']; ?></a></td>
                <td class="board_td text-center"><?php echo $item['u_name']; ?></a></td>
                <td class="board_td ">
                    <span>Giờ mở bán: <br> <?php echo $item['time_open']; ?></span> <br>
                    <span>Giờ đóng cửa: <br> <?php echo $item['time_close']; ?></span> <br>
                </td>
                <td class="board_td ">
                    <span>Giờ bắt đầu: <br> <?php echo $item['time_start']; ?></span> <br>
                    <span>Số phút làm: <br> <?php echo $item['time_make']; ?></span> <br>
                </td>
                <?php if(checkPermission($group_id, 'exam', 'approve')): ?>
                <td class="board_td text-center"><a href="?module=exam&action=approve&id=<?php echo $item['id']; ?>" class="btn btn-<?php echo $item['status']==1?'success':'danger'; ?>"><?php echo $item['status']==1?'Duyệt':'Chưa Duyệt'; ?></a></td>
                <?php endif; ?>
                <?php if(checkPermission($group_id, 'exam', 'fix')): ?>
                <td class="board_td text-center">
                    <a href="<?php echo '?module='.$module.'&action=fix&id='.$item['id']; ?>" class="btn btn-warning"><i class="fa fa-wrench"></i></a>
                </td>
                <?php endif; ?>
                <?php if(checkPermission($group_id, 'exam', 'delete')): ?>
                <td class="board_td text-center">
                    <a href="?module=exam&action=delete&id=<?php echo $item['id']; ?>" onclick="return confirm('bạn có chắc chắc muốn quá không !!!');" class="btn btn-danger"><i class="fa fa-trash-alt "></i></a>
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


