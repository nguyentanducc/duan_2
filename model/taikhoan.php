<?php
function loadall_taikhoan(){
    $sql= "select * from users order by user_id desc";
    $listtk=pdo_query($sql);
    return  $listtk;
}
function delete_taikhoan($id){
    $sql = "delete from users where user_id=".$id;
    pdo_execute($sql);
}
function loadone_taikhoan($id){
    $sql="select * from users where user_id=".$id;
    $taikhoan=pdo_query_one($sql); 
return $taikhoan;
}
function checkuser($user,$pass){
    $sql = "select * from tb_user where username='".$user."'  AND password= '".$pass."' ";
    $result = pdo_query_one($sql);
    return $result;
}
?>