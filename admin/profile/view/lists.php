<?php

$myData = _MY_DATA;

$id = $myData['id'];

$id_group = $myData['id_group'];

$detailGroup = getRow("SELECT * FROM groups WHERE id='$id_group'");

if(is_Post()){

    $data = getRequest();

    $errors = [];

    $email = $data['email'];

    if(empty($data['fullname'])){
        $errors['fullname'] = 'Vui lòng nhập thông tin';
    }else{
        if(strlen(trim($data['fullname'])) < 5){
            $errors['fullname'] = 'Tên không thể dưới 5 ký tự';
        }
    }

    if(empty($data['email'])){
        $errors['email'] = 'Vui lòng nhập thông tin';
    }else{
        if(!preg_match('~[^@]{2,64}@[^.]{2,253}\.[0-9a-z-.]{2,63}~', $data['email'])){
            $errors['email'] = 'Vui lòng nhập đúng định dạng email';
        }else{
            if(getCountRows("SELECT id FROM user WHERE email='$email' AND id<>'$id'")){
                $errors['email'] = 'Email này đã có trên hệ thống';
            }
        }
    }

    if(!empty($data['phone'])){
        $phone = $data['phone'];
        if(!preg_match('~^0[0-9]{9}$~', $data['phone'])){
            $errors['phone'] = 'Vui lòng nhập đúng định dạng số điện thoại việt nam';
        }else{
            if(getCountRows("SELECT id FROM user WHERE id<>'$id' AND phone='$phone'")){
                $errors['phone'] = 'Số điện thoại này đã có trên hệ thống';
            }
        }
    }

    if(!empty($data['address'])){
        if(strlen(trim($data['address'])) < 20){
            $errors['address'] = 'Địa chỉ không thể dưới 20 ký tự';
        }
    }

    if(empty($errors)){ 

        $dataUpdate = [
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
        ];

        if(!empty($_FILES['image']['name'])){
            $image = $_FILES['image'];
            $nameImage = time().'_'.$image['name'];
            $toFile =  _WEB_PATH_IMAGE_CLIENT.'/'.$nameImage;
            // chỉ xóa khi update
            if(file_exists(_WEB_PATH_IMAGE_CLIENT.'/'.$myData['image'])){
            $statuLink = unlink(_WEB_PATH_IMAGE_CLIENT.'/'.$myData['image']);
            }            
            move_uploaded_file($image['tmp_name'], $toFile);
            $dataUpdate['image'] = $nameImage;
        }

        if(update("user", $dataUpdate, "id='$id'")){
            setFlashData('msg', 'Cập nhập thông tin thành công');
            setFlashData('type', 'success');
        }else{  
            setFlashData('msg', 'Lỗi hệ thống');
            setFlashData('type', 'danger');
        }

    }else{
        setFlashData('msg', 'Vui lòng kiểm tra lại form');
        setFlashData('type', 'danger');
        setFlashData('old', $data);
        setFlashData('errors', $errors);
    }

    redirect("?module=profile");

}

$msg = getFlashData('msg');
$type = getFlashData('type');
$errors = getFlashData('errors');
$old = getFlashData('old');
if(empty($old)){
    $old = $myData;
}

?>


<div class="container_my">

<div class="profile_information bra-10 p-3">

<?php getAlert($msg, $type); ?>

<form action="" method="post" class="row mx-0" enctype="multipart/form-data">

<div class="form-group col-6">
    <label for="">Họ và tên</label>
    <input type="text" class="form-control" value="<?php echo !empty($old['fullname'])?$old['fullname']:'';?>" name="fullname">
    <?php !empty($errors['fullname'])?formError($errors['fullname']):''; ?>
</div>

<div class="form-group col-6">
    <label for="">Số điện thoại</label>
    <input type="text" class="form-control" value="<?php echo !empty($old['phone'])?$old['phone']:'';?>" name="phone">
    <?php !empty($errors['phone'])?formError($errors['phone']):''; ?>
</div>

<div class="form-group col-6">
    <label for="">Email</label>
    <input type="text" class="form-control" value="<?php echo !empty($old['email'])?$old['email']:'';?>" name="email">
    <?php !empty($errors['email'])?formError($errors['email']):''; ?>
</div>

<div class="form-group col-6">
    <label for="">Địa chỉ</label>
    <input type="text" class="form-control" value="<?php echo !empty($old['address'])?$old['address']:'';?>" name="address">
    <?php !empty($errors['address'])?formError($errors['address']):''; ?>
</div>


<div class="form-group col-6">
    <label for="">Ảnh</label>
    <input type="file" name="image" class="form-control">
</div>

<div class="form-group col-6">
    <label for="">Quyền</label>
    <span class="btn btn-warning d-block w-100 form-control">
        <?php echo $detailGroup['name']; ?>
    </span>
</div>

<input type="submit" value="Cập nhật" class="btn btn-primary w-100">




</form>


</div>


</div>