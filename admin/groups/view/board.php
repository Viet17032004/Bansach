<?php

$body = getRequest('get');

$count = 0;
$filter = '';
$urlFilter = '';

$id_group = _MY_DATA['id_group'];

if(!empty($body['page'])){
    $page = $body['page'];
}else{
    $page = 1;
}

$filter .= " WHERE id<>'7' ";

if(!empty($body['keywork'])){
    $keywork = $body['keywork'];
    $filter .= " AND `name` like '%$keywork%' ";
    $urlFilter = "&keywork=$keywork";
}

$msgdl = getFlashData('msgdl');
$typedl = getFlashData('typedl');

require _WEB_PATH_ROOT.'/admin/groups/model/board.php';

$count = 0;

?>

<div class="container_double">

<div class="">
<?php 

if(!empty($body['view'])){
    $view = $body['view'];
}else{
    $view = 'add';
}
         
?>
    <?php view($view, 'admin', 'groups'); ?> 
</div>


<div>

    <h5>Danh sách nhóm</h5>
    <hr>

    <?php getAlert($msgdl, $typedl); ?>

    <form action="" method="get" class="">
        <div class="row mx-0">
            <input type="hidden" name="module" value="<?php echo $module; ?>">
            <div class="form-group col-10">
                <input type="text" class="form-control" name="keywork" value="<?php echo !empty($keywork)?$keywork:''; ?>">
            </div>
            <div class="form-group col-2">
                <button class="btn btn-primary w-100" type="submit">Tìm</button>  
            </div>
            
        </div>
    </form>

    <table class="w-100">

    <thead>
        <tr>
            <th width="10%" class="board_th">STT</th>
            <th class="board_th">Tên</th>
            <?php if(checkPermission($id_group, 'group', 'permission')): ?>
            <th width="20%" class="board_th">Phân quyền</th>
            <?php endif; ?>
            <?php if(!empty(checkPermission($id_group, 'group', 'fix'))): ?>
            <th width="10%" class="board_th">Sửa</th>
            <?php endif; ?>
            <?php if(!empty(checkPermission($id_group, 'group', 'delete'))): ?>
            <th width="10%" class="board_th">Xóa</th>
            <?php endif; ?>
        </tr>
    </thead>

    <tbody>
    <?php

    if(!empty($allGroup)):
    foreach ($allGroup as $key => $item): 
    extract($item);

    $count++;

    ?>

        <tr>
            <td class="board_td text-center"><?php echo $count; ?></td>
            <td class="board_td"><?php echo $name; ?></td>
            <?php if(checkPermission($id_group, 'group', 'permission')): ?>
            <td class="board_td text-center">
                <a href="<?php echo '?module=permission&id='.$id; ?>" class="btn btn-success"><i class="fa fa-cog"></i></a>
            </td>
            <?php endif; ?>
            <?php if(!empty(checkPermission($id_group, 'group', 'fix'))): ?>
            <td class="board_td text-center">
                <a href="<?php echo '?module='.$module.'&view=fix&id='.$id; ?>" class="btn btn-warning"><i class="fa fa-wrench"></i></a>
            </td>
            <?php endif; ?>
            <?php if(checkPermission($id_group, 'group', 'delete')): ?>
            <td class="board_td text-center">
                <a href="?module=groups&action=delete&id=<?php echo $id; ?>" onclick="return confirm('bạn có chắc chắc muốn quá không !!!');" class="btn btn-danger"><i class="fa fa-trash-alt "></i></a>
            </td>
            <?php endif; ?>
        </tr>

    <?php

    endforeach;
    else:
        echo '<td colspan="4" class="text-center board_td text-danger">Không có dữ liệu</td>';
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




</div>