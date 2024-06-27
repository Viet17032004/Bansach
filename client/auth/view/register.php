<?php

if(isLogin()){
    setFlashData('msg', 'Bạn đang đăng nhập');
    setFlashData('type', 'danger');
    redirect(_WEB_HOST_ROOT);
}

if(is_Post()){

    $data = getRequest();
    $errors = [];

    if(empty($data['fullname'])){
        $errors['fullname'] = "Vui lòng nhập thông tin";
    }else{
        if(strlen(trim($data['fullname'])) < 5){
            $errors['fullname'] = 'Tên không được dưới 5 ký tự';
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

        $token = uniqid().time();

        $dataInsert = [
            'fullname' => $data['fullname'],
            'id_group' => 4,
            'email' => $data['email'],
            'status' => 0,
            'token' => $token,
            'password' => $password,
            'create_at' => date("Y-m-d H:i:s")
        ];

        if(insert('user', $dataInsert)){

            $fullname = $data['fullname'];

            $subject = "KÍCH HOẠI TÀI KHOẢN CỦA BẠN";

            $content = "<h3>Xin chào $fullname.</h3>";
            $content .= "<p>Chào mừng bạn tới SMARTFL (nơi cung cấp những khóa học bổ ích), chúng tôi nhận được tài khoản của bạn.</p>";
            $content .= "<p>Đây là link kích hoại: </p>";
            $content .= '<a href="'._WEB_HOST_ROOT.'?module=auth&action=active&token='.$token.'">Học cùng SMARTFL</a>';
            $content .= '<p>Chúc bạn có những giờ học cùng SMARTFL vui vẻ.</p>';
            $content .= '<p>Trân trọng.</p>';

            if(sendMail($email, $subject, $content)){
                setFlashData('msg', 'Tài khoản của bạn đã được tạo | Hãy tới email để kích hoại tài khoản');
                setFlashData('type', 'success');
                redirect('?module=auth&action=login');
            }else{
                setFlashData('msg', 'Hãy liên hệ cho chúng tôi để khắc phục sự cố');
                setFlashData('type', 'danger');
            }

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

    redirect("?module=auth&action=register#register");

}

$msg = getFlashData('msg');
$type = getFlashData('type');
$errors = getFlashData('errors');
$old = getFlashData('old');

?>

<div class="container_my padding_X">

<h2 class="text-center py-3">ĐĂNG KÝ TÀI KHOẢN</h2>

<div class="padding_X pb-3">

    <div class="padding_X">

    <?php getAlert($msg, $type); ?>

    <form action="" method="post" class="" id="register">

    <hr>

    <div class="form-group">
        <label for="">Tên</label>
        <input type="text" name="fullname" class="form-control" value="<?php echo !empty($old['fullname'])?$old['fullname']:''; ?>">
        <?php !empty($errors['fullname'])?formError($errors['fullname']):''; ?>
    </div>

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

    <div class="form-group">
        <label for="">Nhập mật khẩu</label>
        <input type="password" name="confirm" class="form-control" value="<?php echo !empty($old['confirm'])?$old['confirm']:''; ?>">
        <?php !empty($errors['confirm'])?formError($errors['confirm']):''; ?>
    </div>

    <div class="form-group">
    <input type="submit" value="Đăng ký ngay" class="btn btn-danger w-100">

    </div>

    </form>

    </div>



    <p class="text-center">Bạn đã có tài khoản? <a href="?module=auth&action=login">Đăng nhập ngay</a></p>

</div>

</div>