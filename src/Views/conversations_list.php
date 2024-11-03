<!DOCTYPE html>
<html lang="en">
<?php include_once __DIR__."/html_head.html" ?>
<body class="bg-gray-100">
<?php include_once __DIR__ ."/navbar.html"?>

<main class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Messages</h1>

    <div class="mb-4">
        <input type="text" id="user-search" class="w-full p-2 border rounded" placeholder="Search for a user...">
        <div id="user-search-results" class="mt-2"></div>
    </div>

    <div id="conversations-list" class="space-y-4">
        <?php foreach ($conversations as $conversation): ?>
            <div class="bg-white shadow rounded-lg hover:shadow-md transition-shadow duration-300">
                <a href="/messages/<?= $conversation['other_user_id'] ?>" class="block p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <img src="<?= htmlspecialchars($conversation['profile_picture']) ?>" alt="Profile" class="w-12 h-12 rounded-full">
                            <div>
                                <h2 class="text-lg font-semibold"><?= htmlspecialchars($conversation['username']) ?></h2>
                                <p class="text-gray-600 text-sm truncate"><?= htmlspecialchars($conversation['last_message'] ?? '') ?></p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-500"><?= isset($conversation['last_message_time']) ? date('M d, Y H:i', strtotime($conversation['last_message_time'])) : '' ?></span>
                            <?php if (isset($conversation['unread_count']) && $conversation['unread_count'] > 0): ?>
                                <span class="bg-blue-500 text-white text-xs font-bold rounded-full px-2 py-1"><?= $conversation['unread_count'] ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const userSearch = document.getElementById('user-search');
    const userSearchResults = document.getElementById('user-search-results');
    const conversationsList = document.getElementById('conversations-list');

    let selectedUserIndex = -1;

    userSearch.addEventListener('input', async (e) => {
        const searchTerm = e.target.value;
        if (searchTerm.length < 1) {
            userSearchResults.innerHTML = '';
            selectedUserIndex = -1;
            return;
        }

        try {
            const response = await fetch(`/users/search?term=${encodeURIComponent(searchTerm)}`);
            if (response.ok) {
                const users = await response.json();
                userSearchResults.innerHTML = users.map((user, index) => `
                    <div class="user-result bg-gray-300 p-2 hover:bg-sora-secondary  cursor-pointer ${index === 0 ? 'bg-sora-secondary' : ''}" data-user-id="${user.id}">
                        ${user.username}
                    </div>
                `).join('');
                selectedUserIndex = 0;
                highlightSelectedUser();
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });

    userSearch.addEventListener('keydown', (e) => {
        const results = userSearchResults.querySelectorAll('.user-result');
        if (results.length === 0) return;

        if (e.key === 'ArrowDown') {
            e.preventDefault();
            selectedUserIndex = (selectedUserIndex + 1) % results.length;
            highlightSelectedUser();
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            selectedUserIndex = (selectedUserIndex - 1 + results.length) % results.length;
            highlightSelectedUser();
        } else if (e.key === 'Enter') {
            e.preventDefault();
            const selectedUser = results[selectedUserIndex];
            if (selectedUser) {
                selectUser(selectedUser.dataset.userId);
            }
        }
    });

    userSearchResults.addEventListener('click', (e) => {
        const userResult = e.target.closest('.user-result');
        if (userResult) {
            selectUser(userResult.dataset.userId);
        }
    });

    function highlightSelectedUser() {
        const results = userSearchResults.querySelectorAll('.user-result');
        results.forEach((result, index) => {
            if (index === selectedUserIndex) {
                result.classList.add('bg-sora-secondary');
            } else {
                result.classList.remove('bg-sora-secondary');
            }
        });
    }

    function selectUser(userId) {
        window.location.href = `/messages/${userId}`;
    }


    // Function to add a new conversation to the list
    function addNewConversation(conversation) {
        const newConversationHtml = `
            <div class="bg-white shadow rounded-lg hover:shadow-md transition-shadow duration-300">
                <a href="/messages/${conversation.id}" class="block p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <img src="${conversation.profile_picture}" alt="Profile" class="w-12 h-12 rounded-full">
                            <div>
                                <h2 class="text-lg font-semibold">${conversation.username}</h2>
                                <p class="text-gray-600 text-sm truncate">New conversation</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        `;
        conversationsList.insertAdjacentHTML('afterbegin', newConversationHtml);
    }

    // You can call addNewConversation when a new conversation is started
    // For example, after sending the first message to a new user
});
</script>





<!-- <script>
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
</script> -->

</body>
</html>