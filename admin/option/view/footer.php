<?php

$group_id = _MY_DATA['id_group'];

if(!checkPermission($group_id, 'option', 'footer')){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}


$optFH = getRow("SELECT * FROM options WHERE opt_key='web_footer_header'");
$optFF = getRow("SELECT * FROM options WHERE opt_key='web_footer_footer'");

$arrFH = json_decode($optFH['opt_value'], true);
$strFF = $optFF['opt_value'];


if(is_Post()){

    $data = getRequest();

    $dataHeader = $data['footerH'];

    if(count($dataHeader) > 4){
        setFlashData('msg', 'Số cột footer không được quá 4');
        setFlashData('type', 'danger');
        redirect('?module=option&action=footer');
    }

    $dataFooter = $data['footerF'];

    $strHeader = json_encode($dataHeader);

    $statusH = update('options', ['opt_value' => $strHeader], "opt_key='web_footer_header'");

    $statusF = update('options', ['opt_value' => $dataFooter], "opt_key='web_footer_footer'");

    if($statusH && $statusF){
        setFlashData('msg', 'Lưu thành công');
        setFlashData('type', 'success');
    }else{
        setFlashData('msg', 'Lưu thất bại');
        setFlashData('type', 'danger');
    }

    redirect('?module=option&action=footer');

}

$msg = getFlashData('msg');
$type = getFlashData('type');

?>



<div class="container_my">

<?php getAlert($msg, $type); ?>

    <form action="" method="post">

        <div class="box_footer mb-3">

        <?php
            if(!empty($arrFH)):
                foreach ($arrFH as $key => $value):
        ?>
        <div class="item_footer row m-0">
            <div class="form-group col-11">
                <textarea name="footerH[]" id="" cols="30" rows="5" class="ckediter"><?php echo html_entity_decode($value); ?></textarea>
            </div>
            <div class="col-1">
                <span class="btn btn-danger w-100 remove_footer"><i class="fa fa-times"></i></span>
            </div>
        </div>
        <?php endforeach; endif; ?>



        </div>

        <span class="btn btn-success add_footer">Thêm <i class="fa fa-plus mx-1"></i></span>

        <hr>

        <div class="form-group">
            <label for="">Footer footer</label>
            <textarea name="footerF" id="" cols="30" rows="3" class="form-control"><?php echo $strFF; ?></textarea>
        </div>

        <input type="submit" value="Lưu" class="form-control btn-primary">

    </form>


</div>