<?php

$id_group = _MY_DATA['id_group'];

if(empty(checkPermission($id_group, 'exercise_course', 'lists'))){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}

$body = getRequest('get');

if(!empty($body['page'])){
    $page = $body['page'];
}else{
    $page = 1;
}

if(!empty($body['chapter_id'])){
    $chapter_id = $body['chapter_id'];
}

$count = 0;
$filter = '';
$urlFilter = '';

if(!empty($body['keywork'])){
    $keywork = $body['keywork'];
    $filter .= " AND e.title LIKE '%$keywork%' ";
    $urlFilter .= "&keywork=$keywork";
}


if(!empty($body['chapter_id'])){
    $chapter_id = $body['chapter_id'];
    require _WEB_PATH_ROOT.'/admin/exercise_course/model/board.php';

    if(!empty($detailChapter)){
        
    }else{
        setFlashData('msg', 'url này không tồn tại');
        setFlashData('type', 'danger');
        redirect('?module=course');
    }
}else{
    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
    redirect('?module=course');
}

$msgdl = getFlashData('msgdl');
$typedl = getFlashData('typedl');

?>


<div class="container_double">

    <div>
        <?php
            if(!empty($body['view'])){
                $view = $body['view'];
            }else{
                $view = 'add';
            }
            view($view, 'admin', 'exercise_course', ['chapter_id'=>$chapter_id]);
        ?>
    </div>

    <div>
    <h5>Danh sách bài</h5>
    <hr>

    <?php getAlert($msgdl, $typedl); ?>

    <form action="" method="get" class="mx-0 row">

        <input type="hidden" name="module" value="<?php echo $module; ?>">

        <div class="form-group col-10">
            <input type="text" name="keywork" value="<?php echo !empty($keywork)?$keywork:''; ?>" class="form-control">
        </div>

        <div class="form-group col-2">
            <input type="submit" value="Tìm" class="form-control btn btn-primary">
        </div>

        <input type="hidden" name="chapter_id" value="<?php echo $chapter_id; ?>">


    </form>

    <table class="w-100">
        <thead>
            <tr>
                <th width="5%" class="board_th">STT</th>
                <th width="" class="board_th">Tiêu đề</th>
                <?php if(checkPermission($id_group, 'exercise_course', 'fix')): ?>
                <th width="5%" class="board_th">Sửa</th>
                <?php endif; ?>
                <?php if(checkPermission($id_group, 'exercise_course', 'delete')): ?>
                <th width="5%" class="board_th">Xóa</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
        <?php

        if(!empty($allExerciseCourse)):
        foreach ($allExerciseCourse as $key => $item): 

        $count++;

        ?>

            <tr>
                <td class="board_td text-center"><?php echo $count; ?></td>
                <td class="board_td"><?php echo $item['title']; ?></td>
                <?php if(checkPermission($id_group, 'exercise_course', 'fix')): ?>
                <td class="board_td text-center">
                    <a href="<?php echo '?module='.$module."&view=fix&chapter_id=$chapter_id&id=".$item['id']; ?>" class="btn btn-warning"><i class="fa fa-wrench"></i></a>
                </td>
                <?php endif; ?>
                <?php if(checkPermission($id_group, 'exercise_course', 'delete')): ?>
                <td class="board_td text-center">
                    <a href="?module=exercise_course&action=delete&id=<?php echo $item['id']; ?>" onclick="return confirm('bạn có chắc chắc muốn quá không !!!');" class="btn btn-danger"><i class="fa fa-trash-alt "></i></a>
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
        <a class="page-link" href="<?php echo "?module=$module$urlFilter&page=$back&chapter_id=$chapter_id"; ?>" aria-label="Previous">
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

        <li class="page-item <?php echo $page==$i?'active':''; ?>"><a class="page-link" href="<?php echo "?module=$module$urlFilter&page=$i&chapter_id=$chapter_id"; ?>"><?php echo $i; ?></a></li>

<?php

        endfor;

?>

        <li class="page-item d-<?php echo $page==$totalPage?'none':'block'; ?>">
        <a class="page-link" href="<?php echo "?module=$module$urlFilter&page=$next&chapter_id=$chapter_id"; ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
        </a>
        </li>
    </ul>
    </nav>

<?php endif; ?>   

    </div>


</div>


 