<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SORA Admin Panel - User Management</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body class="bg-gray-100">
    <header class="bg-gradient-to-r from-sora-primary to-sora-secondary text-white py-4 px-6 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <span class="text-2xl sm:text-3xl md:text-4xl font-bold">SORA</span>
            <span class="text-lg sm:text-xl md:text-2xl font-semibold">Admin Panel</span>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">User Management</h1>
        <div id="user-list" class="space-y-4">
            <?php foreach ($user_list as $user): ?>
                <div id="user-<?php echo $user['id']; ?>" class="bg-white shadow-md rounded-lg p-4 flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-semibold"><a href="/profile/<?=htmlspecialchars($user['username'])?>"><?php echo htmlspecialchars($user['username']); ?></a></h2>
                        <p class="text-gray-600"><?php echo htmlspecialchars($user['email']); ?></p>
                    </div>
                    <button onclick="deleteUser(<?php echo $user['id']; ?>)" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                        Delete
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <script>
        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                fetch('/admin/delete_user', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ user_id: userId }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'Success') {
                        const userElement = document.getElementById(`user-${userId}`);
                        userElement.remove();
                    } else {
                        alert('Failed to delete user: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the user.');
                });
            }
        }
    </script>
</body>
</html>