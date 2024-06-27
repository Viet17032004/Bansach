
<?php


$group_id = _MY_DATA['id_group'];

if(!checkPermission($group_id, 'admin', 'fix_admin')){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}

$body = getRequest('get');

if(!empty($body['id'])){
    $id = $body['id'];
        $detailUser = getRow("SELECT * FROM user WHERE id='$id'");
    if(!empty($detailUser)){
       $allGroups = getRaw("SELECT id, name FROM groups WHERE id<>'7'");
    }else{
        setFlashData('msg', 'url này không tồn tại');
        setFlashData('type', 'danger');
        redirect('?module=user');
    }
}else{
    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
    redirect('?module=user');
}


if(is_Post()){

    $data = getRequest('post');

    $errors = [];

    if(empty($data['fullname'])){
        $errors['fullname'] = 'Vui lòng điền thông tin';
    }else{
        if(strlen(trim($data['fullname'])) < 5){
            $errors['fullname'] = 'Thông tin không được dưới 5 ký tự';
        }
    }

    if(empty($data['email'])){
        $errors['email'] = "Vui lòng nhập thông tin";
    }else{
        if(!preg_match('~[^@]{2,64}@[^.]{2,253}\.[0-9a-z-.]{2,63}~', $data['email'])){
            $errors['email'] = 'Vui lòng nhập đúng định dạng email';
        }else{
            $email = $data['email'];
            if(getRow("SELECT * FROM user WHERE email='$email' AND id<>'$id'")){
                $errors['email'] = 'Email đã tồn tại trên hệ thống';
            }
        }
    }

    if(!empty($data['password']) && $data['confirm'] != $data['password']){
        $errors['confirm'] = 'Thông tin không giống mật khẩu';
    }



    if(empty($errors)){

     

        $dataUpdate = [
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'id_group' => $data['id_group'],
            'update_at' => date('Y-m-d H:i:s')
        ];

        if(!empty($data['password'])){
            $password = $data['password'];
            $password = password_hash($password, PASSWORD_DEFAULT);
            $dataUpdate['password']=$password;
            
        }


        if(update('user', $dataUpdate, "id='$id'")){
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

    redirect('?module='.$module.'&action=fix_admin&id='.$id);
}


$msg = getFlashData('msg');
$type = getFlashData('type');
$old = getFlashData('old');
$errors = getFlashData('errors');

if(empty($old)){
    $old = $detailUser;
}


?>



<div class="container_my">

    <?php getAlert($msg, $type); ?>

    <form action="" method="post" class="row mx-0" enctype="multipart/form-data">

        <div class="form-group col-12">
            <label for="">Tên người dùng</label>
            <input type="text" name="fullname" value="<?php echo !empty($old['fullname'])?$old['fullname']:''; ?>" class="form-control"> 
            <?php echo !empty($errors['fullname'])?formError($errors['fullname']):''; ?>
        </div>


      


        <div class="form-group col-12">
            <label for="">Email</label>
            <input type="text" name="email" value="<?php echo !empty($old['email'])?$old['email']:''; ?>" class="form-control"> 
            <?php echo !empty($errors['email'])?formError($errors['email']):''; ?>
        </div>
        

        <div class="form-group col-12">
            <label for="">Quyền</label>
            <select class="form-control" name="id_group" id="">
                <option value="0">Chọn</option>
                <?php 
                    if(!empty($allGroups)):
                        foreach ($allGroups as $key => $value):
                            ?>
                    <option <?php echo !empty($old['id_group']) && $old['id_group']==$value['id']?'selected':''; ?> value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                    <?php endforeach; endif;  ?>
                </select>
            <?php echo !empty($errors['id_group'])?formError($errors['id_group']):''; ?>

        </div>

        <div class="form-group col-12">
            <label for="">Mật khẩu</label>
            <input type="password" name="password" class="form-control" value="" placeholder="Chỉ đổi khi điền mật khẩu">
            <?php !empty($errors['password'])?formError($errors['password']):''; ?>
        </div>

        <div class="form-group col-12">
            <label for="">Nhập mật khẩu</label>
            <input type="password" name="confirm" class="form-control" value="" placeholder="Chỉ đổi khi điền mật khẩu">
            <?php !empty($errors['confirm'])?formError($errors['confirm']):''; ?>
        </div>

        <div class="form-group col-12">
                <input type="submit" value="Sửa" class="btn btn-primary w-100">        
        </div>

    </form>
    <hr>                
    <a href="?module=user&action=lists_admin" class="btn btn-success mb-3">Danh sách</a>               

</div>