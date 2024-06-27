<br>
<?php 
   $body = getRequest('get');

   if(!empty($body['id'])){
   
       $id = $body['id'];
       
       if(isLogin()){
            $user_id = _MY_DATA['id'];
        }else{
            $user_id = 0;
        }
   
       $detailBook = getRow("SELECT b.*, t.name AS 't_name' FROM book AS b INNER JOIN book_type AS t ON b.book_type_id=t.id WHERE b.id='$id' AND b.status<>'0'");
   
       if(!empty($detailBook)){
        
        if(is_Post() && !empty($_POST['buy_now'])){

            if($detailBook['quantity'] <= 0){
                setFlashData('msg', 'Hết hàng');
                setFlashData('type', 'danger');
                redirect("?module=book&action=detail_book&id=$id");
            }

            $data = getRequest();
            $errors = [];
            if(empty($data['quantity'])){
                $errors['quantity'] = "Vui lòng điền số lượng";
            }else{
                if($detailBook['quantity'] < $data['quantity']){
                    setFlashData('msg', 'Lượng hàng không đủ');
                    setFlashData('type', 'danger');
                    redirect("?module=book&action=detail_book&id=$id");
                }
            }

            if(empty($errors)){
                $dataBook = [
                    'book_id' => $id,
                    'quantity' => $data['quantity']
                ];
                setSession('data_book', $dataBook);
                redirect('?module=book&action=buy_book');
            }else{
                setFlashData('msg', 'Vui lòng điền số lượng');
                setFlashData('type', 'danger');
                redirect("?module=book&action=detail_book&id=$id");
            }
        }

       }else{
           setFlashData('msg', 'url này không tồn tại');
           setFlashData('type', 'danger');
           redirect("?module=book");
       }
   
   }else{
       setFlashData('msg', 'url này lỗi');
       setFlashData('type', 'danger');
       redirect("?module=book");
   }

$msg = getFlashData('msg');
$type = getFlashData('type');
   
?>

<?php getAlert($msg, $type); ?>

<div class="box_detail_book">

<img class="image_course" src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/'.$detailBook['image']; ?>" alt="">

<div class="detail_book">

<h4> <?php echo $detailBook['title'];?></h4>
<hr>

<p>
    Chia sẻ: <a href="" class="btn btn-primary"><i class="fab fa-facebook-f mr-2"></i> Facebook</a> <a href="" class="btn btn-dark"><i class="fab fa-twitter mr-2"></i>Twitter</a>
</p>
<hr>
<p>Số lượng: <?php echo $detailBook['quantity']; ?></p>
<hr>
<p> 
  <h6>Mô tả ngắn: </h6>  <?php echo html_entity_decode($detailBook['description']);?>
</p>
</div>


<div class="price_book">

<div class="card w-100" style="width: 18rem;">
  <ul class="list-group list-group-flush">
    <li class="list-group-item">
        <h6 class="text-center">THÔNG TIN THANH TOÁN</h6>
    </li>
    <li class="list-group-item px-3">
        <p>Giá bán: <?php echo $detailBook['price'];?> VND</p>
        <p>Loại sách: <?php echo $detailBook['t_name'];?></p>
    </li>
    <!-- <li class="list-group-item px-3 text-center">
        <form action="" method="post" class=" d-inline-block w-75 mx-auto">
            <span class="btn btn-primary my-auto"><i class="fa fa-minus"></i></span>
            <input type="number" class="w-50 form-control my-auto d-inline-block">
            <span class="btn btn-primary my-auto"><i class="fa fa-plus"></i></span>
             </form>
    </li> -->
    <li class="list-group-item px-3 text-center">
        <form action="" method="post">
            <div class="form-group mb-2 text-center">
                <span class="btn btn-primary my-auto minus_book"><i class="fa fa-minus"></i></span>
                <input type="number" name="quantity" class="w-50 quantity_book form-control m-0 d-inline-block">
                <span class="btn btn-primary my-auto add_book"><i class="fa fa-plus"></i></span>
            </div>
            <div class="form-group">
                <input type="submit" name="buy_now" class="btn btn-danger w-100" value="Mua ngay">
            </div>
        </form>
    </li>
    <li class="list-group-item px-3 text-center">
        <?php if(!empty($detailBook['quantity'])): ?>
        <a href="?module=book&action=add_cart&id=<?php echo $id; ?>" class="btn btn-success w-100">Thêm vào giỏ hàng</a>
        <?php else: ?>
        <a href="" onclick="return confirm(`Hết hàng`);" class="btn btn-success w-100">Thêm vào giỏ hàng</a>
        <?php endif; ?>
    </li>
  </ul>
</div>


</div>

</div>

<hr>

<div>

<?php if(!empty($detailBook['content'])): ?>
<h3 class="text-primary">Thông tin về sách</h3>
<br>
<p><?php echo html_entity_decode($detailBook['content']);?> </p>
<?php endif; ?>


</div>

<?php
        $data = [
            'book_id' => $id,
            'user_id' => $user_id
        ];
        view('star', 'client', 'book', $data);
?>

<?php 

        $data = [
            'book_id' => $id,
            'user_id' => $user_id
        ];
        view('comment', 'client', 'book', $data);
?>

<?php 

$data = [
    'book_type' => $detailBook['book_type_id'],
    'book_id' => $detailBook['id']
];

view('book_like', 'client', 'book', $data);
?>