function tinhDiem(ketQua) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../BaiKiemTra/ketQua.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var result = JSON.parse(xhr.responseText);
            var questions = result.questions;
            var answers = result.answers;
            var dung = 0;
            ketQua.forEach((traLoi, i) => {
                var index = questions.indexOf(traLoi.question);
                if (index !== -1 && traLoi.dapAn === answers[index]) {
                    dung++;
                }
            });
            var diem = (dung / ketQua.length * 10).toFixed(2);
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const id = urlParams.get('id');
            const num = urlParams.get('num');
            var xhr1 = new XMLHttpRequest();
            xhr1.open("POST", "../BaiKiemTra/guiDiem.php", true);
            xhr1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr1.onreadystatechange = function () {
                if (xhr1.readyState === 4 && xhr1.status === 200) {
                    console.log("Đã gửi điểm thành công!");
                    window.location.href = `../BaiKiemTra/TrangThaiKiemTra.php?id=${id}&num=${num}`;
                }
            };
            xhr1.send("diem=" + diem + "&soCau=" + ketQua.length + "&id=" + id);
        }
    };
    xhr.send();
}

document.querySelector('.nopBai').addEventListener('click', () => {
    var ketQua = [];
    document.querySelectorAll('.cau').forEach((cau, i) => {
        var cauTraLoi = 0;
        var cauHoi = cau.querySelector('.cauHoi').innerHTML;
        cau.querySelectorAll('.cau-TraLoi').forEach((cauTL) => {
            if (cauTL.checked) {
                cauTraLoi = cauTL.value;
            }
        })
        ketQua.push({ cau: i + 1, question: cauHoi, dapAn: cauTraLoi });
    })
    var daXuatHienAlert = false;
    ketQua.forEach((item) => {
        if (item.dapAn == 0) {
            if (!daXuatHienAlert) { // Kiểm tra trước khi hiển thị hộp thoại cảnh báo
                alert('Bạn Chưa Trả Lời hết Câu Hỏi!');
                daXuatHienAlert = true; // Đánh dấu đã xuất hiện hộp thoại cảnh báo
            }
            return;
        }
    })

    if (!daXuatHienAlert) {
        tinhDiem(ketQua);
    }

})

function startCountdown(duration, display) {
    var timer = duration, hours, minutes, seconds;
    setInterval(function () {
        hours = parseInt(timer / 3600, 10);
        minutes = parseInt((timer % 3600) / 60, 10);
        seconds = parseInt(timer % 60, 10);
        hours = hours < 10 ? "0" + hours : hours;
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        display.textContent = hours + ":" + minutes + ":" + seconds;
        if (--timer < 0) {
            // Khi thời gian kết thúc, tự động nộp bài
            document.querySelector('.nopBai').click();
        }
    }, 1000);
}

window.onload = function () {
    var display = document.querySelector('.kiemTra-ThoiGian__Chay');
    var str = display.innerHTML.split(":");
    var twentyMinutes = parseInt(str[0]) * 3600 + parseInt(str[1]) * 60 + parseInt(str[2]);
    startCountdown(twentyMinutes, display);
};

document.querySelector(".kiemTra-ThoiGian").style.top = document.querySelector('.kiemTra-list').clientHeight + 20 + 8 + 'px';