
<?php 

$id_group = _MY_DATA['id_group'];

if(empty(!checkPermission($id_group, 'chapter_course', 'add'))):

if(is_Post()){

    $data = getRequest();


    $errors = [];

    if(empty($data['name'])){
        $errors['name'] = 'Vui lòng điền thông tin';
    }

    if(empty($errors)){
        $dataInsert = [
            'name' => $data['name'],
            'course_id' => $id,
            'create_at' => date('Y-m-d H:i:s')
        ];
        if(insert('chapter_course', $dataInsert)){
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
        setFlashData('errers', $errors);
    }

    redirect('?module=chapter_course&id='.$id);

}


$msg = getFlashData('msg');
$type = getFlashData('type');
$errors = getFlashData('errers');
$old = getFlashData('old');


?>


<h5>Thêm chương</h5>
<hr>
<?php getAlert($msg, $type); ?>
<form action="" method="post">

<div class="form-group">
    <label for="">Name</label>
    <input type="text" name="name" value="<?php echo !empty($old['name'])?$old['name']:''; ?>" class="form-control">   
    <?php !empty($errors['name'])?formError($errors['name']):''; ?>
</div>
<button type="submit" class="btn btn-primary">Thêm</button>

</form>

<hr>

<a href="?module=course" class="btn btn-success">Danh sách</a>

<?php endif; ?>