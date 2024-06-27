<?php

$allBookHot = getRaw("SELECT b.*, t.name AS 't_name' FROM book AS b INNER JOIN book_type AS t ON b.book_type_id=t.id WHERE `status`<>'0' ORDER BY b.price ASC LIMIT 4");

?>

<hr>

<div class="book_hot">
    <?php foreach ($allBookHot as $key => $value): ?>
    <div class="item_book_hot row mx-0">
        <div class="col-5">
        <a href="<?php echo "?module=book&action=detail_book&id=".$value['id'];?>"><img class="" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/'.$value['image']; ?>" alt=""></a>
        </div>
        <div class="col-7">
            <h6 class="text-danger"><?php echo $value['title']; ?></h6>
            <p class="text-danger">Loại: <span class="text-success"><?php echo $value['t_name'] ?></span></p>
            <p class="text-danger">Giá: <span class="text-success"><?php echo $value['price'] ?></span> VND</p>
        </div>
    </div>
    <?php endforeach; ?>
</div>
