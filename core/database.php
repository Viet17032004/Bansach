<?php

function execute($sql, $data=[], $get=false){

try {

    global $conn;

    $query = false;

    $statument = $conn->prepare($sql);

    if(!empty($data)){
        $query = $statument->execute($data);
    }else{
        $query = $statument->execute();
    }

    if(!empty($get) && !empty($query)){
        return $statument;
    }

    return $query;


} catch (Exception $exception) {
    require _WEB_PATH_ROOT.'/modules/erorrs/database.php';
    die();
}

}

// những hàm tương tác với cơ sở dữ liệu


# getRaw là dùng để lấy tất cả dữ liệu trong một bảng
function getRaw($sql){

    $statument = execute($sql, [], true);
    if(is_object($statument)) return $statument->fetchAll(PDO::FETCH_ASSOC);
    return false;

}


# getRow là dùng để lấy một trường dữ liệu trong một bảng
function getRow($sql){

    $statument = execute($sql, [], true);
    if(is_object($statument)) return $statument->fetch(PDO::FETCH_ASSOC);
    return false;

}


# insert thêm dữ liệu cho một bảng
function insert($table, $data){

    $keyStr = "";
    $keyIns = "";

    foreach ($data as $key => $value) {
        $keyStr .= $key.', ';
        $keyIns .= ':'.$key.', ';
    }

    $keyStr = trim($keyStr, ', ');
    $keyIns = trim($keyIns, ', ');

    $sql = "INSERT INTO `$table`($keyStr) VALUES ($keyIns)";

    return execute($sql, $data);

}

# sửa một hoặc tất cả chương trong một bảng
function update($table, $data, $condition=''){

    $keyUdt = "";

    foreach ($data as $key => $value) {
        $keyUdt .= $key.'=:'.$key.', ';
    }

    $keyUdt = trim($keyUdt, ', ');

    if(!empty($condition)){
        $sql = "UPDATE `$table` SET $keyUdt WHERE $condition";
    }else{
        $sql = "UPDATE `$table` SET $keyUdt";
    }

    return execute($sql, $data);

}

# xóa một hoặc tất cả chương trong một bảng
function delete($table, $condition=''){
    if(!empty($condition)){
        $sql = "DELETE FROM `$table` WHERE $condition";
    }else{
        $sql = "DELETE FROM `$table`";	
    }
    return execute($sql);
}

# đến số lượng chương trong bảng
function getCountRows($sql){
    $statument = execute($sql, [], true);
    if(is_object($statument)) return $statument->rowCount();
    return false;
}

?>