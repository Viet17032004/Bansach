<?php

$group_id = _MY_DATA['id_group'];

if(!checkPermission($group_id, 'question_exam', 'lists')){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}

$body = getRequest('get');

if(!empty($body['page'])){
    $page = $body['page'];
}else{
    $page = 1;
}

$count = 0;
$filter = '';
$urlFilter = '';

// if(!empty($body['keywork'])){
//     $keywork = $body['keywork'];
//     $filter .= " AND ct.name LIKE '%$keywork%' ";
//     $urlFilter .= "&keywork=$keywork";
// }


if(!empty($body['exam_id'])){
    $exam_id = $body['exam_id'];
    require _WEB_PATH_ROOT.'/admin/question_exam/model/board.php';

    if(!empty($detailExam)){
        
    }else{
        setFlashData('msg', 'url này không tồn tại');
        setFlashData('type', 'danger');
        redirect('?module=exam');
    }
}else{
    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
    redirect('?module=exam');
}

if(is_Post()){

    $data = $_POST;

    $arrId = [];

    $strId = '';

    $arrQuestion = [];

    $arrMes = $data['message'];

    if(!empty($data['id']) && is_array($data['id'])){
        $oldId = $data['id'];
        foreach ($oldId as $key => $value) {
            $arrId[] = $value;
        }
    }

    foreach ($arrMes as $key => $value) {
        $arrQuestion[$key] = [
            'message' => $data['message'][$key],
            'answer_1' => $data['answer_1'][$key],
            'answer_2' => $data['answer_2'][$key],  
            'answer_3' => $data['answer_3'][$key],
            'answer_4' => $data['answer_4'][$key],
            'right_answer' => $data['right_answer'][$key],
            'exam_id' => $exam_id,
            'create_at' => date('Y-m-d H:i:s')
        ];
    }

    if(!empty($arrId)){
        foreach ($arrId as $key => $value) {
            update('question_exam', $arrQuestion[$key], "id='$value'");
            unset($arrQuestion[$key]);
        }
    }

    if(!empty($arrId)){
        foreach ($arrId as $key => $value) {
            if(!empty($strId)){
                $strId .= " AND id<>'$value' ";
            }else{
                $strId .= " id<>'$value' ";
            }
            
        }
        delete('question_exam', "$strId AND exam_id='$exam_id'");
    }

    if(!empty($arrQuestion)){
        foreach ($arrQuestion as $key => $value) {
            insert('question_exam', $value);
        }
    }

    redirect("?module=question_exam&exam_id=$exam_id");

}



?>


<div class="container_my">

<form action="" method="post">

<div class="my-3">
    <input type="submit" value="Lưu" class="btn btn-primary w-100">
</div>

<div class="box_question">
<?php

    if(!empty($allQuestionExam)):
        foreach ($allQuestionExam as $key => $value):
?>
        <div class="item_question row mx-0">

        <div class="col-11 row mx-0">
        
        <input type="hidden" name="id[]" value="<?php echo $value['id']; ?>">

        <div class="form-group col-12 ">
            <label for="">Câu hỏi</label>
            <textarea name="message[]" id="" cols="30" rows="10" class="ckediter w-100"><?php echo $value['message']; ?></textarea>
        </div>

        <div class="form-group col-6">
            <label for="">Đáp án 1</label>
            <input type="text" name="answer_1[]" class="form-control" value="<?php echo $value['answer_1']; ?>">
        </div>

        <div class="form-group col-6">
            <label for="">Đáp án 2</label>
            <input type="text" name="answer_2[]" class="form-control" value="<?php echo $value['answer_2']; ?>">
        </div>

        <div class="form-group col-6">
            <label for="">Đáp án 3</label>
            <input type="text" name="answer_3[]" class="form-control" value="<?php echo $value['answer_3']; ?>">
        </div>

        <div class="form-group col-6">
            <label for="">Đáp án 4</label>
            <input type="text" name="answer_4[]" class="form-control" value="<?php echo $value['answer_4']; ?>">
        </div>

        <div class="form-group col-12">
            <label for="">Đán án đúng</label>
            <input type="number" max="4" min="1" value="<?php echo $value['right_answer']; ?>" name="right_answer[]" class="form-control">
        </div>


        </div>


        <div class="col-1">
            <span class="btn btn-danger w-100 remove_question"><i class="fa fa-times"></i></span>
        </div>

        </div>
<?php

    endforeach;
    endif;

?>
</div>

</form>

<br>
<span class="btn btn-primary add_question">Thêm <i class="fa fa-plus mx-1"></i></span>
<hr>
<a href="?module=exam" class="btn btn-success">Danh sách</a>


</div>