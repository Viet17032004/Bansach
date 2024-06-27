<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($to, $subject, $content)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'ndkdzvl@gmail.com';                     //SMTP username
        $mail->Password   = 'dchuzrbjuruftzrj';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('ndkdzvl@gmail.com', 'SMARTFL');
        $mail->addAddress($to);     //Add a recipient
        //Content
        $mail->isHTML(true);                             //Set email format to HTML
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->Body    = $content;

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        return $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}




function layout($file, $rank, $data=[]){
    $path = _WEB_PATH_TEMPLATE.'/'.$rank.'/layouts/'.$file.'.php';

    extract($data);

    if(file_exists($path)){
        require $path;
    }else{
        require _WEB_PATH_TEMPLATE.'/error/layout.php';
    }
}






function view($view, $rank='client', $module='home', $data=[]){
    $path = _WEB_PATH_ROOT."/$rank/$module/view/$view.php";
    extract($data);

    if(file_exists($path)){
        require $path;
    }else{
        require _WEB_PATH_TEMPLATE.'/error/view.php';
    }
}

function controller($controller, $rank='client', $module='home', $data=[]){
    $path = _WEB_PATH_ROOT."/$rank/$module/controller/$controller.php";
    extract($data);

    if(file_exists($path)){
        require $path;
    }else{
        require _WEB_PATH_TEMPLATE.'/error/controller.php';
    }
}


function model($model, $rank='client', $module='home'){
    $path = _WEB_PATH_ROOT."/$rank/$module/model/$model.php";

    if(file_exists($path)){
        require $path;
    }else{
        require _WEB_PATH_TEMPLATE.'/error/model.php';
    }
}

function getActive($module=null){
    if(!empty($module) && is_array($module) && !empty($_GET['module'])){
        if(in_array($_GET['module'], $module)){
            return true;
        }
    }
    if(!empty($module) && !empty($_GET['module']) && $module==$_GET['module']){
        return true;
    }
    return false;
}

function getAction($action=null){
    if(!empty($action) && is_array($action) && !empty($_GET['action'])){
        if(in_array($_GET['action'], $action)){
            return true;
        }
    }
    if(!empty($action) && !empty($_GET['action']) && $action==$_GET['action']){
        return true;
    }
    return false;
}

function redirect($url='index.php'){
    header('Location: '.$url);
    exit();
}

function getAlert($msg='', $type='success'){
    if($msg){
        echo '<div class="alert alert-'.$type.'">';
        echo $msg;
        echo '</div>';
    }
}



function formError($error){
    if(!empty($error)){
        echo '<span class="text-danger">'.$error.'</span><br>';
    }
}

function emptyEcho($str){
    if(!empty($str)) return $str;  
}


function is_Get(){

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        return true;

    }
    return false;
}



function is_Post(){

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        return true;

    }
    return false;
}

