<!DOCTYPE html>
<html lang="en">
<?php include "html_head.html" ?>
<body class="bg-gray-100">
    <?php include "navbar.html" ?>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Delete Profile</h1>
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <p class="mb-4">Are you sure you want to delete your profile? This action cannot be undone.</p>
            <form method="POST" action="/delete_profile">
                <div class="flex items-center justify-between">
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Confirm Delete
                    </button>
                    <a href="/profile" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>