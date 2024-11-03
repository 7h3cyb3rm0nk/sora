<!DOCTYPE html>
<html lang="en">
<?php include_once __DIR__."/html_head.html" ?>
<body class="bg-gray-100">
<?php include_once __DIR__ ."/navbar.html"?>

<main class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Messages</h1>

    <div class="bg-white shadow rounded-lg">
        <?php foreach ($conversations as $conversation): ?>
            <a href="/messages/<?= $conversation['other_user_id'] ?>" class="block hover:bg-gray-50">
                <div class="flex items-center p-4 border-b border-gray-200">
                    <img src="<?= htmlspecialchars($conversation['profile_picture']) ?>" alt="Profile" class="w-12 h-12 rounded-full mr-4">
                    <div class="flex-grow">
                        <div class="flex justify-between items-baseline">
                            <h2 class="text-lg font-semibold"><?= htmlspecialchars($conversation['username']) ?></h2>
                            <span class="text-sm text-gray-500"><?= date('M d, Y H:i', strtotime($conversation['last_message_time'])) ?></span>
                        </div>
                        <p class="text-gray-600 truncate"><?= htmlspecialchars($conversation['last_message']) ?></p>
                    </div>
                    <?php if ($conversation['unread_count'] > 0): ?>
                        <span class="bg-blue-500 text-white text-xs font-bold rounded-full px-2 py-1 ml-2"><?= $conversation['unread_count'] ?></span>
                    <?php endif; ?>
                </div>
            </a>
        <?php endforeach; ?>
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