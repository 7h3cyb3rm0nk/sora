document.addEventListener('DOMContentLoaded', function() {
    const followedUsersList = document.getElementById('followed-users-list');
    const searchInput = document.getElementById('user-search');
    const searchResults = document.getElementById('search-results');

    // Load followed users
    loadFollowedUsers();

    // Handle user search
    searchInput.addEventListener('input', debounce(searchUsers, 300));

    // Function to load followed users
    function loadFollowedUsers() {
        fetch('/get_followed_users')
            .then(response => response.json())
            .then(users => {
                followedUsersList.innerHTML = '';
                users.forEach(user => {
                    followedUsersList.appendChild(createUserListItem(user, true));
                });
            });
    }

    // Function to search users
    function searchUsers() {
        const query = searchInput.value;
        if (query.length < 1) {
            searchResults.innerHTML = '';
            return;
        }

        fetch(`/search_users?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(users => {
                
                searchResults.innerHTML = '';
                users.forEach(user => {
                    searchResults.appendChild(createUserListItem(user, user.isFollowing));
                });
            });
    }

    // Function to create a user list item
    function createUserListItem(user, isFollowed) {
        const li = document.createElement('li');
        li.className = 'flex items-center justify-between space-x-3';
        li.innerHTML = `
            <div class="flex items-center space-x-3">
                <img src="${user.profile_picture || '/images/icons/user-avatar.png'}" alt="${user.username}" class="w-10 h-10 rounded-full">
                <a href="/profile/${user.username}" class="font-medium">${user.username}</a>
            </div>
            <button class="follow-btn px-3 py-1 rounded-full text-sm font-medium ${isFollowed ? 'bg-gray-200 text-gray-800' : 'bg-blue-500 text-white'}" data-user-id="${user.id}">
                ${isFollowed ? 'Unfollow' : 'Follow'}
            </button>
        `;

        const followBtn = li.querySelector('.follow-btn');
        followBtn.addEventListener('click', () => toggleFollow(user.id, followBtn));

        return li;
    }

    // Function to toggle follow/unfollow
    function toggleFollow(userId, button) {
        const isFollowing = button.textContent.trim() === 'Unfollow';
        const action = isFollowing ? 'unfollow' : 'follow';

        fetch(`/${action}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ user_id: userId })
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                if (isFollowing) {
                    button.textContent = 'Follow';
                    button.classList.remove('bg-gray-200', 'text-gray-800');
                    button.classList.add('bg-blue-500', 'text-white');
                } else {
                    button.textContent = 'Unfollow';
                    button.classList.remove('bg-blue-500', 'text-white');
                    button.classList.add('bg-gray-200', 'text-gray-800');
                }
                // Refresh the followed users list
                loadFollowedUsers();
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Debounce function to limit API calls
    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }
});