
<?php

$allBook = getRaw("SELECT b.*, t.name AS 't_name' FROM book AS b INNER JOIN book_type AS t ON b.book_type_id=t.id WHERE b.id<>'$book_id' AND b.status<>'0' AND book_type_id='$book_type' LIMIT 4");

if(!empty($allBook)):
?>

<hr>
<h2 class="text-warning">Các sản phẩm cùng loại</h2>
<br>
<div class="course_home">
<?php 
    foreach ($allBook as $key => $value):
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

<?php endforeach;?>
</div>
<?php endif; ?>
