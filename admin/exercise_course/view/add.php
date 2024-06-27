
<?php 

$id_group = _MY_DATA['id_group'];

if(!empty(checkPermission($id_group, 'exercise_course', 'add'))):

$course_id = getRow("SELECT course_id FROM chapter_course WHERE id='$chapter_id'")['course_id'];

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
        $dataInsert = [ 
            'title' => $data['title'],
            'chapter_id' => $chapter_id,
            'video' => $data['video'],
            'create_at' => date('Y-m-d H:i:s')
        ];
        if(insert('exercise_course', $dataInsert)){
            setFlashData('msg', 'Thêm thành công !!!');
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

    redirect('?module=exercise_course&chapter_id='.$chapter_id);

}


$msg = getFlashData('msg');
$type = getFlashData('type');
$errors = getFlashData('errors');
$old = getFlashData('old');


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

<button type="submit" class="btn btn-primary">Thêm</button>

</form>

<hr>

<a href="?module=chapter_course&id=<?php echo $course_id; ?>" class="btn btn-success">Danh sách</a>

<?php endif; ?>