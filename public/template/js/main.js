// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });

function removeRow(url) {
    if (confirm('Bạn có chắc chắn muốn xóa và không thể khôi phục')) {
        // alert(url);
        fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (response.ok) {
                    // Xử lý phản hồi thành công (nếu cần)
                    location.reload(); // Ví dụ: Tải lại trang
                } else {
                    response.json().then(data => {
                        alert('Xảy ra lỗi khi xóa : ' + (data.message || 'Lỗi không xác định.'));
                    }).catch(() => {
                        alert('Xảy ra lỗi khi xóa.');
                    });
                }
            })
            .catch(error => {
                console.error('Lỗi:', error);
                alert('Đã xảy ra lỗi khi gửi yêu cầu xóa.');
            });
    }
}

function showResponseMessage(type, message) {
    const responseMessageDiv = document.getElementById('responseMessage');
    responseMessageDiv.style.display = 'block';
    responseMessageDiv.innerHTML = message;
    responseMessageDiv.className = type === 'success' ? 'alert alert-success fade-out' : 'alert alert-danger fade-out';
    setTimeout(() => {
        responseMessageDiv.style.display = 'none';
    }, 5000);
}