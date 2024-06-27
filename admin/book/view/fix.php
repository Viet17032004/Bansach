
<?php

$group_id = _MY_DATA['id_group'];

if(!checkPermission($group_id, 'book', 'fix')){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}

$body = getRequest('get');

if(!empty($body['id'])){
    $id = $body['id'];
    require _WEB_PATH_ROOT.'/admin/book/model/fix.php';

    if(!empty($detailBook)){
        
    }else{
        setFlashData('msg', 'url này không tồn tại');
        setFlashData('type', 'danger');
        redirect('?module=book');
    }
}else{
    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
    redirect('?module=book');
}


if(is_Post()){

    $data = getRequest('post'); // getRequest()

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

    if(empty($data['book_type_id'])){
        $errors['book_type_id'] = 'Vui lòng chọn thông tin';
    }

    if(empty($data['quantity'])){
        $errors['quantity'] = 'Vui lòng chọn thông tin';
    }

    $quantity = $data['quantity'];

    if(empty($errors)){

        if(empty($quantity)) $quantity = 0; 

        $dataUpdate = [
            'title' => $data['title'],
            'price' => $data['price'],
            'quantity' => $quantity,
            'book_type_id' => $data['book_type_id'],
            'description' => $data['description'],
            'content' => $data['content'],
            'update_at' => date('Y-m-d H:i:s')
        ];

        if(!empty($_FILES['image']['name'])){
            $image = $_FILES['image'];
            $nameImage = time().'_'.$image['name'];
            $toFile =  _WEB_PATH_IMAGE_CLIENT.'/'.$nameImage;
            // chỉ xóa khi update
            // if(file_exists(_WEB_PATH_IMAGE_CLIENT.'/'.$detailBook['image'])){
            // $statuLink = unlink(_WEB_PATH_IMAGE_CLIENT.'/'.$detailBook['image']);
            // }            
            move_uploaded_file($image['tmp_name'], $toFile);
            $dataUpdate['image'] = $nameImage;
        }

        

        if(update('book', $dataUpdate, "id='$id'")){
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

    redirect('?module=book&action=fix&id='.$id);
}

$msg = getFlashData('msg');
$type = getFlashData('type');
$old = getFlashData('old');
$errors = getFlashData('errors');

if(empty($old)){
    $old = $detailBook;
}


?>


<div class="container_my">

    <?php getAlert($msg, $type); ?>

    <form action="" method="post" class="row mx-0" enctype="multipart/form-data">

        <div class="form-group col-6">
            <label for="">Tiêu đề</label>
            <input type="text" name="title" value="<?php echo !empty($old['title'])?$old['title']:''; ?>" class="form-control"> 
            <?php echo !empty($errors['title'])?formError($errors['title']):''; ?>
        </div>

        <div class="form-group col-6">
            <label for="">Số lượng</label>
            <input type="number" name="quantity" value="<?php echo !empty($old['quantity'])?$old['quantity']:''; ?>" class="form-control"> 
            <span class="text-danger"><?php echo !empty($errors['quantity'])?$errors['quantity']:''; ?></span>
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
        
        <div class="form-group col-12">
            <label for="">Danh mục sách</label>
            <select class="form-control" name="book_type_id" id="">
                <option value="">Chọn</option>
                <?php 
                if($allBookType):
                    foreach ($allBookType as $key => $value):
                ?>
                    <option <?php echo !empty($old['book_type_id']) && $old['book_type_id'] == $value['id']?'selected':''; ?> value="<?php echo $value['id']; ?>"><?php echo $value['name'].' - '.$value['id']; ?></option>
                <?php endforeach;endif; ?>
            </select>
            <?php echo !empty($errors['book_type_id'])?formError($errors['book_type_id']):''; ?>
        </div>



        <div class="form-group col-12">
            <label for="">Mô tả</label>
            <textarea name="description" id="" cols="30" rows="10" class="ckediter"><?php echo !empty($old['description'])?$old['description']:''; ?></textarea>
            <?php echo !empty($errors['description'])?formError($errors['description']):''; ?>
        </div>

        <div class="form-group col-12">
            <label for="">Nội dung</label>
            <textarea name="content" id="" cols="30" rows="10" class="ckediter"><?php echo !empty($old['content'])?$old['content']:''; ?></textarea>
            <?php echo !empty($errors['content'])?formError($errors['content']):''; ?>
        </div>

        <div class="form-group col-12">
                <input type="submit" value="Sửa" class="btn btn-primary w-100">        
        </div>

    </form>
    <hr>                
    <a href="?module=<?php echo $module; ?>" class="btn btn-success mb-3">Danh sách</a>               

</div>