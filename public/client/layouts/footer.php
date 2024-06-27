<?php

$optFH = getRow("SELECT * FROM options WHERE opt_key='web_footer_header'");
$optFF = getRow("SELECT * FROM options WHERE opt_key='web_footer_footer'");

$arrFH = json_decode($optFH['opt_value'], true);
$strFF = $optFF['opt_value'];

$body = getRequest('get');

if(!empty($body['make_exam'])){
    $make_exam = true;
}

?>


<footer class="box_footer <?php echo isset($make_exam)?'d-none':''; ?>">


<div class="footer_end">

    <div class="footer_header d-flex justify-content-around padding_X py-4">
        <?php
            if(!empty($arrFH)):
                foreach ($arrFH as $key => $value):
        ?>
        <div class="item_footer px-4">
            <?php echo html_entity_decode($value); ?>
        </div>
        <?php endforeach; endif; ?>

    </div>

    <p class="m-0 py-4 footer_footer text-center"><?php echo $strFF; ?></p>
</div>

</footer>


</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="<?php echo _WEB_HOST_TEMPLATE.'/client/assets/js/owl.carousel.min.js?ver='.rand(); ?>"></script>

<script>

$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})

</script>

<script>

let time_over_exam = null;
let time_now_exam = null;

<?php

$body = getRequest('get');

if(!empty($body['make_exam'])){
    $make_exam = $body['make_exam'];
        require _WEB_PATH_ROOT.'/client/make_exam/model/make.php';
    if(!empty($detailMakeExam)){
        
    }
}

if(!empty($detailMakeExam)):

?>
let time_start_exam = <?php echo strtotime($detailExam['time_start']); ?>

time_over_exam = <?php echo $detailExam['time_end']; ?>

time_now_exam = <?php echo strtotime(date('Y-m-d H:i:s')); ?>

<?php endif; ?>
</script>

<script src="<?php echo _WEB_HOST_TEMPLATE.'/client/assets/js/bootstrap.min.js?ver='.rand(); ?>"></script>

<script src="<?php echo _WEB_HOST_TEMPLATE.'/client/assets/js/app.js?ver='.rand(); ?>"></script>


</html>