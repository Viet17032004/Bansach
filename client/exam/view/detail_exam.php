
<?php

$body = getRequest('get');

if(!empty($body['id'])){
    $id = $body['id'];
    if(isLogin()){
        $user_id = _MY_DATA['id'];
    }
    require _WEB_PATH_ROOT.'/client/exam/model/detail_exam.php';

    if(!empty($detailExam)){

    }else{
        setFlashData('msg', 'url này không tồn tại');
        setFlashData('type', 'danger');
        redirect("?module=$module");
    }
}else{
    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
    redirect("?module=$module");
}

$time_now = strtotime(date('Y-m-d H:i:s'));

$time_buy = false;

if(strtotime($detailExam['time_open']) < $time_now && strtotime($detailExam['time_close']) > $time_now){
    $time_buy = true;
}

$msg = getFlashData('msg');
$type = getFlashData('type');

getAlert($msg, $type);

?>

<div class="detail_exam">

<img class="image_course bra-10 mx-auto" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/'.$detailExam['image']; ?>" alt="">

<div class="exam_time p-3 bg-white bra-10 border">
    <h4 class="text-primary"><?php echo $detailExam['title']; ?></h4>
    <ul>
        <li>Trạng thái:</li>
        <li>Số câu hỏi: <?php echo !empty($numberQuestionExam)?$numberQuestionExam:'0'; ?></li>
        <li>Thời gian làm bài: <?php echo $detailExam['time_make']; ?> phút</li>
        <li>Giá bán: <?php echo $detailExam['price']; ?></li>
        <li>Thời gian bắt đầu: <?php echo $detailExam['time_start']; ?></li>
        <hr>
        <h6 class="text-center">Thời gian mua bài thi</h6>
        <br>
        <li>Thời gian mở bán: <?php echo $detailExam['time_open']; ?></li>
        <li>Thời gian đóng cửa: <?php echo $detailExam['time_close']; ?></li>
    </ul>
</div>

<div class="btn_exam p-3 bg-white bra-10 border">
    <p class="">
        Lưu ý:
        Thời gian mua bài thi này chỉ trong thời gian quy định. <br>
        Sau thời gian đó bạn sẽ không thể mua bài thi này nữa.
        <hr>
        Thời gian làm bài cũng đã có trong phần chi tiết, khi đến giờ bạn mới có thể làm bài và thời gian làm bài cũng đã được giới hạn trong thời gian cho phép của bài thi.
    </p>
    <?php if(empty($makeExam)): ?>
    <a href="<?php echo !empty($time_buy)?'?module=cart&action=buy_exam&id='.$id:''; ?>" class="btn btn-<?php echo !empty($time_buy)?'primary':'danger'; ?> w-100 mt-3"><?php echo !empty($time_buy)?'Đã mở bán':'Chưa mở bán'; ?></a>
<?php
    else:
    if(strtotime($detailExam['time_start']) > $time_now):  
?>
        <span class="btn btn-success w-100 mt-3">Bạn đã mua bài thi này</span>
<?php
    else:
?>
        <a href="?module=make_exam&make_exam=<?php echo $makeExam['id']; ?>" class="btn btn-primary w-100 mt-3">Vào làm bài thi</a>
<?php
    endif;    
    endif;
?>
</div>


</div>

<?php

$data = [
    'exam_type' => $detailExam['exam_type_id'],
    'exam_id' => $detailExam['id']
];

view('kind_exam', 'client', 'exam', $data);

?>