function getRequest($method = '')
{
    $bodyArr = [];

    if (empty($method)) {
        if (is_Get()) {
            if (!empty($_GET)) {
                foreach ($_GET as $key => $value) {
                    $key = strip_tags($key);
                    if (is_array($value)) {
                        $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }

        if (is_Post()) {
            if (!empty($_POST)) {
                foreach ($_POST as $key => $value) {
                    $key = strip_tags($key);
                    if (is_array($value)) {
                        $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }
    } else {
        if ($method == 'get') {
            if (!empty($_GET)) {
                foreach ($_GET as $key => $value) {
                    $key = strip_tags($key);
                    if (is_array($value)) {
                        $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        } elseif ($method == 'post') {
            if (!empty($_POST)) {
                foreach ($_POST as $key => $value) {
                    $key = strip_tags($key);
                    if (is_array($value)) {
                        $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }
    }
    return $bodyArr;
}

function getTypeTime($time='', $future=''){

    $result = 0;

    $time = strtotime($time);
    if(!empty($future)){
        $date = strtotime($future);
    }else{  
        $date = strtotime(date("Y-m-d H:i:s"));
    }

    $now = $date - $time;   

    if($now < 0){
        return false;
    }    

    if($now > 31536000){
        $result = floor($now/31536000);
        if($result == 0){
            $result = 1;
        }
        $result = 'year';
    }elseif ($now > 2592000) {
        $result = floor($now/2592000);
        if($result == 0){
            $result = 1;
        }
        $result = 'month';
    }elseif ($now > 86400) {
        $result = floor($now/86400);
        if($result == 0){
            $result = 1;
        }
        $result = 'day';
    }elseif($now > 3600){
        $result = floor($now/3600);
        if($result == 0){
            $result = 1;
        }
        $result = 'hour';
    }else{
        $result = floor($now/60);
        if($result == 0){
            $result = 1;
        }
        $result = 'minute';
    }
    
    return $result;

}

function isLogin(){

    $check = false;

    if(!empty(getSession('loginToken'))){

        $token = getSession('loginToken');
    
        $checkToken = getRow("SELECT * FROM login_token WHERE token='$token'");
    
        if($checkToken){
            $check = $checkToken;
        }else{
            removeSession('loginToken');
        }
    
    }

    return $check;

}

function getTimeFormat($strTime, $format){

    $dataObject = date_create($strTime);

    if(!empty($dataObject)){
        return date_format($dataObject, $format);
    }

    return false;

}




function getCommentChild($user_id, $page, $place, $parent_id){

    if($page == 'course'){
        $allComment = getRaw("SELECT c.*, u.fullname AS 'u_name', u.id_group AS 'id_group', u.image AS 'u_image', g.name AS 'g_name' FROM comment AS c INNER JOIN user AS u ON c.user_id=u.id INNER JOIN groups AS g ON u.id_group=g.id WHERE c.course_id='$place' AND c.parent_id='$parent_id' ORDER BY c.create_at DESC");
    }

    if($page == 'book'){
        $allComment = getRaw("SELECT c.*, u.fullname AS 'u_name', u.id_group AS 'id_group', u.image AS 'u_image', g.name AS 'g_name' FROM comment AS c INNER JOIN user AS u ON c.user_id=u.id INNER JOIN groups AS g ON u.id_group=g.id WHERE c.book_id='$place' AND c.parent_id='$parent_id' ORDER BY c.create_at DESC");
    }

?>

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
        <?php if($value['user_id'] == $user_id): ?>
            <a href="?module=<?php echo $page; ?>&action=remove_comment&id=<?php echo $value['id']; ?>" class="text-decoration-none text-dark"><i class="fa fa-times-circle mx-2 text-danger"></i>remove</a></p>
            <?php endif; ?>
        </p>
        <p class="mt-2">
            <?php echo $value['comment']; ?>
        </p>
    </div>    
</div>
<br>
<?php endforeach; endif; ?>

<?php

}

function removeComment($id){
    
    $detailComment = getRow("SELECT id FROM comment WHERE id='$id'");

    if(!empty($detailComment)){
        if(delete('comment', "parent_id='$id'")){
            if(delete('comment', "id='$id'")){
                setFlashData('msgcm', 'Xóa bình luận thành công');
                setFlashData('typecm', 'success');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }else{
            setFlashData('msg', 'lỗi hệ thống');
            setFlashData('type', 'danger');
            redirect(_WEB_HOST_ROOT);
        }
    }else{
        setFlashData('msg', 'url này không tồn tại');
        setFlashData('type', 'danger');
        redirect(_WEB_HOST_ROOT);
    }

}

function checkPermission($id_group, $module, $action){
    $permission = false;
    $group = getRow("SELECT permission FROM groups WHERE id='$id_group'");
    $arrPermission = json_decode($group['permission'], true);
    foreach ($arrPermission as $key => $value) {
        if($module == $key){
            foreach ($value as $k => $v) {
                if($k == $action) $permission = true;
            }
        }
    }
    return $permission;
}

?>

