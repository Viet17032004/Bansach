
<?php 

$id_group = _MY_DATA['id_group'];

if(empty(!checkPermission($id_group, 'chapter_course', 'fix'))):

$body = getRequest('get');

if(!empty($body['chapter_id']) && !empty($body['id'])){
    $chapter_id = $body['chapter_id'];
    require _WEB_PATH_ROOT.'/admin/chapter_course/model/fix.php';

    if(!empty($detailChapter)){
        
    }else{
        setFlashData('msg', 'url này không tồn tại');
        setFlashData('type', 'danger');
        redirect('?module=chapter_course&id='.$id);
    }
}else{
    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
    redirect('?module=chapter_course&id='.$id);
}

if(is_Post()){

    $data = getRequest();


    $errors = [];

    if(empty($data['name'])){
        $errors['name'] = 'Vui lòng điền thông tin';
    }

    if(empty($errors)){
        $dataUpdate = [
            'name' => $data['name'],
            'update_at' => date('Y-m-d H:i:s')
        ];
        if(update('chapter_course', $dataUpdate, "id='$chapter_id'")){
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
        setFlashData('errers', $errors);
    }

    redirect('?module=chapter_course&view=fix&id='.$id.'&chapter_id='.$chapter_id);

}


$msg = getFlashData('msg');
$type = getFlashData('type');
$errors = getFlashData('errers');
$old = getFlashData('old');

if(empty($old)){
    $old = $detailChapter;
}

?>


<h5>Sửa chương</h5>
<hr>
<?php getAlert($msg, $type); ?>
<form action="" method="post">

<div class="form-group">
    <label for="">Name</label>
    <input type="text" name="name" value="<?php echo !empty($old['name'])?$old['name']:''; ?>" class="form-control">   
    <?php !empty($errors['name'])?formError($errors['name']):''; ?>
</div>
<button type="submit" class="btn btn-primary">Sửa</button>
</form>

<hr>
<a href="?module=chapter_course&id=<?php echo $id; ?>" class="btn btn-success">Thêm</a>

<?php endif; ?>