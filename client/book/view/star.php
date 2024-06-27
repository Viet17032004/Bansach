<?php

$user_id = 0;

if(isLogin()){
    $user_id = isLogin()['user_id'];
}

$allStar = getRaw("SELECT * FROM star_rating WHERE book_id='$book_id'");

$myStar = getRow("SELECT * FROM star_rating WHERE book_id='$book_id' AND user_id='$user_id'");
if(!empty($myStar)){
    $myEvaluate = $myStar['rating'];
}
$sumStar = 0;
$quantityStar = 0;
$evaluate = 0;
$evaluateStar = 0;
if(!empty($allStar)){
    foreach ($allStar as $key => $value) {
        $sumStar += $value['rating'];
        $quantityStar += 1;
    }
    $evaluate = $sumStar/$quantityStar;
    $evaluate = number_format($evaluate, 1, '.', '');
    $evaluateStar = round($evaluate);
}   

if(is_Post() && !empty($_POST['submit_rating'])){

    if(!isLogin()){
        setFlashData('msg_star', 'Vui lòng đăng nhập để đánh giá');
        setFlashData('type_star', 'danger');
        redirect('?module=book&action=detail_book&id='.$book_id.'#rating');
    }else{
        $allOrder = getRaw("SELECT * FROM order_pro WHERE user_id='$user_id'");
        if(!empty($allOrder)){
            $checkBought = false;
            foreach ($allOrder as $key => $value) {
                $code_cart = $value['code_order'];
                $detailCartOrder = getRow("SELECT * FROM cart_order WHERE code_cart='$code_cart'");
                if(!empty($detailCartOrder)){
                    if($detailCartOrder['book_id'] == $book_id){
                        $checkBought = true;
                        break;
                    }
                }
            }
            if(!$checkBought){
                setFlashData('msg_star', 'Bạn phải mua sản phẩm này mới được đánh giá');
                setFlashData('type_star', 'danger');
                redirect('?module=book&action=detail_book&id='.$book_id.'#rating');
            }
        }else{
            setFlashData('msg_star', 'Bạn phải mua sản phẩm này mới được đánh giá');
            setFlashData('type_star', 'danger');
            redirect('?module=book&action=detail_book&id='.$book_id.'#rating');
        }
    }

    $data = getRequest();

    if(empty($data['rating'])){
        $errors['rating'] = 'Vui lòng chọn đánh giá của bạn';
    }

    if(empty($errors)){
        $rating = $data['rating'];
        if(empty($myEvaluate)){
            $dataInsert = [
                'user_id' => $user_id,
                'book_id' => $book_id,
                'rating' => $rating,
                'update_at' => date('Y-m-d H:i:s')
            ];
            if(insert('star_rating', $dataInsert)){
                setFlashData('msg_star', "Bạn đã đánh giá sản phẩm này $rating");
                setFlashData('type_star', 'success');
            }else{
                setFlashData('msg_star', "Lỗi hệ thống");
                setFlashData('type_star', 'danger');
            }
        }else{
            $dataUpdate = [
                'rating' => $rating,
                'update_at' => date('Y-m-d H:i:s')
            ];
            if(update('star_rating', $dataUpdate, "user_id='$user_id' AND book_id='$book_id'")){
                setFlashData('msg_star', "Bạn đã đánh giá sản phẩm này $rating");
                setFlashData('type_star', 'success');
            }else{
                setFlashData('msg_star', "Lỗi hệ thống");
                setFlashData('type_star', 'danger');
            }
        }
    }else{
        setFlashData('msg_star', 'Vui lòng chọn đánh giá của bạn');
        setFlashData('type_star', 'danger');
    }

    redirect('?module=book&action=detail_book&id='.$book_id.'#rating');
}

echo '<spap id="rating"></spap>';

$msg_star = getFlashData('msg_star');
$type_star = getFlashData('type_star');

getAlert($msg_star, $type_star);

?>

<div class="p-3 my-3 bg-white border bra-10 ">
<div class="mx-0 row">
<div class="col-6 flex_center d-flex ">
<h4>Lượng đánh giá: <?php echo $quantityStar; ?></h4>
</div>
<div class="col-6 text-end">
<h4>Sao:
<div class="rating text-center">
    <label for="star5" class="<?php echo $evaluateStar>=1?'text-warning':''; ?>" title=""><h3>&#9733;</h3></label>
    <label for="star5" class="<?php echo $evaluateStar>=2?'text-warning':''; ?>" title=""><h3>&#9733;</h3></label>
    <label for="star5" class="<?php echo $evaluateStar>=3?'text-warning':''; ?>" title=""><h3>&#9733;</h3></label>
    <label for="star5" class="<?php echo $evaluateStar>=4?'text-warning':''; ?>" title=""><h3>&#9733;</h3></label>
    <label for="star5" class="<?php echo $evaluateStar==5?'text-warning':''; ?>" title=""><h3>&#9733;</h3></label>
    <h4 class="d-inline-block">/ <?php echo $evaluate; ?></h4>
</div>   
</div>    
</div>
</h4>
<hr>
<form action="" method="post" class="row mx-0">
   <div class="rating text-center col-6">
        <input type="radio" name="rating" value="1" class="item_rating"><label for="star5" class="star" style="<?php echo !empty($myEvaluate) && $myEvaluate>=1?'color: #ffc107;':''; ?>" title="1 star"><h1>&#9733;</h1></label>
        <input type="radio" name="rating" value="2" class="item_rating"><label for="star4" class="star" style="<?php echo !empty($myEvaluate) && $myEvaluate>=2?'color: #ffc107;':''; ?>" title="2 stars"><h1>&#9733;</h1></label>
        <input type="radio" name="rating" value="3" class="item_rating"><label for="star2" class="star" style="<?php echo !empty($myEvaluate) && $myEvaluate>=3?'color: #ffc107;':''; ?>" title="3 stars"><h1>&#9733;</h1></label>
        <input type="radio" name="rating" value="4" class="item_rating"><label for="star3" class="star" style="<?php echo !empty($myEvaluate) && $myEvaluate>=4?'color: #ffc107;':''; ?>" title="4 stars"><h1>&#9733;</h1></label>
        <input type="radio" name="rating" value="5" class="item_rating"><label for="star1" class="star" style="<?php echo !empty($myEvaluate) && $myEvaluate>=5?'color: #ffc107;':''; ?>" title="5 stars"><h1>&#9733;</h1></label>
    </div>
    <div class="form-group col-6 d-flex flex_center my-0">
        <input type="submit" value="Đánh giá" name="submit_rating" class="my-0 w-100 btn btn-warning d-block"> 
    </div> 
</form>


</div>