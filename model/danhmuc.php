<?php
function loadall_dm($keyw="",$type_id=0){
    $sql="SELECT *  FROM type_room  WHERE 1";
    // where 1 tức là nó đúng
    if($keyw!=""){
        $sql.=" and type_name like '%".$keyw."%'";
    }
    if($type_id>0){
        $sql.=" and type_id ='".$type_id."'";
    }
    $sql.=" order by type_id desc";
    $listdm=pdo_query($sql);
    return  $listdm;
}
function insert_danhmuc($type_name,$img,$max_people,$max_bed){
    $sql="INSERT INTO type_room(type_name,img,max_people,max_bed) VALUES ('$type_name','$img','$max_people','$max_bed')";
    pdo_execute($sql);
}
function delete_dm($id){
    $sql="delete from type_room where type_id=".$id;
    pdo_execute($sql);
}
function loadone_dm($id){
    $sql="select * from type_room  where type_id=".$id ;
    $dm=pdo_query_one($sql); 
return $dm;
}
?>