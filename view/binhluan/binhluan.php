<?php

include "../../model/pdo.php";
include "../../model/binhluan.php";
include "../../controller/login.php";
$id = $_REQUEST['room_id'];
if(isset( $_SESSION["idPerson"])){
    $user_id=$_SESSION["idPerson"];
}
else{
    $user_id="";
}
$dsbl = loadall_binhluan($id);

// Function to check profanity
function isProfanity($comment) {
    // Danh sách từ cấm
    $prohibitedWords = ['dm', 'dcm', 'dcmm', 'vcl'];

    foreach ($prohibitedWords as $word) {
        if (stripos($comment, $word) !== false) {
            return true;
        }
    }
    return false;
}

// Check gửi bình luận
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guibinhluan'])) {
    // $allowedRoles=[1,2,3];
    // checkRole($allowedRoles);
  // Kiểm tra xem session có tồn tại không
if (!isset($_SESSION["idPerson"])) {
    echo "Vui lòng đăng nhập để bình luận.";
    die();
} else {
    // Session tồn tại, thực hiện các bước insert
    $content = $_POST['content'];
    $room_id = $_POST['room_id'];
    $user_id = $_POST['user_id'];

    // Kiểm tra từ khóa tục tĩu
    if (isProfanity($content)) {
        echo '<p style="color: red;">Ngôn từ không phù hợp không được phép.</p>';
    } else {
        // Thêm bình luận
        insert_binhluan($content, $room_id, $user_id);

        // Hiển thị thông báo thành công
        echo '<p style="color: green;">Bình luận đã được đăng thành công.</p>';

        // Redirect để tránh việc gửi lại dữ liệu khi người dùng làm mới trang
        header("location:" . $_SERVER['HTTP_REFERER']);
        exit;
    }
}

   
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
   .comment {
        border: 1px solid #ccc;
        /* padding: -10px; */
        /* margin-bottom: 10px; */
        background-color: #f0fff0; 
        display: flex;
        flex-direction: column;
        font-size: smaller;
    }

    .comment-content {
        margin-top: 10px;
    }
    
    .user-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: -15px;
        font-weight: bold; 
    }
    .feedback-date {
        font-size: smaller;
    }
    
</style>
</head>

<body>
    <div class="row mb">
        <div class="boxtitle">BÌNH LUẬN</div>
       
        <div class="boxfooter binhluan">
            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="hidden" name="room_id" value="<?= $id; ?>">
                <input type="hidden" name="user_id" value="<?= $user_id; ?>">
                <textarea id="comment-input" rows="4" placeholder="Nhập bình luận của bạn..." name="content"></textarea>
                <input type="submit" name="guibinhluan" value="Gửi Bình luận">
            </form>
        </div>
        <br>
        <hr>
        <div class="boxcontent2 binhluan">
        <h2>Xem bình luận</h2>
        <?php foreach ($dsbl as $bl) :
            $sql="select username from users where user_id=".$bl['user_id'];
            $ten=pdo_query_value($sql); ?>
    <div class="comment">
        <div class="user-info">
            <p>User: <?=  $ten ?></p>
        </div>
        <p class="feedback-date"><?= $bl['feedback_date'] ?></p>
       
        <div class="comment-content">
        <hr>
            <p  id="comment"><?= $bl['content'] ?></p>
          
            <?php if (isset($_SESSION["idPerson"]) && $bl['user_id'] == $_SESSION["idPerson"]) {
    // Hiển thị nút chỉnh sửa và xóa
   
    $currentData=$bl['content'];
    echo '<div id="editProfileForm" style="display:none;">
    <form method="post" action="">
        <input type="text" name="newUsername" placeholder="Nhập tên mới" value="' . $currentData . '" >
        <input type="submit" name="saveChanges" value="Lưu thay đổi">
    </form>
  </div>';
  echo '<button onclick="editProfile()">Chỉnh sửa</button>';
  echo '<button onclick="deleteProfile()">Xóa</button>';
} ?>
         </div>
    </div>
        <?php  endforeach; ?>
        </div>
    </div>
</body>
<script>
    function editProfile() {
        var profileData = document.getElementById("comment");
        var editForm = document.getElementById("editProfileForm");
        profileData.style.display = "none";
        editForm.style.display = "block";
    }

    function deleteProfile() {
        // Code xử lý xóa profile
    }
</script>
</html>




    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        #comment-box {
            max-width: 500px;
            margin: 0 auto;
        }

        #comment-input {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            box-sizing: border-box;
        }

        #comment-list {
            list-style: none;
            padding: 0;
        }

        .comment {
            border: 1px solid #ccc;
            margin-bottom: 10px;
            padding: 10px;
        }
    </style>

    <script>
        function submitComment() {
            var commentInput = document.getElementById('comment-input').value;
            if (commentInput.trim() !== '') {
                var commentList = document.getElementById('comment-list');
                var newComment = document.createElement('div');
                newComment.className = 'comment';
                newComment.textContent = commentInput;
                commentList.appendChild(newComment);
                document.getElementById('comment-input').value = '';
            }
        }
    </script>

