

<?php

$myData = _MY_DATA;
$id = $myData['id'];

if(is_Post()){

    $data = getRequest();
    $errors = [];

    if(empty($data['password'])){
        $errors['password'] = 'Vui lòng nhập thông tin';
    }else{
        if(strlen(trim($data['password'])) < 5){
            $errors['password'] = 'Mật khẩu không được dưới 5 ký tự';
        }
    }

    if(empty($data['confirm'])){
        $errors['confirm'] = 'Vui lòng nhập thông tin';
    }else{
        if($data['confirm'] != $data['password']){
            $errors['confirm'] = 'Vui lòng nhập giống mật khẩu';
        }
    }

    if(empty($errors)){

        $password = password_hash($data['password'], PASSWORD_DEFAULT);

        $dataUpdate = [
            'password' => $password
        ];

        if(update('user', $dataUpdate, "id='$id'")){
            setFlashData('msg', 'Đổi mật khẩu thành công');
            setFlashData('type', 'success');
        }else{
            setFlashData('msg', 'Lỗi hệ thống');
            setFlashData('type', 'danger');
        }

    }else{
        setFlashData('msg', 'Vui lòng kiểm tra form của bạn');
        setFlashData('type', 'danger');
        setFlashData('old', $data);
        setFlashData('errors', $errors);
    }

    redirect("?module=profile&action=change_password");

}

$msg = getFlashData('msg');
$type = getFlashData('type');
$errors = getFlashData('errors');
$old = getFlashData('old');

?>


<div class="profile_information bg-white border bra-10 p-3">

<?php getAlert($msg, $type); ?>

<h3>Đổi mật khẩu</h3>
<hr>

<form action="" method="post">

    <div class="form-group">
        <label for="">Mật khẩu</label>
        <input type="password" name="password" class="form-control" value="<?php echo !empty($old['password'])?$old['password']:''; ?>">
        <?php !empty($errors['password'])?formError($errors['password']):''; ?>
    </div>


    <div class="form-group">
        <label for="">Nhập mật khẩu</label>
        <input type="password" name="confirm" class="form-control" value="<?php echo !empty($old['confirm'])?$old['confirm']:''; ?>">
        <?php !empty($errors['confirm'])?formError($errors['confirm']):''; ?>
    </div>

    <div class="form-group">
    <input type="submit" value="Đổi mật khẩu" class="btn btn-primary">
    </div>


</form>

</div>