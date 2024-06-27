
<?php

$group_id = _MY_DATA['id_group'];

if(!checkPermission($group_id, 'admin', 'add_admin')){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}

$allGroups = getRaw("SELECT id, name FROM groups WHERE id<>'7'");

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
            if(getRow("SELECT * FROM user WHERE email='$email'")){
                $errors['email'] = 'Email đã tồn tại trên hệ thống';
            }
        }
    }

    if(empty($data['password'])){
        $errors['password'] = 'Vui lòng điền thông tin';
    }

    if(empty($data['confirm'])){
        $errors['confirm'] = 'Vui lòng điền thông tin';
    }else{
        if($data['confirm'] != $data['password']){
            $errors['confirm'] = 'Thông tin không giống mật khẩu';
        }
    }

    if(empty($data['permission'])){
        $errors['permission'] = 'Vui lòng chọn thông tin';
    }

    if(empty($errors)){

        $password = $data['password'];

        $password = password_hash($password, PASSWORD_DEFAULT);

        $dataInsert = [
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'password' => $password,
            'status' => 1,
            'id_group' => $data['permission'],
            'create_at' => date('Y-m-d H:i:s')
        ];



        if(insert('user', $dataInsert)){
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

    redirect('?module='.$module.'&action=add_admin');
}

$msg = getFlashData('msg');
$type = getFlashData('type');
$old = getFlashData('old');
$errors = getFlashData('errors');

// echo '<pre>';
// print_r($old);
// echo '</pre>';

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
            <select class="form-control" name="permission" id="">
                <option value="0">Chọn</option>
                <?php 
                    if(!empty($allGroups)):
                        foreach ($allGroups as $key => $value):
                            ?>
                    <option <?php echo !empty($old['permission']) && $old['permission']==$value['id']?'selected':''; ?> value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                    <?php endforeach; endif;  ?>
                </select>
            <?php echo !empty($errors['permission'])?formError($errors['permission']):''; ?>

            </div>
            
        <div class="form-group col-12">
            <label for="">Mật khẩu</label>
            <input type="password" name="password" value="<?php echo !empty($old['password'])?$old['password']:''; ?>" class="form-control"> 
            <?php echo !empty($errors['password'])?formError($errors['password']):''; ?>
        </div>

        <div class="form-group col-12">
            <label for="">Nhập lại mật khẩu</label>
            <input type="password" name="confirm" value="<?php echo !empty($old['confirm'])?$old['confirm']:''; ?>" class="form-control"> 
            <?php echo !empty($errors['confirm'])?formError($errors['confirm']):''; ?>
        </div>
        

        <div class="form-group col-12">
                <input type="submit" value="Thêm" class="btn btn-primary w-100">        
        </div>

    </form>
    <hr>                
    <a href="?module=user&action=lists_admin" class="btn btn-success mb-3">Danh sách</a>               

</div>