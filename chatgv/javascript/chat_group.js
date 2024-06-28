document.addEventListener('DOMContentLoaded', (event) => {
    const form = document.querySelector(".typing-area"),
        inputField = form.querySelector(".input-field"),
        groupIdInput = form.querySelector(".group_id"), 
        sendBtn = form.querySelector("button"),
        chatBox = document.querySelector(".chat-box");

    // Get the group ID from the hidden input field
    const incoming_id = groupIdInput.value; 

    // Prevent form from submitting traditionally
    form.onsubmit = (e) => {
        e.preventDefault();
    };

    // Focus on the input field
    inputField.focus();

    // Send button activation/deactivation 
    inputField.onkeyup = () => {
        sendBtn.classList.toggle("active", inputField.value !== ""); 
    };

    // Sending the message
    sendBtn.onclick = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "php/insert-chat_group.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    inputField.value = ""; // Clear input field
                    scrollToBottom();   // Scroll to bottom
                } else {
                    console.error("Error sending message:", xhr.status); 
                }
            }
        };
        xhr.onerror = () => {
            console.error("Request failed. Check your network connection."); 
        };

        // Send group_id and message
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("group_id=" + incoming_id + "&message=" + inputField.value); 
    };

    // Chat box hover effect (if needed)
    chatBox.onmouseenter = () => {
        chatBox.classList.add("active");
    };
    chatBox.onmouseleave = () => {
        chatBox.classList.remove("active");
    };

    // Fetch new messages periodically
    setInterval(() => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "php/get-chat_group.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    chatBox.innerHTML = xhr.response;
                    if (!chatBox.classList.contains("active")) {
                        scrollToBottom(); 
                    }
                } else {
                    console.error("Error fetching messages:", xhr.status); 
                }
            }
        };
        xhr.onerror = () => {
            console.error("Request failed. Check your network connection."); 
        };

        // Send group_id for fetching messages 
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        // Corrected xhr.send() line:
        xhr.send("group_id=" + encodeURIComponent(incoming_id)); 
    }, 500); 

    // Smooth scrolling to the bottom of the chat box
    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    } 
});