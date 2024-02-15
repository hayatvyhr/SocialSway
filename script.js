const messagesElement = document.getElementById('messages');
const messageInputElement = document.getElementById('message-input');
const sendFormElement = document.getElementById('send-form');

// fetch messages from server and display them
function fetchMessages() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_messages.php');
    xhr.onload = () => {
        if (xhr.status === 200) {
            const messages = JSON.parse(xhr.responseText);
            messagesElement.innerHTML = '';
            messages.forEach((message) => {
                displayMessage(message);
            });
        } else {
            console.error(xhr.statusText);
        }
    };
    xhr.send();
}

// display a message in the chat
function displayMessage(message) {
    const messageElement = document.createElement('div');
    messageElement.classList.add('message');
    messageElement.textContent = `${message.sender}: ${message.text}`;
    messagesElement.appendChild(messageElement);
}

// send message to server and display it in the chat
function sendMessage(event) {
    event.preventDefault();
    const message = messageInputElement.value.trim();
    if (message) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'send_message.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = () => {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    const message = response.message;
                    displayMessage(message);
                    messageInputElement.value = '';
                } else {
                    console.error(response.error);
                }
            } else {
                console.error(xhr.statusText);
            }
        };
        xhr.send(`text=${encodeURIComponent(message)}`);
    }
}

// fetch messages on page load
fetchMessages();

// set up interval to fetch messages periodically
setInterval(fetchMessages, 1000);

// set up event listener to send messages
sendFormElement.addEventListener('submit', sendMessage);
