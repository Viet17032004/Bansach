<?php

$id_group = _MY_DATA['id_group'];

if(empty(checkPermission($id_group, 'user', 'delete_user'))){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}

$body = getRequest('get');

if(!empty($body['id'])){
    $id = $body['id'];
    $detailUser = getRow("SELECT id FROM user WHERE id='$id'");
    if(!empty($detailUser)){
        $allLogin = getCountRows("SELECT id FROM login_token WHERE user_id='$id'");
        $allOrder = getCountRows("SELECT id FROM order_pro WHERE user_id='$id'");
        $allStar = getCountRows("SELECT id FROM star_rating WHERE user_id='$id'");
        $allAnswer = getCountRows("SELECT id FROM answer_exam WHERE user_id='$id'");
        $allMyCourse = getCountRows("SELECT id FROM my_course WHERE user_id='$id'");
        $allResultExam = getCountRows("SELECT id FROM result_exam WHERE user_id='$id'");
        $allMakeExam = getCountRows("SELECT id FROM make_exam WHERE user_id='$id'");
        $allCart = getCountRows("SELECT id FROM cart WHERE user_id='$id'");
        $allBlog = getCountRows("SELECT id FROM blog WHERE author_id='$id'");
        $allComment = getCountRows("SELECT id FROM comment WHERE user_id='$id'");
        $allCourse = getCountRows("SELECT id FROM course WHERE author_id='$id'");
        $allExam = getCountRows("SELECT id FROM exam WHERE author_id='$id'");

        if(empty($allLogin) && empty($allOrder) && empty($allStar) && empty($allAnswer) && empty($allMyCourse) && empty($allResultExam) && empty($allMakeExam) && empty($allCart) && empty($allBlog) && empty($allComment) && empty($allCourse) && empty($allExam)){
            if(delete('user', "id='$id'")){
                setFlashData('msg', 'Xóa người dùng thành công');
                setFlashData('type', 'success');
            }else{
                setFlashData('msg', 'Lỗi hệ thống');
                setFlashData('type', 'danger');
            }
        }else{
            setFlashData('msg', 'Tài khoản này vẫn còn sự liên kết !!!');
            setFlashData('type', 'danger');
        }

    }else{
        setFlashData('msg', 'Url này không tồn tại !!!');
        setFlashData('type', 'danger');
    }
}else{
    setFlashData('msg', 'url này lỗi !!!');
    setFlashData('type', 'danger');
}

redirect($_SERVER['HTTP_REFERER']);

?>