<?php
function loadall_phong($keyw="",$type_id=0){
    $sql="SELECT *  FROM rooms  WHERE 1";
    // where 1 tức là nó đúng
    if($keyw!=""){
        $sql.=" and room_name like '%".$keyw."%'";
    }
    if($type_id>0){
        $sql.=" and type_id ='".$type_id."'";
    }
    $sql.=" order by room_id desc";
    $listphong=pdo_query($sql);
    return  $listphong;
}
function loadone_phong($id){
    $sql="select * from rooms  where room_id=".$id ;
    $phong=pdo_query_one($sql); 
return $phong;
}
function insert_phong($room_name,$img_destination,$description,$room_price,$type_id,$Trangthai){
    $sql = "INSERT INTO rooms (room_name, img, description, room_price, type_id, Trangthai)
    VALUES ('$room_name','$img_destination','$description','$room_price','$type_id','$Trangthai')";
    pdo_execute($sql);
}
function delete_phong($id){
    $sql="delete from rooms where room_id=".$id;
    pdo_execute($sql);
}
function load_phong_cungdm($id,$type_id)
{
    $sql = "select * from rooms where type_id=".$type_id." AND room_id <>".$id;
    $listp = pdo_query($sql);
    return $listp;
}
?>