<?php

$group_id = _MY_DATA['id_group'];

if(!checkPermission($group_id, 'option', 'header')){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}

if(is_Post()){

    $data = getRequest();

    $errors = [];

    if(empty($data['web_phone'])){
        $errors['web_phone'] = 'Vui lòng điền thông tin';
    }else{
        if(!preg_match('~^0[0-9]{9}$~', $data['web_phone'])){
            $errors['web_phone'] = 'Điền đúng định dạng số điện thoại';
        }
    }

    if(empty($data['web_email'])){
        $errors['web_email'] = 'Vui lòng điền thông tin';
    }else{
        if(!preg_match('~[^@]{2,64}@[^.]{2,253}\.[0-9a-z-.]{2,63}~', $data['web_email'])){
            $errors['web_email'] = 'Điền đúng định dạng email';
        }
    }



    if(empty($errors)){
        update('options', ['opt_value' => $data['web_phone']], "opt_key='web_phone'");
        update('options', ['opt_value' => $data['link_phone']], "opt_key='link_phone'");
        update('options', ['opt_value' => $data['web_email']], "opt_key='web_email'");
        update('options', ['opt_value' => $data['link_email']], "opt_key='link_email'");
        update('options', ['opt_value' => $data['web_youtube']], "opt_key='web_youtube'");
        update('options', ['opt_value' => $data['web_facebook']], "opt_key='web_facebook'");
        update('options', ['opt_value' => $data['web_twitter']], "opt_key='web_twitter'");
        setFlashData('msg', 'Cập nhập thành công');
        setFlashData('type', 'success');
    }else{
        setFlashData('msg', 'Kiểm tra form');
        setFlashData('type', 'danger');
        setFlashData('web_phone', $data['web_phone']);
        setFlashData('link_phone', $data['link_phone']);
        setFlashData('web_email', $data['web_email']);
        setFlashData('link_email', $data['link_email']);
        setFlashData('web_youtube', $data['web_youtube']);
        setFlashData('web_facebook', $data['web_facebook']);
        setFlashData('web_twitter', $data['web_twitter']);
        setFlashData('errors', $errors);
    }

    redirect('?module=option&action=header');

}

$web_phone = getFlashData('web_phone');
if(empty($web_phone)){
    $web_phone = getRow("SELECT * FROM options WHERE opt_key='web_phone'")['opt_value'];
}

$link_phone = getFlashData('link_phone');                                           
if(empty($link_phone)){
    $link_phone = getRow("SELECT * FROM options WHERE opt_key='link_phone'")['opt_value'];
}

$web_email = getFlashData('web_email');
if(empty($web_email)){
    $web_email = getRow("SELECT * FROM options WHERE opt_key='web_email'")['opt_value'];
}


$link_email = getFlashData('link_email');
if(empty($link_email)){
    $link_email = getRow("SELECT * FROM options WHERE opt_key='link_email'")['opt_value'];
}

$web_youtube = getFlashData('web_youtube');
if(empty($web_youtube)){
    $web_youtube = getRow("SELECT * FROM options WHERE opt_key='web_youtube'")['opt_value'];
}

$web_facebook = getFlashData('web_facebook');
if(empty($web_facebook)){
    $web_facebook = getRow("SELECT * FROM options WHERE opt_key='web_facebook'")['opt_value'];
}

$web_twitter = getFlashData('web_twitter');
if(empty($web_twitter)){
    $web_twitter = getRow("SELECT * FROM options WHERE opt_key='web_twitter'")['opt_value'];
}

$errors = getFlashData('errors');
$msg = getFlashData('msg');
$type = getFlashData('type');




?>

<div class="container_my">

<?php getAlert($msg, $type); ?>

<form action="" method="post" class="row mx-0">

    <div class="form-group col-6">
        <label for="">Số điện thoại</label>
        <input type="text" name="web_phone" class="form-control" value="<?php echo $web_phone ?>">
        <?php !empty($errors['web_phone'])?formError($errors['web_phone']):''; ?>
    </div>

    <div class="form-group col-6">
        <label for="">Link số điện thoại</label>
        <input type="text" name="link_phone" class="form-control" value="<?php echo $link_phone ?>">
    </div>

    <div class="form-group  col-6">
        <label for="">Email</label>
        <input type="text" name="web_email" class="form-control" value="<?php echo $web_email ?>">
        <?php !empty($errors['web_email'])?formError($errors['web_email']):''; ?>
    </div>

    <div class="form-group col-6">
        <label for="">Link email</label>
        <input type="text" name="link_email" class="form-control" value="<?php echo $link_email ?>">
    </div>

    <div class="form-group col-6">
        <label for="">Link youtube</label>
        <input type="text" name="web_youtube" class="form-control" value="<?php echo $web_youtube ?>">
    </div>

    <div class="form-group col-6">
        <label for="">Link facebook</label>
        <input type="text" name="web_facebook" class="form-control" value="<?php echo $web_facebook ?>">
    </div>

    <div class="form-group col-12">
        <label for="">Link twitter</label>
        <input type="text" name="web_twitter" class="form-control" value="<?php echo $web_twitter ?>">
    </div>

    <div class="form-group col-12">
        <input type="submit" value="Cập nhập" class="btn btn-primary">
    </div>

</form>





</div>