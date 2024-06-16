const btnSave = $('.btn--save');
const btnCancel = $('.btn--cancel');

btnCancel.onclick = () => {
    alert("Những thay đổi của bạn sẽ không được lưu!");
    window.location.href = '../NopBai/TrangThaiNopBai.php';
}

btnSave.onclick = () => {
    alert("Cập nhật thành công!");
    window.location.href = '../NopBai/TrangThaiNopBai.php';
}