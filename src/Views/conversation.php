<!DOCTYPE html>
<html lang="en">
<?php include_once __DIR__."/html_head.html" ?>
<body class="bg-gray-100">
<?php include_once __DIR__ ."/navbar.html"?>

<main class="container mx-auto px-4 py-8">
    <div class="bg-white shadow rounded-lg">
        <div class="flex justify-between items-center p-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold">
                <?= isset($messages[0]) ? htmlspecialchars($messages[0]['username']) : 'New Conversation' ?>
            </h1>
            <div>
                <button id="new-conversation-btn" class="bg-green-500 text-white px-4 py-2 rounded mr-2 hover:bg-green-600 transition-colors">New Conversation</button>
                <?php if (isset($other_user_id)): ?>
                    <button id="block-btn" class="bg-red-500 text-white px-4 py-2 rounded mr-2 hover:bg-red-600 transition-colors">Block</button>
                    <button id="delete-conversation-btn" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition-colors">Delete Conversation</button>
                <?php endif; ?>
            </div>
        </div>
        
        <div id="user-search" class="p-4 border-b border-gray-200 hidden">
            <input type="text" id="user-search-input" class="w-full p-2 border rounded" placeholder="Search for a user...">
            <div id="user-search-results" class="mt-2"></div>
        </div>

        <div id="messages-container" class="h-96 overflow-y-auto p-4">
            <?php if (isset($messages)): ?>
                <?php foreach ($messages as $message): ?>
                    <div class="mb-4 <?= $message['sender_id'] == $_SESSION['user_id'] ? 'text-right' : 'text-left' ?>">
                        <div class="inline-block max-w-xs <?= $message['sender_id'] == $_SESSION['user_id'] ? 'bg-blue-500 text-white' : 'bg-gray-300' ?> rounded-lg px-4 py-2">
                            <p><?= htmlspecialchars($message['content']) ?></p>
                            <span class="text-xs <?= $message['sender_id'] == $_SESSION['user_id'] ? 'text-blue-200' : 'text-gray-500' ?>"><?= date('M d, Y H:i', strtotime($message['created_at'])) ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center text-gray-500">Start a new conversation by searching for a user above.</p>
            <?php endif; ?>
        </div>
        
        <form id="message-form" class="p-4 border-t border-gray-200">
            <div class="flex">
                <input type="text" id="message-input" name="content" class="flex-grow p-2 border rounded-l" placeholder="Type your message..." required>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r hover:bg-blue-600 transition-colors">Send</button>
            </div>
            <input type="hidden" name="receiver_id" id="receiver-id" value="<?= $other_user_id ?? '' ?>">
        </form>
    </div>
</main>

<script>
    const messageForm = document.getElementById('message-form');
    const messageInput = document.getElementById('message-input');
    const messagesContainer = document.getElementById('messages-container');
    const newConversationBtn = document.getElementById('new-conversation-btn');
    const userSearch = document.getElementById('user-search');
    const userSearchInput = document.getElementById('user-search-input');
    const userSearchResults = document.getElementById('user-search-results');
    const receiverId = document.getElementById('receiver-id');

    <?php if (isset($other_user_id)): ?>
    const blockBtn = document.getElementById('block-btn');
    const deleteConversationBtn = document.getElementById('delete-conversation-btn');
    <?php endif; ?>

    messageForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(messageForm);

        try {
            const response = await fetch('/messages/send', {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                const result = await response.json();
                if (result.success) {
                    messageInput.value = '';
                    // You might want to add the new message to the messages container here
                    // or reload the conversation
                    location.reload();
                } else {
                    alert('Failed to send message: ' + result.message);
                }
            } else {
                alert('Failed to send message. Please try again.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        }
    });

    newConversationBtn.addEventListener('click', () => {
        userSearch.classList.toggle('hidden');
    });

    userSearchInput.addEventListener('input', async (e) => {
        const searchTerm = e.target.value;
        if (searchTerm.length < 3) {
            userSearchResults.innerHTML = '';
            return;
        }

        try {
            const response = await fetch(`/users/search?term=${encodeURIComponent(searchTerm)}`);
            if (response.ok) {
                const users = await response.json();
                userSearchResults.innerHTML = users.map(user => `
                    <div class="user-result p-2 hover:bg-gray-100 cursor-pointer" data-user-id="${user.id}">
                        ${user.username}
                    </div>
                `).join('');

                document.querySelectorAll('.user-result').forEach(result => {
                    result.addEventListener('click', () => {
                        const userId = result.dataset.userId;
                        receiverId.value = userId;
                        userSearch.classList.add('hidden');
                        messagesContainer.innerHTML = '<p class="text-center text-gray-500">Start a new conversation by sending a message.</p>';
                        document.querySelector('h1').textContent = 'New Conversation';
                    });
                });
            } else {
                userSearchResults.innerHTML = '<p class="text-red-500">Failed to search users. Please try again.</p>';
            }
        } catch (error) {
            console.error('Error:', error);
            userSearchResults.innerHTML = '<p class="text-red-500">An error occurred. Please try again.</p>';
        }
    });

    <?php if (isset($other_user_id)): ?>
    blockBtn.addEventListener('click', async () => {
        if (confirm('Are you sure you want to block this user?')) {
            try {
                const response = await fetch('/messages/block', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `blocked_id=<?= $other_user_id ?>`
                });

                if (response.ok) {
                    const result = await response.json();
                    if (result.success) {
                        alert('User blocked successfully');
                        window.location.href = '/messages';
                    } else {
                        alert('Failed to block user: ' + result.message);
                    }
                } else {
                    alert('Failed to block user. Please try again.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            }
        }
    });

    deleteConversationBtn.addEventListener('click', async () => {
        if (confirm('Are you sure you want to delete this conversation?')) {
            try {
                const response = await fetch('/messages/delete', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `other_user_id=<?= $other_user_id ?>`
                });

                if (response.ok) {
                    const result = await response.json();
                    if (result.success) {
                        alert('Conversation deleted successfully');
                        window.location.href = '/messages';
                    } else {
                        alert('Failed to delete conversation: ' + result.message);
                    }
                } else {
                    alert('Failed to delete conversation. Please try again.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            }
        }
    });
    <?php endif; ?>

    // Scroll to the bottom of the messages container
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
</script>

</body>
</html>