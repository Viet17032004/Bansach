
<?php
$body = getRequest('get');

$count = 0;
$filter = '';
$urlFilter = '';

if(!empty($body['keywork'])){
    $keywork = $body['keywork'];
    $filter .= " AND `title` LIKE '%$keywork%' ";
}

if(!empty($body['book_type'])){
    $book_type = $body['book_type'];

    $filter .= " AND `book_type_id` = '$book_type' ";

}

require _WEB_PATH_ROOT.'/client/book/model/lists.php';

?>


<div class="filter_course">

<form action="" method="get" class="mx-0 row py-3">

<input type="hidden" name="module" value="<?php echo $module; ?>">

<div class="form-group my-0 col-7">
    <input type="text" name="keywork" value="<?php echo !empty($keywork)?$keywork:''; ?>" class="form-control">
</div>

<div class="form-group my-0 col-3">
    <select name="book_type" class="form-control">
        <option value="">Chọn</option>
        <?php
            if(!empty($allBookType)):
                foreach ($allBookType as $key => $value):
        ?>
        <option <?php echo !empty($book_type) && $book_type == $value['id']?'selected':''; ?> value="<?php echo $value['id']; ?>"><?php echo $value['name'].' - '.$value['id']; ?></option>
        <?php endforeach; endif; ?>
    </select>
</div>

<div class="form-group my-0 col-2">
    <input type="submit" value="Tìm" class="form-control btn btn-primary">
</div>

</form>

</div>

<br>
<?php 
if (!empty($allBook)):
?>

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

<?php endforeach;
?>

</div>
<?php
    else:
?>
    <h2 class="text-center text-danger" style="margin: 70px 0;">Không có dữ liệu</h2>
<?php
endif;
?>