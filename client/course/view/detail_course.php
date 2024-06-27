
<?php

if(isLogin()){
    $user_id = _MY_DATA['id'];
}else{
    $user_id = 0;
}
$body = getRequest('get');

$chapter_id = 0;

if(!empty($body['course_id'])){
    $course_id = $body['course_id'];
    $detailCourse = getRow("SELECT c.*, t.name AS 't_name' FROM course AS c INNER JOIN course_type AS t ON c.course_type_id=t.id WHERE c.status<>'0' AND c.id='$course_id'");
    if(!empty($detailCourse)){
        $course_type = $detailCourse['t_name'];
        $course_type_id = $detailCourse['course_type_id'];
        $myCourse = getRow("SELECT * FROM my_course WHERE user_id='$user_id' AND course_id='$course_id'");
        if(!empty($body['chapter_id'])){
            $chapter_id = $body['chapter_id'];
        }
        if(!empty($body['exercise_id'])){
            $exercise_id = $body['exercise_id'];
        }

        // if(!empty($exercise_id) || !empty($chapter_id)){
        //     setFlashData('msg', 'Vui lòng mua khóa học này');
        //     setFlashData('type', 'danger');
        // }

        $allChapter = getRaw("SELECT * FROM chapter_course WHERE course_id='$course_id'");
        $numberChapter = getCountRows("SELECT id FROM chapter_course WHERE course_id='$course_id'");
    }else{
        setFlashData('msg', 'url này không tồn tại');
        setFlashData('type', 'danger');
        redirect("?module=course");
    }
}else{
    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
    redirect("?module=course");
}

$msg = getFlashData('msg');
$type = getFlashData('type');

?>

<div class="detail_course">

<div class="detail_course_content_left">

<?php getAlert($msg, $type); ?>

<?php if(empty($exercise_id)): ?>
    <img class="w-100" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/'.$detailCourse['image']; ?>" alt="">
<?php else: ?>
    <?php
        $detailExercise = getRow("SELECT * FROM exercise_course WHERE id='$exercise_id'");
        if(!empty($detailExercise) && !empty($myCourse['status'])){
            echo '<div class="mx-auto text-center">'.html_entity_decode($detailExercise['video'])."</div>";
        }else{
            setFlashData('msg', 'url này lỗi');
            setFlashData('type', 'danger');
            redirect("?module=course&action=detail_course&course_id=$course_id");
        }
    ?>
<?php endif; ?>


    <div class="p-3 my-3 bg-white border bra-10" style="text-align: left;">
        <p>Những gì học được từ khóa học</p>
        <hr>
        <?php echo html_entity_decode($detailCourse['learned']); ?>
    </div>

    <div class="p-3 my-3 bg-white border bra-10" style="text-align: left;">
        <p>Giới thiệu về khóa học</p>
        <hr>
        <?php echo html_entity_decode($detailCourse['about']); ?>
    </div>

    <div class="p-3 my-3 bg-white border bra-10">
        Nội dung khóa học
        <hr>
        <?php
            if(!empty($allChapter)):
                foreach ($allChapter as $chapter):
        ?>
        <div class="ex_course">
            <p class="p-3 bg-primary ex_chapter btn m-0  w-100 text-light bra-0" style="border: 2px solid #57a3f5;"><?php echo $chapter['name']; ?></p>
            <?php
                $id_chapter = $chapter['id'];
                $allExercise = getRaw("SELECT * FROM exercise_course WHERE chapter_id='$id_chapter'")
            ?>
            <ul class="m-0 ex_exercise <?php echo $chapter_id==$chapter['id']?'d-block':''; ?>">
                <?php foreach ($allExercise as $key => $exercise): $id_exercise = $exercise['id']; ?>
                <a href="<?php echo !empty($myCourse['status'])?"?module=course&action=detail_course&course_id=$course_id&chapter_id=$id_chapter&exercise_id=$id_exercise":''; ?>" class="p-3 d-block text-decoration-none" style="border: 3px solid #ffc107;"><?php echo $exercise['title']; ?></a>
                <?php endforeach; ?>
            </ul>
        </div>

        <?php endforeach; endif;?>

    </div>

</div>

<div class="detail_course_content_right">

    <div class="bg-white border p-3 bra-10">
        <h3 class="text-primary"><?php echo $detailCourse['title']; ?></h3>
        <br>
        <p class="text-primary">Loại: <span class="text-warning"><?php echo $course_type; ?></span></p>
        <p class="text-primary">Giá bìa: <i class=""><span class="text-warning"><?php echo $detailCourse['price']; ?></span> VND</i></p>
        <p class="text-primary">Giá bán: <span class="text-warning"></span><i class="font-weight-bold text-danger"><?php echo !empty($detailCourse['discount'])?$detailCourse['discount']:$detailCourse['price']; ?> VND</i></p>
        <br>
        <?php if(empty($myCourse)): ?>
        <a href="?module=cart&action=buy_course&id=<?php echo $course_id; ?>" class="btn btn-primary d-block">Mua khóa học</a>
        <?php else: ?>
        <a href="" class="btn btn-success d-block">Khóa học này đã được mua</a>
        <?php endif; ?>
        <br>
        <p class="text-primary">Chương: <span class="text-warning"><?php echo $numberChapter; ?></span> chương</p>
    </div>

        <br>

    <div class="bg-white border p-3 bra-10">
        <?php
            if(empty($myCourse['status'])):
        ?>
        <p>MÃ KÍCH HOẠT KHÓA HỌC</p>
        <form action="<?php echo _WEB_HOST_ROOT."/?module=course&action=active_course"; ?>" method="post">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
            <input type="text" class="form-control" name="active">
            <br>
            <button type="submit" class="btn btn-danger d-block">Kích hoại</button>
        </form>
        <?php else: ?>
            <h4 class="text-center text-primary">Khóa học này đã được kính hoạt</h4>
        <?php endif; ?>
    </div>

    <br>

<?php 
$allCourse = getRaw("SELECT c.* FROM course AS c INNER JOIN course_type AS t ON c.course_type_id=t.id WHERE c.id<>'$course_id' AND c.status<>'0' AND course_type_id='$course_type_id'");
if(!empty($allCourse)):
?>   

    <div class="bg-white border p-3 bra-10">
        <h5>Các khóa học cùng loại</h5>
        <hr>
        <?php foreach ($allCourse as $key => $value): ?>
        <div class="course_kind">
            <a href="?module=course&action=detail_course&course_id=<?php echo $value['id']; ?>"><img class="w-100" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/'.$value['image']; ?>" alt=""></a>
            <div class="ml-2">
                <h6 class="mb-0"><a href="?module=course&action=detail_course&course_id=<?php echo $value['id']; ?>" class="text-decoration-none"><?php echo $value['title']; ?></a></h6>
                <br>
                <p class="mb-0 text-primary">Giá: <span class="text-warning"><?php echo $value['price']; ?></span> VND</p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

<?php endif; ?>

</div>



</div>