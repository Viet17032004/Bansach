<?php

if(isLogin()){
    setFlashData('msg', 'Bạn đang đăng nhập');
    setFlashData('type', 'danger');
    redirect(_WEB_HOST_ROOT);
}

if(is_Post()){

    $data = getRequest();

    $errors = [];
    
    if(empty($data['email'])){
        $errors['email'] = "Vui lòng nhập thông tin";
    }else{
        if(!preg_match('~[^@]{2,64}@[^.]{2,253}\.[0-9a-z-.]{2,63}~', $data['email'])){
            $errors['email'] = 'Vui lòng nhập đúng định dạng email';
        }else{
            $email = $data['email'];
            if(!getRow("SELECT * FROM user WHERE email='$email'")){
                $errors['email'] = 'Email không tồn tại trên hệ thống';
            }
        }
    }

    if(empty($data['password'])){
        $errors['password'] = 'Vui lòng nhập thông tin';
    }else{
        $email = $data['email'];
        $detailUser = getRow("SELECT * FROM user WHERE email='$email'");
        if(!empty($detailUser)){
            $password = $detailUser['password'];
            if(!password_verify($data['password'], $password)){
                $errors['password'] = "Mật khẩu không đúng";
            }
        }
    }



    if(empty($errors)){
        if(!empty($detailUser['status'])){

        $token = uniqid().time();
        $user_id = $detailUser['id'];

        $dataInsert = [
            'token' => $token,
            'user_id' => $user_id,
            'create_at' => date('Y-m-d H:i:s')
        ];

        if(insert('login_token', $dataInsert)){
            setFlashData('msg', 'Đăng nhập thành công');
            setFlashData('type', 'success');
            setSession('loginToken', $token);
            redirect(_WEB_HOST_ROOT);
        }else{
            setFlashData('msg', 'Lỗi hệ thống');
            setFlashData('type', 'danger');
        }

        }else{
            setFlashData('msg', 'Tài khoản đang bị khóa');
            setFlashData('type', 'danger');
        }


    }else{
        setFlashData('msg', 'Vui lòng kiểm tra form của bạn');
        setFlashData('type', 'danger');
        setFlashData('old', $data);
        setFlashData('errors', $errors);
    }

    redirect("?module=auth&action=login");

}

$msg = getFlashData('msg');
$type = getFlashData('type');
$errors = getFlashData('errors');
$old = getFlashData('old');


?>


<div class="container_my padding_X">

<h2 class="text-center py-3">ĐĂNG NHẬP TÀI KHOẢN CỦA BẠN</h2>

<div class="padding_X pb-3">

    <div class="padding_X">

    <?php getAlert($msg, $type); ?>

    <form action="?module=auth&action=login" method="post" class="">

    <hr>

    <div class="form-group">
        <label for="">Email</label>
        <input type="text" name="email" class="form-control" value="<?php echo !empty($old['email'])?$old['email']:''; ?>">
        <?php !empty($errors['email'])?formError($errors['email']):''; ?>
    </div>

    <div class="form-group">
        <label for="">Mật khẩu</label>
        <input type="password" name="password" class="form-control" value="<?php echo !empty($old['password'])?$old['password']:''; ?>">
        <?php !empty($errors['password'])?formError($errors['password']):''; ?>

        </div>

    <a href="?module=auth&action=forgot" class="d-block w-100 text-center mb-3">Quên mật khẩu</a>

    <div class="form-group">
    <input type="submit" value="Đăng nhập ngay" class="btn btn-danger w-100">

    </div>

    </form>

    </div>



    <p class="text-center">Bạn chưa có tài khoản? <a href="?module=auth&action=register">Đăng ký ngay</a></p>

</div>

</div>