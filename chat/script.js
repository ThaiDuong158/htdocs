// Biến toàn cục
let currentChatTab = 1;
let conversationId = null;
let status = 'Idle';

// Hàm khởi tạo khi trang web được tải
document.addEventListener('DOMContentLoaded', () => {
    // Lắng nghe sự kiện click cho nút mở widget chat
    document.querySelector('.open-chat-widget').addEventListener('click', event => {
        event.preventDefault();
        initChat();
    });

    // Kiểm tra tự động đăng nhập nếu có cookie
    if (document.cookie.match(/^(.*;)?\s*chat_secret\s*=\s*[^;]+(.*)?$/)) {
        fetchConversations();
    }
});

// Hàm khởi tạo chat
function initChat() {
    // Hiển thị widget chat
    document.querySelector('.chat-widget').style.display = 'flex';
    document.querySelector('.chat-widget').getBoundingClientRect();
    document.querySelector('.chat-widget').classList.add('open');

    // Lắng nghe sự kiện click cho nút đóng widget chat
    document.querySelector('.close-chat-widget-btn').addEventListener('click', event => {
        event.preventDefault();
        document.querySelector('.chat-widget').classList.remove('open');
    });

    // Lắng nghe sự kiện click cho nút quay lại tab trước
    document.querySelector('.previous-chat-tab-btn').addEventListener('click', event => {
        event.preventDefault();
        selectChatTab(currentChatTab - 1);
    });

    // Lắng nghe sự kiện submit cho form đăng nhập
    document.querySelector('.chat-widget-login-tab form').addEventListener('submit', event => {
        event.preventDefault();
        authenticateUser(event.target);
    });
}

// Hàm xử lý xác thực người dùng
function authenticateUser(form) {
    // Lấy dữ liệu từ form
    let formData = new FormData(form);

    // Gửi yêu cầu AJAX đến authenticate.php
    fetch(form.action, {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Xử lý phản hồi từ server
        if (data.includes('operator')) {
            // Hiển thị trường mật khẩu cho Operator
            document.querySelector('.chat-widget-login-tab .msg').insertAdjacentHTML('beforebegin', '<input type="password" name="password" placeholder="Your Password" required>');
        } else if (data.includes('success')) {
            // Xác thực thành công, chuyển sang tab danh sách cuộc trò chuyện
            document.querySelector('.chat-widget-login-tab .msg').innerHTML = 'Success!';
            fetchConversations();
        } else {
            // Xác thực thất bại, hiển thị thông báo lỗi
            document.querySelector('.chat-widget-login-tab .msg').innerHTML = data;
        }
    });
}

// Hàm lấy danh sách cuộc trò chuyện
function fetchConversations() {
    // Gửi yêu cầu AJAX đến conversations.php
    fetch('conversations.php', { cache: 'no-store' })
    .then(response => response.text())
    .then(data => {
        // Cập nhật nội dung tab danh sách cuộc trò chuyện
        document.querySelector('.chat-widget-conversations-tab').innerHTML = data;

        // Cập nhật trạng thái và chuyển sang tab danh sách cuộc trò chuyện
        status = 'Idle';
        selectChatTab(2);

        // Gắn sự kiện cho các cuộc trò chuyện
        conversationHandler();
    });
}

// Hàm xử lý các sự kiện liên quan đến cuộc trò chuyện
function conversationHandler() {
    // Lắng nghe sự kiện click cho nút tạo cuộc trò chuyện mới
    document.querySelector('.chat-widget-new-conversation').addEventListener('click', event => {
        event.preventDefault();
        // Cập nhật trạng thái và chuyển sang tab cuộc trò chuyện
        status = 'Waiting';
        document.querySelector('.chat-widget-conversation-tab').innerHTML = `
        <div class="chat-widget-messages">
            <div class="chat-widget-message">Please wait...</div>
        </div>
        `;
        selectChatTab(3);
    });

    // Lắng nghe sự kiện click cho các cuộc trò chuyện
    document.querySelectorAll('.chat-widget-conversation').forEach(element => {
        element.addEventListener('click', event => {
            event.preventDefault();
            getConversation(element.dataset.id);
        });
    });
}

