<?php

$body = getRequest('get');


if(!empty($body['token'])){
    $token = $body['token'];
    $detailUser = getRow("SELECT * FROM user WHERE token='$token'");
    if(!empty($detailUser)){
        $id = $detailUser['id'];
    }else{
        setFlashData('msg', 'url này không tồn tại');
        setFlashData('type', 'danger');
        redirect("?module=auth&action=login");
    }
}else{
    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
    redirect("?module=auth&action=login");
}

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
            'token' => '',
            'password' => $password
        ];

        if(update('user', $dataUpdate, "id='$id'")){
            setFlashData('msg', 'Đổi mật khẩu thành công');
            setFlashData('type', 'success');
            redirect("?module=auth&action=login");
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

    redirect("?module=auth&action=change_password&token=$token");

}

$msg = getFlashData('msg');
$type = getFlashData('type');
$errors = getFlashData('errors');
$old = getFlashData('old');

?>

<div class="container_my padding_X">

<h2 class="text-center py-3">ĐỔI MẬT KHẨU CỦA BẠN</h2>

<div class="padding_X pb-3">

    <div class="padding_X">

    <?php getAlert($msg, $type); ?>

    <form action="" method="post" class="" id="register">

    <hr>

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
    <input type="submit" value="Đổi mật khẩu" class="btn btn-danger w-100">
    </div>

    </form>

    </div>

    <div class="padding_X text-center">
    <p class="text-center d-inline-block">Bạn chưa có tài khoản? <a href="?module=auth&action=register">Đăng ký ngay</a></p>
    \
    <p class="text-center d-inline-block">Bạn đã có tài khoản? <a href="?module=auth&action=login">Đăng nhập ngay</a></p>
    </div>

</div>

</div>