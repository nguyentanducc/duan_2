document.addEventListener('DOMContentLoaded', function() {
    // Lắng nghe sự kiện click cho nút "Prev"
    document.getElementById('prev-btn').addEventListener('click', function() {
        navigate('prev');
    });

    // Lắng nghe sự kiện click cho nút "Next"
    document.getElementById('next-btn').addEventListener('click', function() {
        navigate('next');
    });
});

function navigate(direction) {
    // Sử dụng Fetch API để thực hiện Ajax
    fetch('getEventData.php?direction=' + direction)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            // Cập nhật lịch với dữ liệu mới
            updateCalendar(data);
        })
        .catch(error => {
            console.error('Error during fetch operation:', error);
        });
}

function updateCalendar(data) {
    // Cập nhật lịch với dữ liệu mới từ máy chủ
    // ...
}
