

<?php

$data = [
    'titlePage' => 'Cảm ơn'
];

layout('header', 'client', $data);

?>


<div class="container_my padding_X">






<?php


if(!isLogin() || empty(getSession('active_course'))){
    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
    redirect("?module=course");
}

$body = getRequest('get');



if(!empty($body['course_id'])):

    $user_id = _MY_DATA['id'];

    $course_id = $body['course_id'];

if(!empty($body['vnp_BankTranNo'])){

    $checkActiveCourse = getCountRows("SELECT * FROM my_course WHERE user_id='$user_id' AND course_id='$course_id'");

    $dataInsert = [
        'user_id' => $user_id,
        'course_id' => $course_id,
        'active' => rand(),   
        'status' => 0,
        'create_at' => date('Y-m-d H:i:s')
    ]; 

    if(!empty($checkActiveCourse)){
        delete('my_course', "user_id='$user_id' AND course_id='$course_id'");
        insert("my_course", $dataInsert);
    }else{
        insert("my_course", $dataInsert);
    }

    $detailUser = getRow("SELECT * FROM user WHERE id='$user_id'");

    $email = $detailUser['email'];

    $subject = "SMARTFL XIN GỬI BẠN MÃ KÍCH HOẠT KHÓA HỌC";

    $detailActiveCourse = getRow("SELECT * FROM my_course WHERE user_id='$user_id' AND course_id='$course_id'");

    $token = $detailActiveCourse['active'];

    $content = '<h3>Xin chào '.$detailUser['fullname'].'</h3>';
    $content .= '<p>Xin cảm ơn bạn đã tin tưởng và mua khóa học của chúng tôi.</p>';
    $content .= '<p>Link khóa học cần xác nhận: <a href="'._WEB_HOST_ROOT."/?module=course&action=detail_course&course_id=$course_id".'">bấm vào đây để đến khóa học.</a></p>';
    $content .= "<p>Đây là mã xác nhận $token.</p>";
    $content .= "<p>Chúc bạn có những giờ học cùng SAMRTFL vui vẻ.</p>";

    $send = sendMail($email, $subject, $content);

    if(!empty($send)){
        setFlashData('msg','Thanh toán thành công | hãy vào email để lấy mã kích hoạt');
        setFlashData('type', 'success');
        removeSession('active_course');
        view('text_thank', 'client', 'cart');
    }



}elseif(empty($body['resultCode']) && !empty($body['partnerCode'])){

  
    $checkActiveCourse = getCountRows("SELECT * FROM my_course WHERE user_id='$user_id' AND course_id='$course_id'");

    $dataInsert = [
        'user_id' => $user_id,
        'course_id' => $course_id,
        'active' => rand(),   
        'status' => 0,
        'create_at' => date('Y-m-d H:i:s')
    ]; 

    if(!empty($checkActiveCourse)){
        delete('my_course', "user_id='$user_id' AND course_id='$course_id'");
        insert("my_course", $dataInsert);
    }else{
        insert("my_course", $dataInsert);
    }

    $detailUser = getRow("SELECT * FROM user WHERE id='$user_id'");

    $email = $detailUser['email'];

    $subject = "SMARTFL XIN GỬI BẠN MÃ KÍCH HOẠT KHÓA HỌC";

    $detailActiveCourse = getRow("SELECT * FROM my_course WHERE user_id='$user_id' AND course_id='$course_id'");

    $token = $detailActiveCourse['active'];

    $content = '<h3>Xin chào '.$detailUser['fullname'].'</h3>';
    $content .= '<p>Xin cảm ơn bạn đã tin tưởng và mua khóa học của chúng tôi.</p>';
    $content .= '<p>Link khóa học cần xác nhận: <a href="'._WEB_HOST_ROOT."/?module=course&action=detail_course&course_id=$course_id".'">bấm vào đây để đến khóa học.</a></p>';
    $content .= "<p>Đây là mã xác nhận $token.</p>";
    $content .= "<p>Chúc bạn có những giờ học cùng SAMRTFL vui vẻ.</p>";

    $send = sendMail($email, $subject, $content);

    if(!empty($send)){
        setFlashData('msg','Thanh toán thành công | hãy vào email để lấy mã kích hoạt');
        setFlashData('type', 'success');
        removeSession('active_course');
        view('text_thank', 'client', 'cart');
    }

}elseif(!empty($body['pay_type'])){

 

    $checkActiveCourse = getCountRows("SELECT * FROM my_course WHERE user_id='$user_id' AND course_id='$course_id'");

    $dataInsert = [
        'user_id' => $user_id,
        'course_id' => $course_id,
        'active' => rand(),   
        'status' => 0,
        'create_at' => date('Y-m-d H:i:s')
    ]; 

    if(!empty($checkActiveCourse)){
        delete('my_course', "user_id='$user_id' AND course_id='$course_id'");
        insert("my_course", $dataInsert);
    }else{
        insert("my_course", $dataInsert);
    }

    $detailUser = getRow("SELECT * FROM user WHERE id='$user_id'");

    $email = $detailUser['email'];

    $subject = "SMARTFL XIN GỬI BẠN MÃ KÍCH HOẠT KHÓA HỌC";

    $detailActiveCourse = getRow("SELECT * FROM my_course WHERE user_id='$user_id' AND course_id='$course_id'");

    $token = $detailActiveCourse['active'];

    $content = '<h3>Xin chào '.$detailUser['fullname'].'</h3>';
    $content .= '<p>Xin cảm ơn bạn đã tin tưởng và mua khóa học của chúng tôi.</p>';
    $content .= '<p>Link khóa học cần xác nhận: <a href="'._WEB_HOST_ROOT."/?module=course&action=detail_course&course_id=$course_id".'">bấm vào đây để đến khóa học.</a></p>';
    $content .= "<p>Đây là mã xác nhận $token.</p>";
    $content .= "<p>Chúc bạn có những giờ học cùng SAMRTFL vui vẻ.</p>";

    $send = sendMail($email, $subject, $content);

    if(!empty($send)){
        setFlashData('msg','Thanh toán thành công | hãy vào email để lấy mã kích hoạt');
        setFlashData('type', 'success');
        removeSession('active_course');
        view('text_thank', 'client', 'cart');
    }

}else{
    setFlashData('msg', 'Thanh toán thất bại');
    setFlashData('type', 'danger');
    redirect('?module=course');
}

else:

    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
    redirect("?module=course");

endif;

?>
















</div>


<?php layout('footer', 'client'); ?>