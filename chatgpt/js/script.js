document.addEventListener("DOMContentLoaded", () => {
    createChatInterface();
    handleChatInterfaceEvents();
});

function createChatInterface() {
    // Create an image element for the button
    const chatButtonImage = createElementWithProps("img", {
        src: "https://upload.wikimedia.org/wikipedia/commons/thumb/1/13/ChatGPT-Logo.png/1200px-ChatGPT-Logo.png", // Replace with the actual path to your image
        alt: "ChatGPT Button Image",
        width: "60", // Set the desired width
        height: "60", // Set the desired height
    });

    // Create the button and append the image
    const chatButton = createElementWithProps("button", {
        id: "chatgpt-button",
    });
    chatButton.appendChild(chatButtonImage);

    // Create the chat window
    const chatWindow = createElementWithProps("div", {
        id: "chatgpt-chat-window",
        innerHTML: getChatWindowHTML(),
    });

    // Append the button and chat window to the document body
    document.body.append(chatButton, chatWindow);
}

function handleChatInterfaceEvents() {
    const chatButton = document.getElementById("chatgpt-button");
    const chatWindow = document.getElementById("chatgpt-chat-window");
    const messagesContainer = document.getElementById("chatgpt-messages");
    const input = document.getElementById("chatgpt-input");
    const sendButton = document.getElementById("chatgpt-send-button");

    chatButton.addEventListener("click", toggleChatWindow);
    input.addEventListener("keypress", handleKeyPress);
    sendButton.addEventListener("click", sendMessage);
}

function createElementWithProps(tag, props) {
    const element = document.createElement(tag);
    Object.assign(element, props);
    return element;
}

function getChatWindowHTML() {
    return `
    <div id="chatgpt-title">ChatGPT</div>
    <div id="chatgpt-messages"></div>
    <div id="chatgpt-input-container">
        <input type="text" id="chatgpt-input" placeholder="Type your message..."/>
        <button id="chatgpt-send-button">Send</button>
    </div>
    `;
}

function toggleChatWindow() {
    const chatWindow = document.getElementById("chatgpt-chat-window");
    const isDisplayed = chatWindow.style.display === "flex";
    chatWindow.style.display = isDisplayed ? "none" : "flex";
}

function handleKeyPress(e) {
    if (e.key === "Enter") {
        sendMessage();
    }
}

function sendMessage() {
    const input = document.getElementById("chatgpt-input");
    const message = input.value.trim();

    if (message !== "") {
        addMessage("You", message);
        input.value = "";
        sendMessageToServer(message);
    }
}

function addMessage(sender, message) {
    const messagesContainer = document.getElementById("chatgpt-messages");
    const messageDiv = createElementWithProps("div", { innerHTML: `<b>${sender}:</b> ${message}` });
    messagesContainer.appendChild(messageDiv);
}

function setLoading(isLoading) {
    const sendButton = document.getElementById("chatgpt-send-button");
    sendButton.disabled = isLoading;
    sendButton.textContent = isLoading ? "..." : "Send";
}

async function sendMessageToServer(message) {
    setLoading(true);
    try {
        const response = await fetch("/wp-json/chatgpt/v1/message/", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ message: message }),
        });

        const data = await response.json();

        if (data.choices && data.choices.length > 0) {
            const reply = data.choices[0].message.content;
            addMessage("ChatGPT", reply);
        }
    } catch (error) {
        console.error("Error:", error);
    }

    setLoading(false);
}