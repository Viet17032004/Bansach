
<?php 

$id_group = _MY_DATA['id_group'];

if(!empty(checkPermission($id_group, 'exercise_course', 'fix'))):

$body = getRequest('get');

if(!empty($body['chapter_id']) && !empty($body['id'])){
    $id = $body['id'];
    require _WEB_PATH_ROOT.'/admin/exercise_course/model/fix.php';

    if(!empty($detailExercise)){
        
    }else{
        setFlashData('msg', 'url này không tồn tại');
        setFlashData('type', 'danger');
        redirect('?module=exercise_course&chapter_id='.$chapter_id);
    }
}else{
    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
    redirect('?module=exercise_course&chapter_id='.$chapter_id);
}

if(is_Post()){

    $data = getRequest();

    $errors = [];

    if(empty($data['title'])){
        $errors['title'] = 'Vui lòng điền thông tin';
    }
    
    if(empty($data['video'])){
        $errors['video'] = 'Vui lòng điền thông tin';
    }else{
        // $iframe = $data['video'];
        // if(!preg_match('~^\s*<iframe.+<\/iframe>\s*$~', $iframe)){
        //     $errors['video'] = 'Dữ liệu phải là nhúng';
        // }                                                   
    }

    if(empty($errors)){
        $dataUpdate = [ 
            'title' => $data['title'],
            'video' => $data['video'],
            'update_at' => date('Y-m-d H:i:s')
        ];
        if(update('exercise_course', $dataUpdate, "id='$id'")){
            setFlashData('msg', 'Sửa thành công !!!');
            setFlashData('type', 'success');
        }else{
            setFlashData('msg', 'Lỗi hệ thống !!!');
            setFlashData('type', 'danger');
        }
    }else{
        setFlashData('msg', 'Vui lòng kiểm tra form !!!');
        setFlashData('type', 'danger');
        setFlashData('old', $data);
        setFlashData('errors', $errors);
    }

    redirect('?module=exercise_course&view=fix&chapter_id='.$chapter_id."&id=$id");

}


$msg = getFlashData('msg');
$type = getFlashData('type');
$errors = getFlashData('errors');
$old = getFlashData('old');

if(empty($old)){
    $old = $detailExercise;
}


?>


<h5>Thêm chương</h5>
<hr>
<?php getAlert($msg, $type); ?>
<form action="" method="post">

<div class="form-group">
    <label for="">Name</label>
    <input type="text" name="title" value="<?php echo !empty($old['title'])?$old['title']:''; ?>" class="form-control">   
    <?php !empty($errors['title'])?formError($errors['title']):''; ?>
</div>

<div class="form-group">
    <label for="">Video</label>
    <textarea name="video" id="" cols="30" rows="5" class="form-control"><?php echo !empty($old['video'])?$old['video']:''; ?></textarea>
    <?php !empty($errors['video'])?formError($errors['video']):''; ?>
</div>

<button type="submit" class="btn btn-primary">Sửa</button>
<hr>
<div class="form-group text-center">
    <label for="">Video hiện tại</label> <br>
    <?php echo !empty($old['video'])?html_entity_decode($old['video']):''; ?>
</div>

</form>

<hr>
<a href="?module=exercise_course&chapter_id=<?php echo $chapter_id; ?>" class="btn btn-success w-100">Thêm</a>
<hr>

<?php endif; ?>

