<?php

if(!isLogin()){
    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
    redirect('?module=exam');
}

$body = getRequest('get');

if(!empty($body['make_exam'])){
    $make_exam = $body['make_exam'];
        require _WEB_PATH_ROOT.'/client/make_exam/model/make.php';
    if(!empty($detailMakeExam)){
        $time_start = strtotime($detailExam['time_start']);
        $time_now = strtotime(date('Y-m-d H:i:s'));
        $start_exam = $time_now-$time_start;
        if($start_exam > 0){

        }else{
            setFlashData('msg', 'Chưa đến giờ làm bài này');
            setFlashData('type', 'danger');
            redirect(_WEB_HOST_ROOT);
        }
    }else{
        setFlashData('msg', 'url này không tồn tại');
        setFlashData('type', 'danger');
        redirect(_WEB_HOST_ROOT);
    }
}else{
    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
    redirect(_WEB_HOST_ROOT);
}

if(is_Post()){

    $data = $_POST;

    $number_question = 0;
    $number_right = 0;

    $arrId = $data['id'];
    $arrAnswer = $data['answer'];

    foreach ($arrId as $key => $id) {
        $number_question++;
        $question = getRow("SELECT * FROM question_exam WHERE id='$id'");
        $right = $question['right_answer'];
        if($right == $arrAnswer[$key]){
            $number_right++;
        }

        $dataInsert = [
            'user_id' => _MY_DATA['id'],
            'exam_id' => $detailExam['id'],
            'number_question' => $number_question,
            'number_right' => $number_right,
            'create_at' => date('Y-m-d H:i:s')
        ];

    }

    if(!empty($dataInsert)){
        delete("make_exam", "id='$make_exam'");
        $statusInsert = insert("result_exam", $dataInsert);
        setFlashData('msg', 'Chúc mừng bạn đã hoàn thành bài kiểm tra !!!');
        setFlashData('type', 'success');
    }

    if(!empty($statusInsert)){
        $newDataResultExam = getRaw("SELECT id FROM result_exam WHERE user_id='$user_id' ORDER BY id DESC");
        $newResultExamId = $newDataResultExam[0]['id'];
    }

    if(!empty($newResultExamId)){
        redirect('?module=make_exam&action=finish&result_exam_id='.$newResultExamId);
    }


}




$count = 0;

?>

<div class="box_information_exam">
<h3 class="text-center text-primary">Tên bài kiểm tra: <span class="text-warning"><?php echo $detailExam['title']; ?></span>.</h3>
<br>
<div class="information_exam">
    <div class="">
        <h4 class="text-primary">Danh mục: <span class="text-warning"><?php echo $detailExam['t_name']; ?></span>.</h4>
        <br>
        <h4 class="text-primary">Thời gian: <span class="text-warning"><?php echo $detailExam['time_make']; ?></span> phút.</h4>
    </div>
    <div class="countdown_exam">
        <h1 class="coundown_exam text-primary"></h1>
    </div>
</div>


</div>

<form action="" method="post">


<?php

foreach ($allQuestionExam as $key => $value):

    $count += 1;

?>

<h5>Câu: <?php echo $count; ?></h5>

<div class="box_question">
<?php echo html_entity_decode($value['message']); ?>
</div>

<br>

<div class="box_answer">

    <input type="hidden" name="id[]" value="<?php echo $value['id']; ?>">

<div class="item_answer row mx-0">
    <input type="radio" checked name="answer[<?php echo $count-1; ?>]" class="col-1 form-control" value="1">
    <p class="col-11 d-flex"><span class="flex_center"><?php echo $value['answer_1']; ?></span></p>
</div>

<div class="item_answer row mx-0">
    <input type="radio" name="answer[<?php echo $count-1; ?>]" class="col-1 form-control" value="2">
    <p class="col-11 d-flex"><span class="flex_center"><?php echo $value['answer_2']; ?></span></p>
</div>

<div class="item_answer row mx-0">
    <input type="radio" name="answer[<?php echo $count-1; ?>]" class="col-1 form-control" value="3">
    <p class="col-11 d-flex"><span class="flex_center"><?php echo $value['answer_3']; ?></span></p>
</div>

<div class="item_answer row mx-0">
    <input type="radio" name="answer[<?php echo $count-1; ?>]" class="col-1 form-control" value="4">
    <p class="col-11 d-flex"><span class="flex_center"><?php echo $value['answer_4']; ?></span></p>
</div>

</div>

<hr>

<?php endforeach; ?>

<input type="submit" value="Nộp bài" class="btn_complete_exam btn btn-primary w-100 py-3">


</form>



