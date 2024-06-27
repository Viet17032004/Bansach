<?php

$group_id = _MY_DATA['id_group'];

if(!checkPermission($group_id, 'option', 'slide')){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}


$arrSlide = json_decode(getRow("SELECT * FROM options WHERE opt_key='web_slide'")['opt_value'], true);


if(is_Post()){

    if(!empty($_FILES['slide'])){

        $data = $_FILES['slide'];

        $arrSlide = [];

        $arrType = [];

        $arrName = $data['name'];

        $errors = [];

        foreach ($arrName as $key => $value) {
        $arrSlide[$key]['name'] = $value;
        $arrSlide[$key]['full_path'] = $data['full_path'][$key];
        $arrSlide[$key]['type'] = $data['type'][$key];
        $arrSlide[$key]['tmp_name'] = $data['tmp_name'][$key];
        $arrSlide[$key]['error'] = $data['error'][$key];
        $arrSlide[$key]['size'] = $data['size'][$key];
        }

        foreach ($arrSlide as $key => $value) {
            if(!strrpos($value['type'], 'mage')){
                $errors['slide'] = 'Tất cả các file phải là ảnh';
            }
        }

        if(empty($errors)){

            $arrImage = [];
            foreach ($arrSlide as $key => $value) {
                $image = $value;
                $nameImage = time().'_'.$image['name'];
                $arrImage[] = $nameImage;
                $toFile =  _WEB_PATH_IMAGE_CLIENT.'/'.$nameImage;          
                move_uploaded_file($image['tmp_name'], $toFile);
                $dataUpdate['image'] = $nameImage;
            }
            $strImage = json_encode($arrImage);
            if(update('options', ['opt_value' => $strImage], "opt_key='web_slide'")){
                setFlashData('msg', 'Cập nhập silde thành công');
                setFlashData('type', 'success');
                redirect('?module=option&action=slide');
            }else{
                setFlashData('msg', 'Lỗi hệ thống');
                setFlashData('type', 'danger');
                redirect('?module=option&action=slide');
            }

        }else{
            setFlashData('msg', 'Tất cả các file phải là ảnh');
            setFlashData('type', 'danger');
            redirect('?module=option&action=slide');
        }

    }else{
        setFlashData('msg', 'Vui lòng chọn thông tin');
        setFlashData('type', 'danger');
        redirect('?module=option&action=slide');
    }

}

$msg = getFlashData('msg');
$type = getFlashData('type');

?>


<div class="container_my">

<?php getAlert($msg, $type); ?>

<div id="carouselExampleControls" class="carousel slide my-3" data-ride="carousel">
  <div class="carousel-inner">

    <?php 
        if(!empty($arrSlide)):
            foreach ($arrSlide as $key => $value):
    ?>
    <div style="height: 500px;" class="carousel-item <?php echo $key==0?'active':''; ?>">
      <img src="<?php echo _WEB_HOST_IMAGE_CLIENT.'/'.$value; ?>" class="d-block w-100 h-100" alt="...">
    </div>
    <?php endforeach; else: ?>
        <h3 class="text-center">Chưa có slide nào</h3>
    <?php endif; ?>

  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<form action="" method="post"  enctype="multipart/form-data">

<div class="box_slide">



</div>



<div class="form-group">
    <span class="btn btn-success add_slide">Thêm <i class="fa fa-plus mx-1"></i></span>
</div>

<div class="form-group">
    <input type="submit" value="Lưu Slide" class="btn btn-primary form-control">
</div>

</form>


</div>