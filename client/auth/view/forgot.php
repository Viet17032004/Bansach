<?php

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
            $detailUser = getRow("SELECT * FROM user WHERE email='$email'");
            if(empty($detailUser)){
                $errors['email'] = 'Email không tồn tại trên hệ thống';
            }
        }
    }


    if(empty($errors)){

            $fullname = $detailUser['fullname'];
            $id = $detailUser['id'];
            $token = uniqid().time();

            $dataUpdate = [
                'token' => $token
            ];

            if(update('user', $dataUpdate, "id='$id'")){

            $subject = "ĐỔI MẬT KHẨU TÀI KHOẢN CỦA BẠN";

            $content = "<h3>Xin chào $fullname.</h3>";
            $content .= "<p>Chúng tôi đã nhận được yêu cầu đổi mật khẩu của bạn.</p>";
            $content .= "<p>Đây là link đổi mật khẩu: </p>";
            $content .= '<a href="'._WEB_HOST_ROOT.'?module=auth&action=change_password&token='.$token.'">Hãy nhớ mật khẩu của bạn nhé</a>';
            $content .= '<p>Chúc bạn có những giờ học cùng SMARTFL vui vẻ.</p>';
            $content .= '<p>Trân trọng.</p>';

            if(sendMail($email, $subject, $content)){
                setFlashData('msg', 'Chúng tôi đã gửi link đổi mật khẩu cho bạn | hãy vào đó để đổi');
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

    redirect("?module=auth&action=forgot");

}


$msg = getFlashData('msg');
$type = getFlashData('type');
$errors = getFlashData('errors');
$old = getFlashData('old');

?>


<div class="container_my padding_X">

<h2 class="text-center py-3">NHẬP EMAIL CỦA BẠN</h2>

<div class="padding_X pb-3">

    <div class="padding_X">

    
    <?php getAlert($msg, $type); ?>

    <form action="" method="post" class="">

    <hr>

    <div class="form-group">
        <label for="">Email</label>
        <input type="text" name="email" class="form-control" value="<?php echo !empty($old['email'])?$old['email']:''; ?>">
        <?php !empty($errors['email'])?formError($errors['email']):''; ?>
    </div>

    <div class="form-group">
    <input type="submit" value="Gửi email" class="btn btn-danger w-100">

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