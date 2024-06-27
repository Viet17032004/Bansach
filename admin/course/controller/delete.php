<?php

$id_group = _MY_DATA['id_group'];

if(empty(checkPermission($id_group, 'course', 'delete'))){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}

$body = getRequest('get');

if(!empty($body['id'])){
    $id = $body['id'];
    $detailCourse = getRow("SELECT id FROM course WHERE id='$id'");
    if(!empty($detailCourse)){
       
        $allMyCourse = getRaw("SELECT id FROM my_course WHERE course_id='$id'");
        $allChapter = getRaw("SELECT id FROM chapter_course WHERE course_id='$id'");
        $allComment = getRaw("SELECT id FROM comment WHERE course_id='$id'");

        if(empty($allMyCourse) && empty($allChapter) && empty($allComment)){
            if(delete('course', "id='$id'")){
                setFlashData('msg', 'Xóa thành công');
                setFlashData('type', 'success');
            }else{
                setFlashData('msg', 'Lỗi hệ thống');
                setFlashData('type', 'danger');
            }
        }else{
            setFlashData('msg', 'khóa học này vẫn còn liên kết');
            setFlashData('type', 'danger');
        }

    }else{
        setFlashData('msg', 'url này không tồn tại !!!');
        setFlashData('type', 'danger');
    }
}else{
    setFlashData('msg', 'url này lỗi !!!');
    setFlashData('type', 'danger');
}

redirect($_SERVER['HTTP_REFERER']);

?>