
<?php

$group_id = _MY_DATA['id_group'];

if(!checkPermission($group_id, 'course', 'add')){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}

require _WEB_PATH_ROOT.'/admin/course/model/add.php';

if(is_Post()){

    $data = getRequest('post');

    $errors = [];

    if(empty($data['title'])){
        $errors['title'] = 'Vui lòng điền thông tin';
    }else{
        if(strlen(trim($data['title'])) < 5){
            $errors['title'] = 'Thông tin không được dưới 5 ký tự';
        }
    }

    if(empty($data['price'])){
        $errors['price'] = 'Vui lòng điền thông tin';
    }else{
        if(!preg_match('~^[0-9]+$~', $data['price'])){
            $errors['price'] = 'Vui lòng điền số';
        }
    }

    if(empty($data['course_type_id'])){
        $errors['course_type_id'] = 'Vui lòng chọn thông tin';
    }

    if(!empty($data['discount'])){
        if(!preg_match('~^[0-9]+$~', $data['discount'])){
            $errors['discount'] = 'Vui lòng điền số';
        }
    }

    if(empty($errors)){
        $dataInsert = [
            'title' => $data['title'],
            'price' => $data['price'],
            'course_type_id' => $data['course_type_id'],
            'status' => 0,
            'author_id' => _MY_DATA['id'],
            'discount' => $data['discount'],
            'learned' => $data['learned'],
            'about' => $data['about'],
            'create_at' => date('Y-m-d H:i:s')
        ];

        if(!empty($_FILES['image']['name'])){
            $image = $_FILES['image'];
            $nameImage = time().'_'.$image['name'];
            $toFile =  _WEB_PATH_IMAGE_CLIENT.'/'.$nameImage;
            // chỉ xóa khi update
            // if(file_exists(_WEB_PATH_IMAGE_CLIENT.'/'.$listProducts['image'])){
            // $statuLink = unlink(_WEB_PATH_IMAGE_CLIENT.'/'.$listProducts['image']);
            // }            
            move_uploaded_file($image['tmp_name'], $toFile);
            $dataInsert['image'] = $nameImage;
        }

        if(insert('course', $dataInsert)){
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

    redirect('?module='.$module.'&action=add');
}

$msg = getFlashData('msg');
$type = getFlashData('type');
$old = getFlashData('old');
$errors = getFlashData('errors');

?>











<div class="container_my">

    <?php getAlert($msg, $type); ?>

    <form action="" method="post" class="row mx-0" enctype="multipart/form-data">

        <div class="form-group col-12">
            <label for="">Tiêu đề</label>
            <input type="text" name="title" value="<?php echo !empty($old['title'])?$old['title']:''; ?>" class="form-control"> 
            <?php echo !empty($errors['title'])?formError($errors['title']):''; ?>
        </div>

        <div class="form-group col-6">
            <label for="">Ảnh</label>
            <input type="file" name="image" class="form-control"> 
            <!-- <?php echo !empty($errors['title'])?formError($errors['title']):''; ?> -->
        </div>

        <div class="form-group col-6">
            <label for="">Giá</label>
            <input type="text" name="price" value="<?php echo !empty($old['price'])?$old['price']:''; ?>" class="form-control"> 
            <?php echo !empty($errors['price'])?formError($errors['price']):''; ?>
        </div>
        
        <div class="form-group col-6">
            <label for="">Danh mục</label>
            <select class="form-control" name="course_type_id" id="">
                <option value="">Chọn</option>
                <?php 
                if($allCourseType):
                    foreach ($allCourseType as $key => $value):
                ?>
                    <option <?php echo !empty($old['course_type_id']) && $old['course_type_id'] == $value['id']?'selected':''; ?> value="<?php echo $value['id']; ?>"><?php echo $value['name'].' - '.$value['id']; ?></option>
                <?php endforeach;endif; ?>
            </select>
            <?php echo !empty($errors['course_type_id'])?formError($errors['course_type_id']):''; ?>
        </div>

        <div class="form-group col-6">
            <label for="">Giảm giá</label>
            <input type="text" name="discount" value="<?php echo !empty($old['discount'])?$old['discount']:''; ?>" class="form-control"> 
            <?php echo !empty($errors['discount'])?formError($errors['discount']):''; ?>
        </div>


        <div class="form-group col-12">
            <label for="">Học được</label>
            <textarea name="learned" id="" cols="30" rows="10" class="ckediter"><?php echo !empty($old['learned'])?$old['learned']:''; ?></textarea>
            <?php echo !empty($errors['learned'])?formError($errors['learned']):''; ?>
        </div>

        <div class="form-group col-12">
            <label for="">Về khóa học</label>
            <textarea name="about" id="" cols="30" rows="10" class="ckediter"><?php echo !empty($old['about'])?$old['about']:''; ?></textarea>
            <?php echo !empty($errors['about'])?formError($errors['about']):''; ?>
        </div>

        <div class="form-group col-12">
                <input type="submit" value="Thêm" class="btn btn-primary w-100">        
        </div>

    </form>
    <hr>                
    <a href="?module=<?php echo $module; ?>" class="btn btn-success mb-3">Danh sách</a>               

</div>