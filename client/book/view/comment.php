
<?php

$body = getRequest('get');

if(is_Post() && !empty($_POST['submit_comment'])){

    if(!isLogin()){
        setFlashData('msgcm', 'Vui lòng đăng nhập để bình luận');
        setFlashData('typecm', 'danger');
        redirect("?module=book&action=detail_book&id=$book_id");
    }

    $data = getRequest();

    $errors = [];

    if(empty($data['comment'])){
        $errors['comment'] = 'Vui lòng điền ý kiến của bạn';
    }else{
        if(strlen(trim($data['comment'])) < 3){
            $errors['comment'] = 'Nội dung không được dưới 3 ký tự';
        }
    }

    if(!empty($body['comment_id'])){
        $parent_id = $body['comment_id'];
    }else{
        $parent_id = 0;
    }

    if(empty($errors)){

        $dataInsert = [
            'user_id' => $user_id,
            'book_id' => $book_id,
            'parent_id' => $parent_id,
            'comment' => $data['comment'],
            'create_at' => date("Y-m-d H:i:s")
        ];

        if(insert('comment', $dataInsert)){
            setFlashData('msgcm', 'Bình luận thành công');
            setFlashData('typecm', 'success');
            redirect("?module=book&action=detail_book&id=$book_id");
        }else{
            setFlashData('msgcm', 'Lỗi hệ thống');
            setFlashData('typecm', 'danger');
        }

    }else{
        setFlashData('msgcm', 'Vui lòng kiểm tra form !!!');
        setFlashData('typecm', 'danger');
        setFlashData('old', $data);
        setFlashData('errers', $errors);
    }
    if(empty($body['comment_id'])){
        redirect("?module=book&action=detail_book&id=$book_id#comment"); 
    }else{
        redirect("?module=book&action=detail_book&id=$book_id&comment_id=$parent_id#comment"); 
    }
}

$msg = getFlashData('msgcm');
$type = getFlashData('typecm');
$errors = getFlashData('errers');
$old = getFlashData('old');

$allComment = getRaw("SELECT c.*, u.fullname AS 'u_name', u.id_group AS 'id_group', u.image AS 'u_image', g.name AS 'g_name' FROM comment AS c INNER JOIN user AS u ON c.user_id=u.id INNER JOIN groups AS g ON u.id_group=g.id WHERE c.book_id='$book_id' AND c.parent_id='0' ORDER BY c.create_at DESC");
$countComment = getCountRows("SELECT id FROM comment WHERE book_id='$book_id'");

?>

<div class="p-3 my-3 bg-white border bra-10">
<h4 id="comment">Ý kiến về sách: <?php echo !empty($countComment)?$countComment:'0'; ?></h4>
<hr>

<div class="box_comment">
<?php
    if(!empty($allComment)):
        foreach ($allComment as $key => $value):
?>
<div class="item_comment">
    <div>
        <img class="rounded-circle" width="100%" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/'.$value['u_image']; ?>" alt="">
    </div>
    <div class="px-3">
        <h6><?php echo $value['u_name']; ?> <span class="right badge badge-warning"><?php echo $value['g_name']; ?></span></h6>
        <p class="border-bottom">
            <i class="fa fa-calendar-alt mr-2 text-primary"></i> <?php echo getTimeFormat($value['create_at'], "Y-m-d"); ?>
            <i class="fa fa-clock mx-2 text-primary"></i> <?php echo getTimeFormat($value['create_at'], "H:i"); ?>
            <a href="?module=book&action=detail_book&id=<?php echo $book_id; ?>&comment_id=<?php echo $value['id']; ?>#comment" class="text-decoration-none text-dark"><i class="fa fa-comment mx-2 text-primary"></i>replay</a>
            <?php if($value['user_id'] == $user_id): ?>
            <a href="?module=book&action=remove_comment&id=<?php echo $value['id']; ?>" class="text-decoration-none text-dark"><i class="fa fa-times-circle mx-2 text-danger"></i>remove</a></p>
            <?php endif; ?>
        <p class="mt-2">
            <?php echo $value['comment']; ?>
        </p>
    </div>
    <div></div>
    <div class=""><?php getCommentChild($user_id, 'book', $book_id, $value['id']); ?></div>
</div>
<br>
<?php endforeach; endif; ?>

</div>

</div>

<div class="p-3 my-3 bg-white border bra-10">
<?php if(empty($body['comment_id'])): ?>
<h4>Bình luận:</h4>
<?php 
    else:
    $comment_id = $body['comment_id'];
    $detailComment = getRow("SELECT c.*, u.fullname AS 'u_name' FROM comment AS c INNER JOIN user AS u ON c.user_id=u.id WHERE c.id='$comment_id' AND book_id='$book_id'");
    if(!empty($detailComment)){

    }else{
        setFlashData('msg', 'url này không tồn tại !!!');
        setFlashData('type', 'danger');
        redirect("?module=book&action=detail_book&id=$book_id");
    }
?>
<h4>Trả lời: <?php echo $detailComment['u_name'] ?></h4>
<?php endif; ?>
<hr>
<?php getAlert($msg, $type); ?>
<form action="" method="post" >

<div class="form-group">
    <textarea name="comment" id="" cols="30" rows="3" class="form-control"><?php echo !empty($old['comment'])?$old['comment']:''; ?></textarea>
    <?php !empty($errors['comment'])?formError($errors['comment']):''; ?>
</div>
<input type="submit" value="Bình luận" name="submit_comment" class="btn btn-primary">

</form>
</div>

