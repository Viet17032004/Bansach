<?php

$id_group = _MY_DATA['id_group'];

if(empty(checkPermission($id_group, 'course_type', 'delete'))){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}

$body = getRequest('get');

if(!empty($body['id'])){
    $id = $body['id'];
    $detailCourseType = getRow("SELECT id FROM course_type WHERE id='$id'");
    if(!empty($detailCourseType)){
        $allCourse = getCountRows("SELECT id FROM course WHERE course_type_id='$id'");
        if(empty($allCourse)){
            if(delete('course_type', "id='$id'")){
                setFlashData('msgdl', 'Xóa thành công');
                setFlashData('typedl', 'success');
            }else{
                setFlashData('msgdl', 'Lỗi hệ thống');
                setFlashData('typedl', 'danger');
            }
        }else{
            setFlashData('msgdl', 'Vẫn còn khóa học sử dụng loại khóa học này');
            setFlashData('typedl', 'danger');
        }
    }else{
        setFlashData('msgdl', 'url này không tồn tại !!!');
        setFlashData('typedl', 'danger');
    }
}else{
    setFlashData('msgdl', 'url này lỗi !!!');
    setFlashData('typedl', 'danger');
}

redirect($_SERVER['HTTP_REFERER']);

?>