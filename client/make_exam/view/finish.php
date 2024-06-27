<?php

if(!isLogin()){
    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
    redirect('?module=exam');
}

$body = getRequest('get');

if(!empty($body['result_exam_id'])){
    $result_exam_id = $body['result_exam_id'];

    require _WEB_PATH_ROOT.'/client/make_exam/model/finish.php';

    if(!empty($detailResultExam)){

    }else{
        setFlashData('msg', 'url này không tồn tại');
        setFlashData('type', 'danger');
        redirect("?module=exam"); 
    }

}else{
    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
    redirect("?module=exam"); 
}

extract($detailResultExam);

$point = ($number_right/$number_question)*10;

?>

<div class="background_result_exam d-flex" style="background-image: url('<?php echo _WEB_HOST_TEMPLATE.'/client/assets/image/Tuyển-tập-những-mẫu-khung-ảnh-đẹp-nhất-hiện-nay-35-1024x683.png'; ?>');">

<div  iv class="flex_center mx-auto text-center">
    <h2>Xin chúc mừng: <?php echo $u_name; ?></h2>
    <h2 class="text-center">Đúng: <?php echo $number_right.' / '.$number_question; ?> câu</h2>
    <h3 class="text-center">Điểm: <?php echo $point; ?> điểm</h3>
    <a href="<?php echo _WEB_HOST_ROOT; ?>" class="btn btn-primary p-3">Giờ hãy quay trở lại học nào !</a>
</div>

</div>