// Hàm lấy nội dung cuộc trò chuyện
function getConversation(id) {
    // Gửi yêu cầu AJAX đến conversation.php
    fetch(`conversation.php?id=${id}`, { cache: 'no-store' })
    .then(response => response.text())
    .then(data => {
        // Cập nhật biến conversationId và trạng thái
        conversationId = id;
        status = 'Occupied';

        // Cập nhật nội dung tab cuộc trò chuyện
        document.querySelector('.chat-widget-conversation-tab').innerHTML = data;

        // Chuyển sang tab cuộc trò chuyện
        selectChatTab(3);

        // Cuộn xuống cuối danh sách tin nhắn
        scrollToBottom('.chat-widget-messages');

        // Lắng nghe sự kiện submit cho form gửi tin nhắn
        let chatWidgetInputMsg = document.querySelector('.chat-widget-input-message');
        if (chatWidgetInputMsg) {
            chatWidgetInputMsg.addEventListener('submit', event => {
                event.preventDefault();
                sendMessage(chatWidgetInputMsg);
            });
        }
    });
}

// Hàm gửi tin nhắn
function sendMessage(form) {
    // Lấy dữ liệu từ form
    let formData = new FormData(form);

    // Gửi yêu cầu AJAX đến post_message.php
    fetch(form.action, {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Xử lý phản hồi từ server

        // Tạo element tin nhắn mới và thêm vào danh sách tin nhắn
        let message = document.createElement('div');
        message.classList.add('chat-widget-message');
        message.textContent = formData.get('msg');
        document.querySelector('.chat-widget-messages').appendChild(message);

        // Xóa nội dung input và cuộn xuống cuối danh sách tin nhắn
        form.querySelector('input[name="msg"]').value = '';
        scrollToBottom('.chat-widget-messages');
    });
}

// Hàm chọn tab chat
function selectChatTab(value) {
    // Cập nhật biến currentChatTab
    currentChatTab = value;

    // Áp dụng CSS để chuyển đổi giữa các tab
    document.querySelectorAll('.chat-widget-tab').forEach(element => element.style.transform = `translateX(-${(value - 1) * 100}%)`);

    // Ẩn/hiện nút quay lại tab trước
    document.querySelector('.previous-chat-tab-btn').style.display = value > 1 ? 'block' : 'none';

    // Reset conversationId nếu đang ở tab đăng nhập hoặc danh sách cuộc trò chuyện
    if (value === 1 || value === 2) {
        conversationId = null;
    }

    // Xóa cookie xác thực nếu đang ở tab đăng nhập
    if (value === 1) {
        document.cookie = 'chat_secret=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }
}

// Hàm cuộn xuống cuối element
function scrollToBottom(selector) {
    let element = document.querySelector(selector);
    if (element) {
        element.scrollTop = element.scrollHeight;
    }
}

// Hàm cập nhật real-time
setInterval(() => {
    if (currentChatTab === 2) {
        // Cập nhật danh sách cuộc trò chuyện
        fetchConversations();
    } else if (currentChatTab === 3 && conversationId !== null) {
        // Cập nhật nội dung cuộc trò chuyện
        getConversation(conversationId);
    } else if (currentChatTab === 3 && status === 'Waiting') {
        // Tìm kiếm cuộc trò chuyện mới
        findConversation();
    }
}, 5000); // Cập nhật sau mỗi 5 giây

// Hàm tìm kiếm cuộc trò chuyện mới
function findConversation() {
    fetch('find_conversation.php', { cache: 'no-store' })
    .then(response => response.text())
    .then(data => {
        if (data !== 'error') {
            // Tìm thấy cuộc trò chuyện mới, lấy nội dung cuộc trò chuyện
            getConversation(data);
        }
    });
}