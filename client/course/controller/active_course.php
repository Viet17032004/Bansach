<?php


if(is_Post()){

    $data = getRequest();

    if(!empty($data['user_id'] && !empty($data['course_id']))){

        $user_id = $data['user_id'];
        $course_id = $data['course_id'];
        $active = $data['active'];

        $detailActiveCourse = getRow("SELECT id FROM my_course WHERE user_id='$user_id' AND course_id='$course_id' AND active='$active'");
        if(!empty($detailActiveCourse)){
            $dataUpdate = [
                'status' => 1
            ];
            if(update('my_course', $dataUpdate, "user_id='$user_id' AND course_id='$course_id'")){
                setFlashData('msg', 'Kích hoạt khóa học thành công !!!');
                setFlashData('type', 'success');
            }else{
                setFlashData('msg', 'Kích hoạt khóa học thất bại !!!');
                setFlashData('type', 'danger');
            }
        }else{
            setFlashData('msg', 'Kích hoạt khóa học thất bại !!!');
            setFlashData('type', 'danger');
        }
    }else{
        setFlashData('msg', 'Kích hoạt khóa học thất bại !!!');
        setFlashData('type', 'danger');
    }


}else{
    setFlashData('msg', 'Kích hoạt khóa học thất bại !!!');
    setFlashData('type', 'danger');
}

redirect($_SERVER['HTTP_REFERER']);


?>