

<?php

$data = [
    'titlePage' => 'Cảm ơn'
];

layout('header', 'client', $data);

?>


<div class="container_my padding_X">






<?php


if(!isLogin() || empty(getSession('active_exam'))){
    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
    redirect("?module=exam");
}

$body = getRequest('get');



if(!empty($body['exam_id'])):

    $user_id = _MY_DATA['id'];

    $exam_id = $body['exam_id'];

if(!empty($body['vnp_BankTranNo'])){

    $detailExam = getRow("SELECT id FROM exam WHERE id='$exam_id'");

    if(!empty($detailExam)){

            $dataInsert = [
            'exam_id' => $exam_id,
            'user_id' => $user_id,
            'create_at' => date('Y-m-d H:i:s')
            ];

            if(insert('make_exam', $dataInsert)){
                setFlashData('msg', 'Hãy làm bài đúng giờ nhé');
                setFlashData('type', 'success');
                removeSession('active_exam');
                view('text_thank', 'client', 'cart');
            }else{  
                setFlashData('msg', 'Lỗi hệ thống');
                setFlashData('type', 'danger');
            }
    }


}elseif(empty($body['resultCode']) && !empty($body['partnerCode'])){

  

    $detailExam = getRow("SELECT id FROM exam WHERE id='$exam_id'");

    if(!empty($detailExam)){

            $dataInsert = [
            'exam_id' => $exam_id,
            'user_id' => $user_id,
            'create_at' => date('Y-m-d H:i:s')
            ];

            if(insert('make_exam', $dataInsert)){
                setFlashData('msg', 'Hãy làm bài đúng giờ nhé');
                setFlashData('type', 'success');
                removeSession('active_exam');
                view('text_thank', 'client', 'cart');
            }else{  
                setFlashData('msg', 'Lỗi hệ thống');
                setFlashData('type', 'danger');
            }
    }

}elseif(!empty($body['pay_type'])){



    $detailExam = getRow("SELECT id FROM exam WHERE id='$exam_id'");

    if(!empty($detailExam)){

            $dataInsert = [
            'exam_id' => $exam_id,
            'user_id' => $user_id,
            'create_at' => date('Y-m-d H:i:s')
            ];

            if(insert('make_exam', $dataInsert)){
                setFlashData('msg', 'Hãy làm bài đúng giờ nhé');
                setFlashData('type', 'success');
                removeSession('active_exam');
                view('text_thank', 'client', 'cart');
            }else{  
                setFlashData('msg', 'Lỗi hệ thống');
                setFlashData('type', 'danger');
            }
    }


}else{
    setFlashData('msg', 'Thanh toán thất bại');
    setFlashData('type', 'danger');
    redirect('?module=exam');
}

else:

    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
    redirect("?module=course");

endif;

?>
















</div>


<?php layout('footer', 'client'); ?>