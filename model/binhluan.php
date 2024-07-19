<?php
    function insert_binhluan($content, $room_id, $user_id, $feedback_date)
    {
        $sql = "insert into feedback(content,room_id,user_id,feedback_date) values('$content', '$room_id', '$user_id', '$feedback_date')";
        pdo_execute($sql);
    }


    function loadall_binhluan($room_id){
        $sql = "select * from  feedback where 1";
        if($room_id>0) $sql.=" AND room_id='".$room_id."'";
        $sql.=" order by feedback_id desc";
        $listbl= pdo_query($sql);
        return $listbl;
    }
    function loadall_binhluan1(){
        $sql =" select * from feedback order by feedback_id desc";
        $listbinhluan = pdo_query($sql);
        return $listbinhluan;
    }
    function delete_binhluan($id){
        $sql = "delete from feedback where feedback_id=".$id;
        pdo_execute($sql);
    }
?>