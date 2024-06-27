<?php
require _WEB_PATH_ROOT . '/client/home/model/course.php';

?>


<hr>
<br>
<h3 class="text-primary">
    SÁCH TẠI SMARTFL
</h3>

<br>

<div class="course_home">
    <?php
    foreach ($allBook as $key => $value) :
        $book_id = $value['id'];
        $allStar = getRaw("SELECT * FROM star_rating WHERE book_id='$book_id'");
        $numberStar = 0;
        $star = 0;
        $sumStar = 0;
        $quantityStar = 0;
        $evaluate = 0;
        $evaluateStar = 0;
        if(!empty($allStar)){
            foreach ($allStar as $k => $v) {
                $sumStar += $v['rating'];
                $quantityStar += 1;
            }
            $evaluate = $sumStar/$quantityStar;
            $evaluate = number_format($evaluate, 1, '.', '');
            $evaluateStar = round($evaluate);
        } 
    ?>
<div class="item_course border">

<a href="<?php echo "?module=book&action=detail_book&id=".$value['id'];?>"><img class="image_book mx-auto d-block mb-2" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/'.$value['image']; ?>" alt=""></a>
<hr>
<h6><a href="<?php echo "?module=book&action=detail_book&id=".$value['id'];?>" class="text-decoration-none"><?php echo $value['title'];?></a></h6>
<p class="text-primary">Loại: <span class="text-warning"><?php echo $value['t_name']; ?></span></p>

<div class="mt-3 row mx-0">
    <p class="col-6 px-0">
    <span for="star5" class="<?php echo $evaluateStar>=1?'text-warning':''; ?>" title="">&#9733;</span>
    <span for="star5" class="<?php echo $evaluateStar>=2?'text-warning':''; ?>" title="">&#9733;</span>
    <span for="star5" class="<?php echo $evaluateStar>=3?'text-warning':''; ?>" title="">&#9733;</span>
    <span for="star5" class="<?php echo $evaluateStar>=4?'text-warning':''; ?>" title="">&#9733;</span>
    <span for="star5" class="<?php echo $evaluateStar==5?'text-warning':''; ?>" title="">&#9733;</span>
    </p>
    <h6 style="text-align: end;" class="text-primary col-6 p-0">Giá: <span class="text-warning"><?php echo $value['price'];?></span> VND</h6>
</div>

</div>

    <?php endforeach;
    ?>

</div>
<hr>
<br>

<h3 class="text-primary">
    KHÓA HỌC TẠI SMARTFL
</h3>

<br>

<div class="course_home">
    <?php
    foreach ($allCourse as $key => $value) :
    ?>
<div class="item_course border">

<a class="mx-auto d-block text-center" href="?module=course&action=detail_course&course_id=<?php echo $value['id']; ?>"><img class="image_course mb-2" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/'.$value['image']; ?>" alt=""></a>
<hr>
<h5 class="mb-2"><a href="?module=course&action=detail_course&course_id=<?php echo $value['id']; ?>" class="text-decoration-none"><?php echo $value['title']; ?></a></h5>
<div class="sub_item_course">
    <small></small>
    <!-- <small style="text-align: end;" class=""><?php echo $value['price']; ?> VND</small> -->
    <small style="text-align: end;" class=""></small>
    <p class="text-primary">Loại: <span class="text-warning"><?php echo $value['t_name']; ?></span></p>
    <h6 style="text-align: end;" class="text-primary">Giá: <span class="text-warning"><?php echo $value['price']; ?></span> VND</h6>
</div>

</div>
    <?php endforeach; ?>
</div>

<hr>
<br>




<h3 class="text-primary">
    BÀI KIỂM TRA TẠI SMARTFL
</h3>

<br>

<div class="course_home">

    <?php
    foreach ($allExam as $key => $value) :
    ?>

<div class="item_course border">

<a href="?module=exam&action=detail_exam&id=<?php echo $value['id']; ?>"><img class="image_course mx-auto d-block mb-2" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/'.$value['image']; ?>" alt=""></a>

<h6><a href="?module=exam&action=detail_exam&id=<?php echo $value['id']; ?>" class="text-decoration-none"><?php echo $value['title']; ?></a></h6>
<p class="text-primary">Loại: <span class="text-warning"><?php echo $value['t_name']; ?></span></p>

<div class="sub_item_course mt-3">
    <p></p>
    <h6 style="text-align: right;" class="text-primary">Giá: <span class="text-warning"><?php echo $value['price']; ?></span> VND</h6>
</div>

</div>
    <?php
    endforeach;
    ?>

</div>