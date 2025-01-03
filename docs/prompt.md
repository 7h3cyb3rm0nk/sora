Project Path: /home/ramees/progs/php/sora

Source Tree:

```
sora
├── tailwind.config.js
├── public
│   ├── js
│   │   ├── status.js
│   │   ├── follow.js
│   │   └── mobile-nav.js
│   ├── images
│   │   ├── sora-login.jpg
│   │   ├── sora-bg1.jpg
│   │   ├── icons
│   │   │   └── user-avatar.png
│   │   ├── sora-bg2.png
│   │   ├── pfps
│   │   │   ├── profile_8_1729844133.png
│   │   │   ├── profile_8_1729842219.png
│   │   │   ├── profile_8_1729843607.png
│   │   │   ├── arch.png
│   │   │   ├── profile_8_1729846445.png
│   │   │   ├── profile_8_1729846587.png
│   │   │   ├── profile_8.png
│   │   │   ├── profile_8_1729845933.png
│   │   │   ├── profile_8_1729842162.png
│   │   │   ├── profile_8_1729845713.png
│   │   │   ├── profile_8_1729844742.png
│   │   │   ├── profile_8_1729846207.png
│   │   │   ├── profile_8_1729847225.png
│   │   │   ├── profile_8_1729846223.png
│   │   │   ├── profile_8_1729842549.png
│   │   │   ├── profile_8_1729842280.png
│   │   │   ├── profile_8_1729846182.png
│   │   │   └── profile_6.png
│   │   ├── user-edit.png
│   │   ├── sora-bg3.png
│   │   ├── sora-bg4.png
│   │   └── sora-bg.png
│   ├── css
│   │   ├── imports.css
│   │   └── styles.css
│   └── index.php
├── vendor
├── tests
│   └── sample.php
├── docs
├── src
│   ├── Helpers
│   │   └── Helper.php
│   ├── Config
│   │   ├── Database.php
│   │   ├── sample.php
│   │   ├── sora.sql
│   │   └── init.php
│   ├── Core
│   │   ├── Router.php
│   │   └── Application.php
│   ├── Controllers
│   │   ├── HomeController.php
│   │   ├── AdminController.php
│   │   ├── PostController.php
│   │   ├── MessageController.php
│   │   ├── UserController.php
│   │   └── SpaceController.php
│   ├── Models
│   │   ├── UserModel.php
│   │   ├── SpaceModel.php
│   │   ├── MessageModel.php
│   │   ├── AdminModel.php
│   │   └── PostModel.php
│   └── Views
│       ├── view_space.html
│       ├── create_space.html
│       ├── navbar.html
│       ├── login.html
│       ├── layout.php
│       ├── delete_profile.php
│       ├── conversation.php
│       ├── profile.html
│       ├── conversations_list.php
│       ├── signup.html
│       ├── spaces_list.html
│       ├── home.html
│       ├── admin_panel.php
│       ├── html_head.html
│       └── user_profile.html
├── composer.json
└── README.md

```

`/home/ramees/progs/php/sora/tailwind.config.js`:

```````js
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./src/**/*.{html,php,js}',
    './**/*.{html,php,js}'],
  theme: {
    extend: {
      colors: {
          'sora-primary': '#4F46E5',
          'sora-secondary': '#818CF8',
          'sora-bg': '#F3F4F6',
          'sora-text': '#1F2937',
      }
  },
  },
  plugins: [],
}


```````

`/home/ramees/progs/php/sora/public/js/status.js`:

```````js
document.addEventListener('DOMContentLoaded', function() {
    const statusForm = document.getElementById('status-form');
    const statusInput = document.getElementById('status-input');
    const currentStatus = document.getElementById('current-status');
    const removeStatusBtn = document.getElementById('remove-status-btn');

    statusForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const newStatus = statusInput.value.trim();
        updateStatus(newStatus);
    });

    removeStatusBtn.addEventListener('click', function(e) {
        e.preventDefault();
        updateStatus('');
    });

    function updateStatus(status) {
        fetch('/update_status', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (status === '') {
                    currentStatus.textContent = 'No status set';
                    currentStatus.classList.add('text-gray-500');
                } else {
                    currentStatus.textContent = status;
                    currentStatus.classList.remove('text-gray-500');
                }
                statusInput.value = '';
                updateRemoveButtonVisibility();
            } else {
                alert('Failed to update status. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating status.');
        });
    }

    function updateRemoveButtonVisibility() {
        if (currentStatus.textContent === 'No status set') {
            removeStatusBtn.classList.add('hidden');
        } else {
            removeStatusBtn.classList.remove('hidden');
        }
    }

    // Initial call to set the correct visibility of the remove button
    // updateRemoveButtonVisibility();
});
```````

`/home/ramees/progs/php/sora/public/js/follow.js`:

```````js
document.addEventListener('DOMContentLoaded', function() {
    const followedUsersList = document.getElementById('followed-users-list');
    const searchInput = document.getElementById('user-search');
    const searchResults = document.getElementById('search-results');
    const followersUsersList = document.getElementById('followers-users-list');

    // Load followed users and followers
    loadFollowedUsers();
    loadFollowersUsers();

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

    // Function to load followers
    function loadFollowersUsers() {
        fetch('/get_followers_users')
            .then(response => response.json())
            .then(users => {
                followersUsersList.innerHTML = '';
                users.forEach(user => {
                    followersUsersList.appendChild(createUserListItem(user, user.isFollowing));
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
        
        const statusHtml = user.status ? `<p class="text-xs text-gray-500">${user.status}</p>` : '';
        
        li.innerHTML = `
            <div class="flex items-center space-x-3">
                <img src="${user.profile_picture || '/images/icons/user-avatar.png'}" alt="${user.username}" class="w-10 h-10 rounded-full">
                <div>
                    <a href="/profile/${user.username}" class="font-medium">${user.username}</a>
                    ${statusHtml}
                </div>
            </div>
            <button class="follow-btn px-2 py-1 rounded-full text-sm font-medium ${isFollowed ? 'bg-gray-200 text-gray-800' : 'bg-blue-500 text-white'}" data-user-id="${user.id}">
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
                // Refresh the followed users list and followers list
                loadFollowedUsers();
                loadFollowersUsers();
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
```````

`/home/ramees/progs/php/sora/public/js/mobile-nav.js`:

```````js
// mobile-nav.js

document.addEventListener('DOMContentLoaded', function() {
    // Get DOM elements
    const hamburgerBtn = document.querySelector('[aria-label="Menu"]');
    const aside = document.querySelector('aside');
    
    // Create navigation links array - add your actual nav links here
    const navigationLinks = [
        { text: 'Home', href: '/', icon: 'home' },
        { text: 'Profile', href: '/profile', icon: 'user' },
        {text: 'Spaces', href: '/spaces', icon: 'globe'},
        { text: 'Messages', href: '/messages', icon: 'message-circle' },
        { text: 'Settings', href: '/settings', icon: 'settings' }
    ];

    // Create mobile menu container
    const mobileMenuDiv = document.createElement('div');
    mobileMenuDiv.className = 'mobile-menu-container fixed top-[64px] left-0 right-0 bottom-0 z-40 hidden bg-gray-100 overflow-y-auto';
    document.body.appendChild(mobileMenuDiv);

    // Track menu state
    let isMenuOpen = false;

    // Function to create navigation links
    function createNavLinks() {
        const navContainer = document.createElement('div');
        navContainer.className = 'nav-links-mobile flex flex-col w-full p-4 bg-gray-200 rounded-lg';
        
        navigationLinks.forEach(link => {
            const anchor = document.createElement('a');
            anchor.href = link.href;
            anchor.className = 'w-full text-left px-4 py-3 text-lg font-medium hover:bg-gray-300 rounded-md transition-colors flex items-center gap-2';
            
            // Add icon (using Heroicons or your preferred icon set)
            anchor.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${getIconPath(link.icon)}" />
                </svg>
                ${link.text}
            `;
            
            navContainer.appendChild(anchor);
        });
        
        return navContainer;
    }

    // Helper function to get icon paths
    function getIconPath(icon) {
        const paths = {
            'home': 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
            'user': 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
            'message-circle': 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z',
            'settings': 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z',
            'globe' : 'M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418'
        };
        return paths[icon] || paths['home'];
    }

    // Function to prepare aside content for mobile
    function prepareAsideContent() {
        const mobileAside = aside.cloneNode(true);
        mobileAside.classList.remove('hidden', 'md:block', 'w-72');
        mobileAside.classList.add('w-full', 'border-t', 'border-gray-200', 'mt-4');
        return mobileAside;
    }

    // Toggle menu function
    function toggleMenu() {
        isMenuOpen = !isMenuOpen;
        const mobileMenuContainer = document.querySelector('.mobile-menu-container');
        
        if (isMenuOpen) {
            // Clear and prepare mobile menu content
            mobileMenuContainer.innerHTML = `
                <div class="flex flex-col h-full overflow-y-auto pb-20">
                    <div class="sticky top-0 bg-gray-100 p-4 shadow-sm">
                        <button class="mobile-menu-close ml-auto flex items-center justify-center w-8 h-8 rounded-full bg-gray-200 hover:bg-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="px-4 py-2">
                        <div class="nav-section"></div>
                        <div class="aside-section"></div>
                    </div>
                </div>
            `;

            // Add nav links
            const navLinks = createNavLinks();
            mobileMenuContainer.querySelector('.nav-section').appendChild(navLinks);

            // Add aside content
            try{
            const asideContent = prepareAsideContent();
            mobileMenuContainer.querySelector('.aside-section').appendChild(asideContent);
            }
            catch{
                console.log("not in homepage");
            }

            // Show menu
            mobileMenuContainer.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            // Add close button listener
            mobileMenuContainer.querySelector('.mobile-menu-close').addEventListener('click', toggleMenu);
        } else {
            mobileMenuContainer.classList.add('hidden');
            document.body.style.overflow = '';
        }
        
        hamburgerBtn.setAttribute('aria-expanded', isMenuOpen);
    }

    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        const mobileMenuContainer = document.querySelector('.mobile-menu-container');
        const isClickInsideMenu = mobileMenuContainer && mobileMenuContainer.contains(event.target);
        const isClickOnHamburger = hamburgerBtn && hamburgerBtn.contains(event.target);
        
        if (isMenuOpen && !isClickInsideMenu && !isClickOnHamburger) {
            toggleMenu();
        }
    });

    // Add resize listener
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768 && isMenuOpen) {
            toggleMenu();
        }
    });

    // Initialize hamburger button click handler
    if (hamburgerBtn) {
        hamburgerBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleMenu();
        });
    }

    // Handle escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && isMenuOpen) {
            toggleMenu();
        }
    });

    // Add styles
    const styleSheet = document.createElement('style');
    styleSheet.textContent = `
        .mobile-menu-container {
            transition: transform 0.3s ease-out;
            height: calc(100vh - 64px);
        }
        
        .mobile-menu-container:not(.hidden) {
            animation: slideIn 0.3s ease-out;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .nav-links-mobile a:active {
            background-color: #e5e7eb;
        }

        .mobile-menu-container {
            scrollbar-width: thin;
            scrollbar-color: #CBD5E0 #EDF2F7;
        }

        .mobile-menu-container::-webkit-scrollbar {
            width: 8px;
        }

        .mobile-menu-container::-webkit-scrollbar-track {
            background: #EDF2F7;
        }

        .mobile-menu-container::-webkit-scrollbar-thumb {
            background-color: #CBD5E0;
            border-radius: 4px;
            border: 2px solid #EDF2F7;
        }
    `;
    document.head.appendChild(styleSheet);
});
```````

`/home/ramees/progs/php/sora/public/css/imports.css`:

```````css
@tailwind base;
@tailwind components;
@tailwind utilities;

*{
    margin: 0;
    padding:0;
    box-sizing: border-box;
}
```````

`/home/ramees/progs/php/sora/public/css/styles.css`:

```````css
*, ::before, ::after {
  --tw-border-spacing-x: 0;
  --tw-border-spacing-y: 0;
  --tw-translate-x: 0;
  --tw-translate-y: 0;
  --tw-rotate: 0;
  --tw-skew-x: 0;
  --tw-skew-y: 0;
  --tw-scale-x: 1;
  --tw-scale-y: 1;
  --tw-pan-x:  ;
  --tw-pan-y:  ;
  --tw-pinch-zoom:  ;
  --tw-scroll-snap-strictness: proximity;
  --tw-gradient-from-position:  ;
  --tw-gradient-via-position:  ;
  --tw-gradient-to-position:  ;
  --tw-ordinal:  ;
  --tw-slashed-zero:  ;
  --tw-numeric-figure:  ;
  --tw-numeric-spacing:  ;
  --tw-numeric-fraction:  ;
  --tw-ring-inset:  ;
  --tw-ring-offset-width: 0px;
  --tw-ring-offset-color: #fff;
  --tw-ring-color: rgb(59 130 246 / 0.5);
  --tw-ring-offset-shadow: 0 0 #0000;
  --tw-ring-shadow: 0 0 #0000;
  --tw-shadow: 0 0 #0000;
  --tw-shadow-colored: 0 0 #0000;
  --tw-blur:  ;
  --tw-brightness:  ;
  --tw-contrast:  ;
  --tw-grayscale:  ;
  --tw-hue-rotate:  ;
  --tw-invert:  ;
  --tw-saturate:  ;
  --tw-sepia:  ;
  --tw-drop-shadow:  ;
  --tw-backdrop-blur:  ;
  --tw-backdrop-brightness:  ;
  --tw-backdrop-contrast:  ;
  --tw-backdrop-grayscale:  ;
  --tw-backdrop-hue-rotate:  ;
  --tw-backdrop-invert:  ;
  --tw-backdrop-opacity:  ;
  --tw-backdrop-saturate:  ;
  --tw-backdrop-sepia:  ;
  --tw-contain-size:  ;
  --tw-contain-layout:  ;
  --tw-contain-paint:  ;
  --tw-contain-style:  ;
}

::backdrop {
  --tw-border-spacing-x: 0;
  --tw-border-spacing-y: 0;
  --tw-translate-x: 0;
  --tw-translate-y: 0;
  --tw-rotate: 0;
  --tw-skew-x: 0;
  --tw-skew-y: 0;
  --tw-scale-x: 1;
  --tw-scale-y: 1;
  --tw-pan-x:  ;
  --tw-pan-y:  ;
  --tw-pinch-zoom:  ;
  --tw-scroll-snap-strictness: proximity;
  --tw-gradient-from-position:  ;
  --tw-gradient-via-position:  ;
  --tw-gradient-to-position:  ;
  --tw-ordinal:  ;
  --tw-slashed-zero:  ;
  --tw-numeric-figure:  ;
  --tw-numeric-spacing:  ;
  --tw-numeric-fraction:  ;
  --tw-ring-inset:  ;
  --tw-ring-offset-width: 0px;
  --tw-ring-offset-color: #fff;
  --tw-ring-color: rgb(59 130 246 / 0.5);
  --tw-ring-offset-shadow: 0 0 #0000;
  --tw-ring-shadow: 0 0 #0000;
  --tw-shadow: 0 0 #0000;
  --tw-shadow-colored: 0 0 #0000;
  --tw-blur:  ;
  --tw-brightness:  ;
  --tw-contrast:  ;
  --tw-grayscale:  ;
  --tw-hue-rotate:  ;
  --tw-invert:  ;
  --tw-saturate:  ;
  --tw-sepia:  ;
  --tw-drop-shadow:  ;
  --tw-backdrop-blur:  ;
  --tw-backdrop-brightness:  ;
  --tw-backdrop-contrast:  ;
  --tw-backdrop-grayscale:  ;
  --tw-backdrop-hue-rotate:  ;
  --tw-backdrop-invert:  ;
  --tw-backdrop-opacity:  ;
  --tw-backdrop-saturate:  ;
  --tw-backdrop-sepia:  ;
  --tw-contain-size:  ;
  --tw-contain-layout:  ;
  --tw-contain-paint:  ;
  --tw-contain-style:  ;
}

/*
! tailwindcss v3.4.14 | MIT License | https://tailwindcss.com
*/

/*
1. Prevent padding and border from affecting element width. (https://github.com/mozdevs/cssremedy/issues/4)
2. Allow adding a border to an element by just adding a border-width. (https://github.com/tailwindcss/tailwindcss/pull/116)
*/

*,
::before,
::after {
  box-sizing: border-box;
  /* 1 */
  border-width: 0;
  /* 2 */
  border-style: solid;
  /* 2 */
  border-color: #e5e7eb;
  /* 2 */
}

::before,
::after {
  --tw-content: '';
}

/*
1. Use a consistent sensible line-height in all browsers.
2. Prevent adjustments of font size after orientation changes in iOS.
3. Use a more readable tab size.
4. Use the user's configured `sans` font-family by default.
5. Use the user's configured `sans` font-feature-settings by default.
6. Use the user's configured `sans` font-variation-settings by default.
7. Disable tap highlights on iOS
*/

html,
:host {
  line-height: 1.5;
  /* 1 */
  -webkit-text-size-adjust: 100%;
  /* 2 */
  -moz-tab-size: 4;
  /* 3 */
  -o-tab-size: 4;
     tab-size: 4;
  /* 3 */
  font-family: ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  /* 4 */
  font-feature-settings: normal;
  /* 5 */
  font-variation-settings: normal;
  /* 6 */
  -webkit-tap-highlight-color: transparent;
  /* 7 */
}

/*
1. Remove the margin in all browsers.
2. Inherit line-height from `html` so users can set them as a class directly on the `html` element.
*/

body {
  margin: 0;
  /* 1 */
  line-height: inherit;
  /* 2 */
}

/*
1. Add the correct height in Firefox.
2. Correct the inheritance of border color in Firefox. (https://bugzilla.mozilla.org/show_bug.cgi?id=190655)
3. Ensure horizontal rules are visible by default.
*/

hr {
  height: 0;
  /* 1 */
  color: inherit;
  /* 2 */
  border-top-width: 1px;
  /* 3 */
}

/*
Add the correct text decoration in Chrome, Edge, and Safari.
*/

abbr:where([title]) {
  -webkit-text-decoration: underline dotted;
          text-decoration: underline dotted;
}

/*
Remove the default font size and weight for headings.
*/

h1,
h2,
h3,
h4,
h5,
h6 {
  font-size: inherit;
  font-weight: inherit;
}

/*
Reset links to optimize for opt-in styling instead of opt-out.
*/

a {
  color: inherit;
  text-decoration: inherit;
}

/*
Add the correct font weight in Edge and Safari.
*/

b,
strong {
  font-weight: bolder;
}

/*
1. Use the user's configured `mono` font-family by default.
2. Use the user's configured `mono` font-feature-settings by default.
3. Use the user's configured `mono` font-variation-settings by default.
4. Correct the odd `em` font sizing in all browsers.
*/

code,
kbd,
samp,
pre {
  font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
  /* 1 */
  font-feature-settings: normal;
  /* 2 */
  font-variation-settings: normal;
  /* 3 */
  font-size: 1em;
  /* 4 */
}

/*
Add the correct font size in all browsers.
*/

small {
  font-size: 80%;
}

/*
Prevent `sub` and `sup` elements from affecting the line height in all browsers.
*/

sub,
sup {
  font-size: 75%;
  line-height: 0;
  position: relative;
  vertical-align: baseline;
}

sub {
  bottom: -0.25em;
}

sup {
  top: -0.5em;
}

/*
1. Remove text indentation from table contents in Chrome and Safari. (https://bugs.chromium.org/p/chromium/issues/detail?id=999088, https://bugs.webkit.org/show_bug.cgi?id=201297)
2. Correct table border color inheritance in all Chrome and Safari. (https://bugs.chromium.org/p/chromium/issues/detail?id=935729, https://bugs.webkit.org/show_bug.cgi?id=195016)
3. Remove gaps between table borders by default.
*/

table {
  text-indent: 0;
  /* 1 */
  border-color: inherit;
  /* 2 */
  border-collapse: collapse;
  /* 3 */
}

/*
1. Change the font styles in all browsers.
2. Remove the margin in Firefox and Safari.
3. Remove default padding in all browsers.
*/

button,
input,
optgroup,
select,
textarea {
  font-family: inherit;
  /* 1 */
  font-feature-settings: inherit;
  /* 1 */
  font-variation-settings: inherit;
  /* 1 */
  font-size: 100%;
  /* 1 */
  font-weight: inherit;
  /* 1 */
  line-height: inherit;
  /* 1 */
  letter-spacing: inherit;
  /* 1 */
  color: inherit;
  /* 1 */
  margin: 0;
  /* 2 */
  padding: 0;
  /* 3 */
}

/*
Remove the inheritance of text transform in Edge and Firefox.
*/

button,
select {
  text-transform: none;
}

/*
1. Correct the inability to style clickable types in iOS and Safari.
2. Remove default button styles.
*/

button,
input:where([type='button']),
input:where([type='reset']),
input:where([type='submit']) {
  -webkit-appearance: button;
  /* 1 */
  background-color: transparent;
  /* 2 */
  background-image: none;
  /* 2 */
}

/*
Use the modern Firefox focus style for all focusable elements.
*/

:-moz-focusring {
  outline: auto;
}

/*
Remove the additional `:invalid` styles in Firefox. (https://github.com/mozilla/gecko-dev/blob/2f9eacd9d3d995c937b4251a5557d95d494c9be1/layout/style/res/forms.css#L728-L737)
*/

:-moz-ui-invalid {
  box-shadow: none;
}

/*
Add the correct vertical alignment in Chrome and Firefox.
*/

progress {
  vertical-align: baseline;
}

/*
Correct the cursor style of increment and decrement buttons in Safari.
*/

::-webkit-inner-spin-button,
::-webkit-outer-spin-button {
  height: auto;
}

/*
1. Correct the odd appearance in Chrome and Safari.
2. Correct the outline style in Safari.
*/

[type='search'] {
  -webkit-appearance: textfield;
  /* 1 */
  outline-offset: -2px;
  /* 2 */
}

/*
Remove the inner padding in Chrome and Safari on macOS.
*/

::-webkit-search-decoration {
  -webkit-appearance: none;
}

/*
1. Correct the inability to style clickable types in iOS and Safari.
2. Change font properties to `inherit` in Safari.
*/

::-webkit-file-upload-button {
  -webkit-appearance: button;
  /* 1 */
  font: inherit;
  /* 2 */
}

/*
Add the correct display in Chrome and Safari.
*/

summary {
  display: list-item;
}

/*
Removes the default spacing and border for appropriate elements.
*/

blockquote,
dl,
dd,
h1,
h2,
h3,
h4,
h5,
h6,
hr,
figure,
p,
pre {
  margin: 0;
}

fieldset {
  margin: 0;
  padding: 0;
}

legend {
  padding: 0;
}

ol,
ul,
menu {
  list-style: none;
  margin: 0;
  padding: 0;
}

/*
Reset default styling for dialogs.
*/

dialog {
  padding: 0;
}

/*
Prevent resizing textareas horizontally by default.
*/

textarea {
  resize: vertical;
}

/*
1. Reset the default placeholder opacity in Firefox. (https://github.com/tailwindlabs/tailwindcss/issues/3300)
2. Set the default placeholder color to the user's configured gray 400 color.
*/

input::-moz-placeholder, textarea::-moz-placeholder {
  opacity: 1;
  /* 1 */
  color: #9ca3af;
  /* 2 */
}

input::placeholder,
textarea::placeholder {
  opacity: 1;
  /* 1 */
  color: #9ca3af;
  /* 2 */
}

/*
Set the default cursor for buttons.
*/

button,
[role="button"] {
  cursor: pointer;
}

/*
Make sure disabled buttons don't get the pointer cursor.
*/

:disabled {
  cursor: default;
}

/*
1. Make replaced elements `display: block` by default. (https://github.com/mozdevs/cssremedy/issues/14)
2. Add `vertical-align: middle` to align replaced elements more sensibly by default. (https://github.com/jensimmons/cssremedy/issues/14#issuecomment-634934210)
   This can trigger a poorly considered lint error in some tools but is included by design.
*/

img,
svg,
video,
canvas,
audio,
iframe,
embed,
object {
  display: block;
  /* 1 */
  vertical-align: middle;
  /* 2 */
}

/*
Constrain images and videos to the parent width and preserve their intrinsic aspect ratio. (https://github.com/mozdevs/cssremedy/issues/14)
*/

img,
video {
  max-width: 100%;
  height: auto;
}

/* Make elements with the HTML hidden attribute stay hidden by default */

[hidden]:where(:not([hidden="until-found"])) {
  display: none;
}

.container {
  width: 100%;
}

@media (min-width: 640px) {
  .container {
    max-width: 640px;
  }
}

@media (min-width: 768px) {
  .container {
    max-width: 768px;
  }
}

@media (min-width: 1024px) {
  .container {
    max-width: 1024px;
  }
}

@media (min-width: 1280px) {
  .container {
    max-width: 1280px;
  }
}

@media (min-width: 1536px) {
  .container {
    max-width: 1536px;
  }
}

.visible {
  visibility: visible;
}

.collapse {
  visibility: collapse;
}

.static {
  position: static;
}

.fixed {
  position: fixed;
}

.absolute {
  position: absolute;
}

.relative {
  position: relative;
}

.sticky {
  position: sticky;
}

.-right-2 {
  right: -0.5rem;
}

.-top-2 {
  top: -0.5rem;
}

.-top-2\.5 {
  top: -0.625rem;
}

.bottom-0 {
  bottom: 0px;
}

.bottom-3 {
  bottom: 0.75rem;
}

.left-0 {
  left: 0px;
}

.left-2 {
  left: 0.5rem;
}

.right-0 {
  right: 0px;
}

.right-3 {
  right: 0.75rem;
}

.top-0 {
  top: 0px;
}

.top-10 {
  top: 2.5rem;
}

.top-\[64px\] {
  top: 64px;
}

.z-40 {
  z-index: 40;
}

.m-2 {
  margin: 0.5rem;
}

.mx-auto {
  margin-left: auto;
  margin-right: auto;
}

.-mb-px {
  margin-bottom: -1px;
}

.mb-2 {
  margin-bottom: 0.5rem;
}

.mb-3 {
  margin-bottom: 0.75rem;
}

.mb-4 {
  margin-bottom: 1rem;
}

.mb-6 {
  margin-bottom: 1.5rem;
}

.mb-8 {
  margin-bottom: 2rem;
}

.ml-2 {
  margin-left: 0.5rem;
}

.ml-auto {
  margin-left: auto;
}

.mr-1 {
  margin-right: 0.25rem;
}

.mr-2 {
  margin-right: 0.5rem;
}

.mr-3 {
  margin-right: 0.75rem;
}

.mt-1 {
  margin-top: 0.25rem;
}

.mt-2 {
  margin-top: 0.5rem;
}

.mt-3 {
  margin-top: 0.75rem;
}

.mt-4 {
  margin-top: 1rem;
}

.mt-8 {
  margin-top: 2rem;
}

.block {
  display: block;
}

.inline-block {
  display: inline-block;
}

.inline {
  display: inline;
}

.flex {
  display: flex;
}

.inline-flex {
  display: inline-flex;
}

.table {
  display: table;
}

.grid {
  display: grid;
}

.contents {
  display: contents;
}

.hidden {
  display: none;
}

.h-10 {
  height: 2.5rem;
}

.h-12 {
  height: 3rem;
}

.h-24 {
  height: 6rem;
}

.h-4 {
  height: 1rem;
}

.h-5 {
  height: 1.25rem;
}

.h-8 {
  height: 2rem;
}

.h-96 {
  height: 24rem;
}

.h-full {
  height: 100%;
}

.min-h-\[calc\(100vh-4rem\)\] {
  min-height: calc(100vh - 4rem);
}

.min-h-screen {
  min-height: 100vh;
}

.w-10 {
  width: 2.5rem;
}

.w-12 {
  width: 3rem;
}

.w-24 {
  width: 6rem;
}

.w-4 {
  width: 1rem;
}

.w-5 {
  width: 1.25rem;
}

.w-72 {
  width: 18rem;
}

.w-8 {
  width: 2rem;
}

.w-fit {
  width: -moz-fit-content;
  width: fit-content;
}

.w-full {
  width: 100%;
}

.w-max {
  width: -moz-max-content;
  width: max-content;
}

.max-w-3xl {
  max-width: 48rem;
}

.max-w-4xl {
  max-width: 56rem;
}

.max-w-md {
  max-width: 28rem;
}

.max-w-xs {
  max-width: 20rem;
}

.flex-1 {
  flex: 1 1 0%;
}

.flex-grow {
  flex-grow: 1;
}

.transform {
  transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
}

.cursor-pointer {
  cursor: pointer;
}

.resize-none {
  resize: none;
}

.resize {
  resize: both;
}

.appearance-none {
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
}

.grid-cols-1 {
  grid-template-columns: repeat(1, minmax(0, 1fr));
}

.flex-col {
  flex-direction: column;
}

.flex-col-reverse {
  flex-direction: column-reverse;
}

.items-start {
  align-items: flex-start;
}

.items-center {
  align-items: center;
}

.justify-center {
  justify-content: center;
}

.justify-between {
  justify-content: space-between;
}

.justify-around {
  justify-content: space-around;
}

.gap-2 {
  gap: 0.5rem;
}

.gap-3 {
  gap: 0.75rem;
}

.gap-4 {
  gap: 1rem;
}

.gap-6 {
  gap: 1.5rem;
}

.gap-7 {
  gap: 1.75rem;
}

.space-x-1 > :not([hidden]) ~ :not([hidden]) {
  --tw-space-x-reverse: 0;
  margin-right: calc(0.25rem * var(--tw-space-x-reverse));
  margin-left: calc(0.25rem * calc(1 - var(--tw-space-x-reverse)));
}

.space-x-2 > :not([hidden]) ~ :not([hidden]) {
  --tw-space-x-reverse: 0;
  margin-right: calc(0.5rem * var(--tw-space-x-reverse));
  margin-left: calc(0.5rem * calc(1 - var(--tw-space-x-reverse)));
}

.space-x-3 > :not([hidden]) ~ :not([hidden]) {
  --tw-space-x-reverse: 0;
  margin-right: calc(0.75rem * var(--tw-space-x-reverse));
  margin-left: calc(0.75rem * calc(1 - var(--tw-space-x-reverse)));
}

.space-x-4 > :not([hidden]) ~ :not([hidden]) {
  --tw-space-x-reverse: 0;
  margin-right: calc(1rem * var(--tw-space-x-reverse));
  margin-left: calc(1rem * calc(1 - var(--tw-space-x-reverse)));
}

.space-x-6 > :not([hidden]) ~ :not([hidden]) {
  --tw-space-x-reverse: 0;
  margin-right: calc(1.5rem * var(--tw-space-x-reverse));
  margin-left: calc(1.5rem * calc(1 - var(--tw-space-x-reverse)));
}

.space-x-8 > :not([hidden]) ~ :not([hidden]) {
  --tw-space-x-reverse: 0;
  margin-right: calc(2rem * var(--tw-space-x-reverse));
  margin-left: calc(2rem * calc(1 - var(--tw-space-x-reverse)));
}

.space-y-2 > :not([hidden]) ~ :not([hidden]) {
  --tw-space-y-reverse: 0;
  margin-top: calc(0.5rem * calc(1 - var(--tw-space-y-reverse)));
  margin-bottom: calc(0.5rem * var(--tw-space-y-reverse));
}

.space-y-3 > :not([hidden]) ~ :not([hidden]) {
  --tw-space-y-reverse: 0;
  margin-top: calc(0.75rem * calc(1 - var(--tw-space-y-reverse)));
  margin-bottom: calc(0.75rem * var(--tw-space-y-reverse));
}

.space-y-4 > :not([hidden]) ~ :not([hidden]) {
  --tw-space-y-reverse: 0;
  margin-top: calc(1rem * calc(1 - var(--tw-space-y-reverse)));
  margin-bottom: calc(1rem * var(--tw-space-y-reverse));
}

.space-y-reverse > :not([hidden]) ~ :not([hidden]) {
  --tw-space-y-reverse: 1;
}

.self-end {
  align-self: flex-end;
}

.justify-self-end {
  justify-self: end;
}

.overflow-auto {
  overflow: auto;
}

.overflow-hidden {
  overflow: hidden;
}

.overflow-y-auto {
  overflow-y: auto;
}

.truncate {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.rounded {
  border-radius: 0.25rem;
}

.rounded-full {
  border-radius: 9999px;
}

.rounded-lg {
  border-radius: 0.5rem;
}

.rounded-md {
  border-radius: 0.375rem;
}

.rounded-xl {
  border-radius: 0.75rem;
}

.rounded-l {
  border-top-left-radius: 0.25rem;
  border-bottom-left-radius: 0.25rem;
}

.rounded-l-md {
  border-top-left-radius: 0.375rem;
  border-bottom-left-radius: 0.375rem;
}

.rounded-r {
  border-top-right-radius: 0.25rem;
  border-bottom-right-radius: 0.25rem;
}

.rounded-r-md {
  border-top-right-radius: 0.375rem;
  border-bottom-right-radius: 0.375rem;
}

.border {
  border-width: 1px;
}

.border-b {
  border-bottom-width: 1px;
}

.border-b-2 {
  border-bottom-width: 2px;
}

.border-t {
  border-top-width: 1px;
}

.border-blue-500 {
  --tw-border-opacity: 1;
  border-color: rgb(59 130 246 / var(--tw-border-opacity));
}

.border-gray-200 {
  --tw-border-opacity: 1;
  border-color: rgb(229 231 235 / var(--tw-border-opacity));
}

.border-red-400 {
  --tw-border-opacity: 1;
  border-color: rgb(248 113 113 / var(--tw-border-opacity));
}

.border-transparent {
  border-color: transparent;
}

.border-violet-600 {
  --tw-border-opacity: 1;
  border-color: rgb(124 58 237 / var(--tw-border-opacity));
}

.bg-black {
  --tw-bg-opacity: 1;
  background-color: rgb(0 0 0 / var(--tw-bg-opacity));
}

.bg-blue-500 {
  --tw-bg-opacity: 1;
  background-color: rgb(59 130 246 / var(--tw-bg-opacity));
}

.bg-blue-600 {
  --tw-bg-opacity: 1;
  background-color: rgb(37 99 235 / var(--tw-bg-opacity));
}

.bg-gray-100 {
  --tw-bg-opacity: 1;
  background-color: rgb(243 244 246 / var(--tw-bg-opacity));
}

.bg-gray-200 {
  --tw-bg-opacity: 1;
  background-color: rgb(229 231 235 / var(--tw-bg-opacity));
}

.bg-gray-300 {
  --tw-bg-opacity: 1;
  background-color: rgb(209 213 219 / var(--tw-bg-opacity));
}

.bg-gray-500 {
  --tw-bg-opacity: 1;
  background-color: rgb(107 114 128 / var(--tw-bg-opacity));
}

.bg-gray-600 {
  --tw-bg-opacity: 1;
  background-color: rgb(75 85 99 / var(--tw-bg-opacity));
}

.bg-green-500 {
  --tw-bg-opacity: 1;
  background-color: rgb(34 197 94 / var(--tw-bg-opacity));
}

.bg-indigo-600 {
  --tw-bg-opacity: 1;
  background-color: rgb(79 70 229 / var(--tw-bg-opacity));
}

.bg-red-100 {
  --tw-bg-opacity: 1;
  background-color: rgb(254 226 226 / var(--tw-bg-opacity));
}

.bg-red-500 {
  --tw-bg-opacity: 1;
  background-color: rgb(239 68 68 / var(--tw-bg-opacity));
}

.bg-slate-200 {
  --tw-bg-opacity: 1;
  background-color: rgb(226 232 240 / var(--tw-bg-opacity));
}

.bg-sora-bg {
  --tw-bg-opacity: 1;
  background-color: rgb(243 244 246 / var(--tw-bg-opacity));
}

.bg-sora-primary {
  --tw-bg-opacity: 1;
  background-color: rgb(79 70 229 / var(--tw-bg-opacity));
}

.bg-sora-secondary {
  --tw-bg-opacity: 1;
  background-color: rgb(129 140 248 / var(--tw-bg-opacity));
}

.bg-violet-600 {
  --tw-bg-opacity: 1;
  background-color: rgb(124 58 237 / var(--tw-bg-opacity));
}

.bg-white {
  --tw-bg-opacity: 1;
  background-color: rgb(255 255 255 / var(--tw-bg-opacity));
}

.bg-yellow-500 {
  --tw-bg-opacity: 1;
  background-color: rgb(234 179 8 / var(--tw-bg-opacity));
}

.bg-opacity-90 {
  --tw-bg-opacity: 0.9;
}

.bg-gradient-to-r {
  background-image: linear-gradient(to right, var(--tw-gradient-stops));
}

.from-sora-primary {
  --tw-gradient-from: #4F46E5 var(--tw-gradient-from-position);
  --tw-gradient-to: rgb(79 70 229 / 0) var(--tw-gradient-to-position);
  --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
}

.to-sora-secondary {
  --tw-gradient-to: #818CF8 var(--tw-gradient-to-position);
}

.bg-center {
  background-position: center;
}

.bg-no-repeat {
  background-repeat: no-repeat;
}

.object-cover {
  -o-object-fit: cover;
     object-fit: cover;
}

.p-1 {
  padding: 0.25rem;
}

.p-2 {
  padding: 0.5rem;
}

.p-3 {
  padding: 0.75rem;
}

.p-4 {
  padding: 1rem;
}

.p-6 {
  padding: 1.5rem;
}

.px-1 {
  padding-left: 0.25rem;
  padding-right: 0.25rem;
}

.px-2 {
  padding-left: 0.5rem;
  padding-right: 0.5rem;
}

.px-3 {
  padding-left: 0.75rem;
  padding-right: 0.75rem;
}

.px-4 {
  padding-left: 1rem;
  padding-right: 1rem;
}

.px-6 {
  padding-left: 1.5rem;
  padding-right: 1.5rem;
}

.px-8 {
  padding-left: 2rem;
  padding-right: 2rem;
}

.py-1 {
  padding-top: 0.25rem;
  padding-bottom: 0.25rem;
}

.py-12 {
  padding-top: 3rem;
  padding-bottom: 3rem;
}

.py-2 {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
}

.py-3 {
  padding-top: 0.75rem;
  padding-bottom: 0.75rem;
}

.py-4 {
  padding-top: 1rem;
  padding-bottom: 1rem;
}

.py-8 {
  padding-top: 2rem;
  padding-bottom: 2rem;
}

.pb-20 {
  padding-bottom: 5rem;
}

.pb-4 {
  padding-bottom: 1rem;
}

.pb-8 {
  padding-bottom: 2rem;
}

.pr-12 {
  padding-right: 3rem;
}

.pt-3 {
  padding-top: 0.75rem;
}

.pt-6 {
  padding-top: 1.5rem;
}

.text-left {
  text-align: left;
}

.text-center {
  text-align: center;
}

.text-right {
  text-align: right;
}

.text-2xl {
  font-size: 1.5rem;
  line-height: 2rem;
}

.text-3xl {
  font-size: 1.875rem;
  line-height: 2.25rem;
}

.text-8xl {
  font-size: 6rem;
  line-height: 1;
}

.text-\[1\.16em\] {
  font-size: 1.16em;
}

.text-lg {
  font-size: 1.125rem;
  line-height: 1.75rem;
}

.text-sm {
  font-size: 0.875rem;
  line-height: 1.25rem;
}

.text-xl {
  font-size: 1.25rem;
  line-height: 1.75rem;
}

.text-xs {
  font-size: 0.75rem;
  line-height: 1rem;
}

.font-bold {
  font-weight: 700;
}

.font-medium {
  font-weight: 500;
}

.font-semibold {
  font-weight: 600;
}

.uppercase {
  text-transform: uppercase;
}

.lowercase {
  text-transform: lowercase;
}

.ordinal {
  --tw-ordinal: ordinal;
  font-variant-numeric: var(--tw-ordinal) var(--tw-slashed-zero) var(--tw-numeric-figure) var(--tw-numeric-spacing) var(--tw-numeric-fraction);
}

.leading-tight {
  line-height: 1.25;
}

.text-blue-200 {
  --tw-text-opacity: 1;
  color: rgb(191 219 254 / var(--tw-text-opacity));
}

.text-blue-500 {
  --tw-text-opacity: 1;
  color: rgb(59 130 246 / var(--tw-text-opacity));
}

.text-blue-600 {
  --tw-text-opacity: 1;
  color: rgb(37 99 235 / var(--tw-text-opacity));
}

.text-gray-200 {
  --tw-text-opacity: 1;
  color: rgb(229 231 235 / var(--tw-text-opacity));
}

.text-gray-400 {
  --tw-text-opacity: 1;
  color: rgb(156 163 175 / var(--tw-text-opacity));
}

.text-gray-500 {
  --tw-text-opacity: 1;
  color: rgb(107 114 128 / var(--tw-text-opacity));
}

.text-gray-600 {
  --tw-text-opacity: 1;
  color: rgb(75 85 99 / var(--tw-text-opacity));
}

.text-gray-700 {
  --tw-text-opacity: 1;
  color: rgb(55 65 81 / var(--tw-text-opacity));
}

.text-gray-800 {
  --tw-text-opacity: 1;
  color: rgb(31 41 55 / var(--tw-text-opacity));
}

.text-gray-900 {
  --tw-text-opacity: 1;
  color: rgb(17 24 39 / var(--tw-text-opacity));
}

.text-red-500 {
  --tw-text-opacity: 1;
  color: rgb(239 68 68 / var(--tw-text-opacity));
}

.text-red-600 {
  --tw-text-opacity: 1;
  color: rgb(220 38 38 / var(--tw-text-opacity));
}

.text-red-700 {
  --tw-text-opacity: 1;
  color: rgb(185 28 28 / var(--tw-text-opacity));
}

.text-slate-900 {
  --tw-text-opacity: 1;
  color: rgb(15 23 42 / var(--tw-text-opacity));
}

.text-sora-primary {
  --tw-text-opacity: 1;
  color: rgb(79 70 229 / var(--tw-text-opacity));
}

.text-sora-secondary {
  --tw-text-opacity: 1;
  color: rgb(129 140 248 / var(--tw-text-opacity));
}

.text-sora-text {
  --tw-text-opacity: 1;
  color: rgb(31 41 55 / var(--tw-text-opacity));
}

.text-violet-600 {
  --tw-text-opacity: 1;
  color: rgb(124 58 237 / var(--tw-text-opacity));
}

.text-white {
  --tw-text-opacity: 1;
  color: rgb(255 255 255 / var(--tw-text-opacity));
}

.underline {
  text-decoration-line: underline;
}

.placeholder-gray-500::-moz-placeholder {
  --tw-placeholder-opacity: 1;
  color: rgb(107 114 128 / var(--tw-placeholder-opacity));
}

.placeholder-gray-500::placeholder {
  --tw-placeholder-opacity: 1;
  color: rgb(107 114 128 / var(--tw-placeholder-opacity));
}

.opacity-95 {
  opacity: 0.95;
}

.shadow {
  --tw-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
  --tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color);
  box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
}

.shadow-lg {
  --tw-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
  --tw-shadow-colored: 0 10px 15px -3px var(--tw-shadow-color), 0 4px 6px -4px var(--tw-shadow-color);
  box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
}

.shadow-md {
  --tw-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
  --tw-shadow-colored: 0 4px 6px -1px var(--tw-shadow-color), 0 2px 4px -2px var(--tw-shadow-color);
  box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
}

.shadow-sm {
  --tw-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
  --tw-shadow-colored: 0 1px 2px 0 var(--tw-shadow-color);
  box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
}

.outline-none {
  outline: 2px solid transparent;
  outline-offset: 2px;
}

.outline {
  outline-style: solid;
}

.blur {
  --tw-blur: blur(8px);
  filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow);
}

.invert {
  --tw-invert: invert(100%);
  filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow);
}

.filter {
  filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow);
}

.transition {
  transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, -webkit-backdrop-filter;
  transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
  transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter, -webkit-backdrop-filter;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
  transition-duration: 150ms;
}

.transition-all {
  transition-property: all;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
  transition-duration: 150ms;
}

.transition-colors {
  transition-property: color, background-color, border-color, text-decoration-color, fill, stroke;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
  transition-duration: 150ms;
}

.transition-shadow {
  transition-property: box-shadow;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
  transition-duration: 150ms;
}

.duration-200 {
  transition-duration: 200ms;
}

.duration-300 {
  transition-duration: 300ms;
}

*{
  margin: 0;
  padding:0;
  box-sizing: border-box;
}

.hover\:scale-105:hover {
  --tw-scale-x: 1.05;
  --tw-scale-y: 1.05;
  transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
}

.hover\:border-gray-300:hover {
  --tw-border-opacity: 1;
  border-color: rgb(209 213 219 / var(--tw-border-opacity));
}

.hover\:bg-blue-600:hover {
  --tw-bg-opacity: 1;
  background-color: rgb(37 99 235 / var(--tw-bg-opacity));
}

.hover\:bg-blue-700:hover {
  --tw-bg-opacity: 1;
  background-color: rgb(29 78 216 / var(--tw-bg-opacity));
}

.hover\:bg-gray-100:hover {
  --tw-bg-opacity: 1;
  background-color: rgb(243 244 246 / var(--tw-bg-opacity));
}

.hover\:bg-gray-300:hover {
  --tw-bg-opacity: 1;
  background-color: rgb(209 213 219 / var(--tw-bg-opacity));
}

.hover\:bg-gray-600:hover {
  --tw-bg-opacity: 1;
  background-color: rgb(75 85 99 / var(--tw-bg-opacity));
}

.hover\:bg-gray-700:hover {
  --tw-bg-opacity: 1;
  background-color: rgb(55 65 81 / var(--tw-bg-opacity));
}

.hover\:bg-green-600:hover {
  --tw-bg-opacity: 1;
  background-color: rgb(22 163 74 / var(--tw-bg-opacity));
}

.hover\:bg-green-700:hover {
  --tw-bg-opacity: 1;
  background-color: rgb(21 128 61 / var(--tw-bg-opacity));
}

.hover\:bg-indigo-700:hover {
  --tw-bg-opacity: 1;
  background-color: rgb(67 56 202 / var(--tw-bg-opacity));
}

.hover\:bg-red-600:hover {
  --tw-bg-opacity: 1;
  background-color: rgb(220 38 38 / var(--tw-bg-opacity));
}

.hover\:bg-red-700:hover {
  --tw-bg-opacity: 1;
  background-color: rgb(185 28 28 / var(--tw-bg-opacity));
}

.hover\:bg-sora-secondary:hover {
  --tw-bg-opacity: 1;
  background-color: rgb(129 140 248 / var(--tw-bg-opacity));
}

.hover\:bg-violet-50:hover {
  --tw-bg-opacity: 1;
  background-color: rgb(245 243 255 / var(--tw-bg-opacity));
}

.hover\:bg-violet-700:hover {
  --tw-bg-opacity: 1;
  background-color: rgb(109 40 217 / var(--tw-bg-opacity));
}

.hover\:bg-white:hover {
  --tw-bg-opacity: 1;
  background-color: rgb(255 255 255 / var(--tw-bg-opacity));
}

.hover\:bg-yellow-600:hover {
  --tw-bg-opacity: 1;
  background-color: rgb(202 138 4 / var(--tw-bg-opacity));
}

.hover\:text-blue-500:hover {
  --tw-text-opacity: 1;
  color: rgb(59 130 246 / var(--tw-text-opacity));
}

.hover\:text-gray-700:hover {
  --tw-text-opacity: 1;
  color: rgb(55 65 81 / var(--tw-text-opacity));
}

.hover\:text-green-500:hover {
  --tw-text-opacity: 1;
  color: rgb(34 197 94 / var(--tw-text-opacity));
}

.hover\:text-red-500:hover {
  --tw-text-opacity: 1;
  color: rgb(239 68 68 / var(--tw-text-opacity));
}

.hover\:text-red-700:hover {
  --tw-text-opacity: 1;
  color: rgb(185 28 28 / var(--tw-text-opacity));
}

.hover\:text-sora-bg:hover {
  --tw-text-opacity: 1;
  color: rgb(243 244 246 / var(--tw-text-opacity));
}

.hover\:text-sora-secondary:hover {
  --tw-text-opacity: 1;
  color: rgb(129 140 248 / var(--tw-text-opacity));
}

.hover\:underline:hover {
  text-decoration-line: underline;
}

.hover\:shadow-md:hover {
  --tw-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
  --tw-shadow-colored: 0 4px 6px -1px var(--tw-shadow-color), 0 2px 4px -2px var(--tw-shadow-color);
  box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
}

.focus\:border-transparent:focus {
  border-color: transparent;
}

.focus\:outline-none:focus {
  outline: 2px solid transparent;
  outline-offset: 2px;
}

.focus\:ring-2:focus {
  --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
  --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);
  box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
}

.focus\:ring-blue-500:focus {
  --tw-ring-opacity: 1;
  --tw-ring-color: rgb(59 130 246 / var(--tw-ring-opacity));
}

.focus\:ring-gray-200:focus {
  --tw-ring-opacity: 1;
  --tw-ring-color: rgb(229 231 235 / var(--tw-ring-opacity));
}

.focus\:ring-sora-bg:focus {
  --tw-ring-opacity: 1;
  --tw-ring-color: rgb(243 244 246 / var(--tw-ring-opacity));
}

.focus\:ring-violet-500:focus {
  --tw-ring-opacity: 1;
  --tw-ring-color: rgb(139 92 246 / var(--tw-ring-opacity));
}

.focus\:ring-offset-2:focus {
  --tw-ring-offset-width: 2px;
}

@media (min-width: 640px) {
  .sm\:flex {
    display: flex;
  }

  .sm\:w-\[90\%\] {
    width: 90%;
  }

  .sm\:w-auto {
    width: auto;
  }

  .sm\:w-max {
    width: -moz-max-content;
    width: max-content;
  }

  .sm\:grid-cols-2 {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }

  .sm\:flex-row {
    flex-direction: row;
  }

  .sm\:items-end {
    align-items: flex-end;
  }

  .sm\:items-center {
    align-items: center;
  }

  .sm\:justify-end {
    justify-content: flex-end;
  }

  .sm\:space-x-4 > :not([hidden]) ~ :not([hidden]) {
    --tw-space-x-reverse: 0;
    margin-right: calc(1rem * var(--tw-space-x-reverse));
    margin-left: calc(1rem * calc(1 - var(--tw-space-x-reverse)));
  }

  .sm\:space-x-6 > :not([hidden]) ~ :not([hidden]) {
    --tw-space-x-reverse: 0;
    margin-right: calc(1.5rem * var(--tw-space-x-reverse));
    margin-left: calc(1.5rem * calc(1 - var(--tw-space-x-reverse)));
  }

  .sm\:space-y-0 > :not([hidden]) ~ :not([hidden]) {
    --tw-space-y-reverse: 0;
    margin-top: calc(0px * calc(1 - var(--tw-space-y-reverse)));
    margin-bottom: calc(0px * var(--tw-space-y-reverse));
  }

  .sm\:overflow-y-auto {
    overflow-y: auto;
  }

  .sm\:p-8 {
    padding: 2rem;
  }

  .sm\:px-6 {
    padding-left: 1.5rem;
    padding-right: 1.5rem;
  }

  .sm\:text-3xl {
    font-size: 1.875rem;
    line-height: 2.25rem;
  }

  .sm\:text-xl {
    font-size: 1.25rem;
    line-height: 1.75rem;
  }
}

@media (min-width: 768px) {
  .md\:mx-0 {
    margin-left: 0px;
    margin-right: 0px;
  }

  .md\:mr-12 {
    margin-right: 3rem;
  }

  .md\:block {
    display: block;
  }

  .md\:flex {
    display: flex;
  }

  .md\:hidden {
    display: none;
  }

  .md\:w-\[80\%\] {
    width: 80%;
  }

  .md\:grid-cols-2 {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }

  .md\:items-center {
    align-items: center;
  }

  .md\:gap-\[7em\] {
    gap: 7em;
  }

  .md\:space-x-8 > :not([hidden]) ~ :not([hidden]) {
    --tw-space-x-reverse: 0;
    margin-right: calc(2rem * var(--tw-space-x-reverse));
    margin-left: calc(2rem * calc(1 - var(--tw-space-x-reverse)));
  }

  .md\:overflow-auto {
    overflow: auto;
  }

  .md\:overflow-hidden {
    overflow: hidden;
  }

  .md\:overflow-y-auto {
    overflow-y: auto;
  }

  .md\:p-12 {
    padding: 3rem;
  }

  .md\:text-4xl {
    font-size: 2.25rem;
    line-height: 2.5rem;
  }
}

@media (min-width: 1024px) {
  .lg\:w-\[40\%\] {
    width: 40%;
  }

  .lg\:grid-cols-3 {
    grid-template-columns: repeat(3, minmax(0, 1fr));
  }

  .lg\:px-8 {
    padding-left: 2rem;
    padding-right: 2rem;
  }
}

@media (min-width: 1280px) {
  .xl\:w-\[30\%\] {
    width: 30%;
  }
}
```````

`/home/ramees/progs/php/sora/public/index.php`:

```````php
<?php 
require __DIR__."/../vendor/autoload.php";
ini_set('session.cookie_httponly', 1); 
ini_set('session.cookie_secure', 1); 
ini_set('session.use_strict_mode', 1); // Prevents session fixation in some cases
ini_set('session.gc_maxlifetime', 1800);



session_start();
use Sora\Core\Application;
use Sora\Core\Router;
use Sora\Controllers\UserController;
use Sora\Controllers\HomeController;
use Sora\Controllers\PostController;
use Sora\Helpers\Helper;
use Sora\Controllers\SpaceController;
use Sora\Controllers\MessageController;
use Sora\Controllers\AdminController;
$messageController = new MessageController();
$unread_message_count = $messageController->getUnreadMessageCount();

$router = new Router();
$app = new Application($router);

$app->router->get('/', [HomeController::class, 'home']);
$app->router->get('/login', [HomeController::class, 'login']);
$app->router->post('/login', [UserController::class, 'login']);
$app->router->get('/register', [HomeController::class, 'register']);
$app->router->post('/register', [UserController::class, 'register']);
$app->router->get('/logout', [UserController::class, 'logout']);
$app->router->get('/profile', [UserController::class, 'profile']);
$app->router->get('/delete_profile', [UserController::class, 'deleteProfile']);
$app->router->get('/profile/:any', [UserController::class, 'profile']);
$app->router->get('/get_followed_users', [UserController::class, 'get_followed_users']);
$app->router->get('/get_followers_users', [UserController::class, 'get_followers_users']);
$app->router->get('/search_users', [UserController::class, 'search_users']);
$app->router->get('/get_user_status', [UserController::class, 'getUserStatus']);



$app->router->post('/create', [PostController::class, 'create']);
$app->router->post('/edit_profile', [UserController::class, 'edit_user_details']);
$app->router->post('/add_likes', [PostController::class, 'add_likes']);
$app->router->post('/remove_likes', [PostController::class, 'remove_likes']);
$app->router->post('/add_comment', [PostController::class, 'add_comment']);
$app->router->post('/delete_post', [PostController::class, 'delete_post']);
$app->router->post('/delete_comment', [PostController::class, 'delete_comment']);
$app->router->post('/follow', [UserController::class, 'follow']);
$app->router->post('/unfollow', [UserController::class, 'unfollow']);
$app->router->post('/update_status', [UserController::class, 'updateStatus']);
$app->router->post('/delete_profile', [UserController::class, 'deleteProfile']);


$app->router->get('/spaces', [SpaceController::class, 'listSpaces']);
$app->router->get('/spaces/create', [SpaceController::class, 'createSpace']);
$app->router->post('/spaces/create', [SpaceController::class, 'createSpace']);
$app->router->get('/spaces/:num', [SpaceController::class, 'viewSpace']);
$app->router->post('/spaces/join', [SpaceController::class, 'joinSpace']);
$app->router->post('/spaces/leave', [SpaceController::class, 'leaveSpace']);
$app->router->post('/spaces/tweet', [SpaceController::class, 'createSpaceTweet']);
$app->router->post('/spaces/tweet/delete', [SpaceController::class, 'deleteSpaceTweet']);
$app->router->post('/spaces/delete', [SpaceController::class, 'deleteSpace']);



$app->router->get('/messages', [MessageController::class, 'listConversations']);
$app->router->get('/messages/:num', [MessageController::class, 'viewConversation']);
$app->router->post('/messages/send', [MessageController::class, 'sendMessage']);
$app->router->post('/messages/delete', [MessageController::class, 'deleteConversation']);
$app->router->post('/messages/block', [MessageController::class, 'blockUser']);
$app->router->post('/messages/unblock', [MessageController::class, 'unblockUser']);
$app->router->get('/users/search', [UserController::class, 'searchUsersForConversation']);

$app->router->get('/admin', [AdminController::class, 'admin']);

$app->run();


 
?>


```````

`/home/ramees/progs/php/sora/src/Helpers/Helper.php`:

```````php
<?php
namespace Sora\Helpers;

class Helper{
    public static function generate_token(): string {
        return bin2hex(random_bytes(32));
    }

    public static function validate_user(){
        if(!isset($_SESSION['user_id'])){
            header("Location: /login");
            exit;
        }
        if($_SESSION["is_admin"] == true) {
            header("Location: /admin");
            return;
        }
    }

    public static function time_ago($timestamp) {
        $current_time = time();
        $time_difference = $current_time - strtotime($timestamp);
        
        // Define time intervals in seconds
        $intervals = array(
            'year'   => 31536000,
            'month'  => 2592000,
            'week'   => 604800,
            'day'    => 86400,
            'hour'   => 3600,
            'minute' => 60,
            'second' => 1
        );
        
        // Handle future dates
        if ($time_difference < 0) {
            return "just now";
        }
        
        // Handle very recent times
        if ($time_difference < 10) {
            return "just now";
        }
        
        // Find the appropriate interval
        foreach ($intervals as $interval => $seconds) {
            $difference = floor($time_difference / $seconds);
            
            if ($difference >= 1) {
                // Handle plural vs singular
                $interval_text = $difference == 1 ? $interval : $interval . 's';
                return $difference . " " . $interval_text . " ago";
            }
        }
    }
}

?>


```````

`/home/ramees/progs/php/sora/src/Config/Database.php`:

```````php
<?php



namespace Sora\Config;
/** Database class to return a database object */
class Database {
      public static function get_connection(): \mysqli {

        $env = parse_ini_file(__DIR__."/.env");
        $username = $env['USERNAME'];
        $passwd = $env['PASSWORD'];
        $hostname = $env['HOSTNAME'];
        $database = $env['DATABASE'];


        /**
         * @var mysqli $mysqli object to be returned
         *
         */
        $mysqli = new \mysqli(
            $hostname,     // Database host (e.g., 'localhost')
            $username, // Database username
            $passwd, // Database password
            $database  // Database name
        );

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        return $mysqli;
    }
}

?>

```````

`/home/ramees/progs/php/sora/src/Config/sora.sql`:

```````sql
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 03, 2024 at 12:45 PM
-- Server version: 11.5.2-MariaDB
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sora`
--
CREATE DATABASE IF NOT EXISTS `sora` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `sora`;

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
  `id` int(11) NOT NULL,
  `blocker_id` int(11) NOT NULL,
  `blocked_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conversation_deletions`
--

CREATE TABLE `conversation_deletions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `other_user_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conversation_deletions`
--

INSERT INTO `conversation_deletions` (`id`, `user_id`, `other_user_id`, `deleted_at`) VALUES
(1, 6, 8, '2024-11-03 09:13:43'),
(2, 8, 6, '2024-11-03 09:45:50'),
(5, 8, 8, '2024-11-03 09:02:27');

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `follower_id` int(11) NOT NULL,
  `followed_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`follower_id`, `followed_id`, `created_at`) VALUES
(6, 8, '2024-11-02 15:14:43'),
(8, 6, '2024-11-03 12:40:29');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `created_at`) VALUES
(168, 6, 62, '2024-11-03 09:57:18');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `content`, `created_at`, `is_read`) VALUES
(1, 6, 8, 'hi', '2024-11-03 07:56:06', 1),
(3, 6, 8, 'hi', '2024-11-03 08:02:37', 1),
(5, 6, 8, 'hi there', '2024-11-03 08:03:10', 1),
(7, 6, 8, 'hi', '2024-11-03 08:04:00', 1),
(8, 6, 8, 'hello', '2024-11-03 08:04:22', 1),
(9, 8, 8, 'hello', '2024-11-03 08:20:34', 1),
(10, 8, 6, 'hello', '2024-11-03 08:20:46', 1),
(11, 8, 6, 'hello', '2024-11-03 08:21:01', 1),
(12, 8, 6, 'hello', '2024-11-03 08:22:38', 1),
(13, 8, 8, 'hi therer', '2024-11-03 08:23:00', 1),
(14, 8, 6, 'hello guyss', '2024-11-03 08:23:06', 1),
(15, 6, 8, 'hi', '2024-11-03 08:26:43', 1),
(16, 8, 6, 'hello', '2024-11-03 08:27:06', 1),
(17, 6, 8, 'hi', '2024-11-03 08:27:42', 1),
(18, 8, 8, 'hi', '2024-11-03 08:51:43', 1),
(19, 8, 6, 'hi', '2024-11-03 08:57:21', 1),
(20, 8, 6, 'hi', '2024-11-03 09:02:49', 1),
(21, 6, 8, 'hi', '2024-11-03 09:16:41', 1),
(22, 6, 8, 'hello', '2024-11-03 09:16:58', 1),
(23, 8, 6, 'hi', '2024-11-03 09:19:47', 1),
(24, 8, 6, 'hello', '2024-11-03 09:19:50', 1),
(25, 8, 6, 'hi', '2024-11-03 09:32:04', 1),
(26, 8, 6, 'hi', '2024-11-03 09:36:58', 1),
(27, 8, 6, 'hi', '2024-11-03 09:37:01', 1),
(28, 6, 8, 'hi', '2024-11-03 09:56:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(62, 8, 'hi there', '2024-11-02 12:10:40', '2024-11-02 12:10:40'),
(67, 6, 'hi there', '2024-11-03 09:59:08', '2024-11-03 09:59:08'),
(68, 8, 'hi there', '2024-11-03 09:59:29', '2024-11-03 09:59:29');

-- --------------------------------------------------------

--
-- Table structure for table `spaces`
--

CREATE TABLE `spaces` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `code` varchar(8) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spaces`
--

INSERT INTO `spaces` (`id`, `name`, `admin_id`, `code`, `created_at`) VALUES
(1, 'test', 8, 'Z7HEQXFW', '2024-11-03 07:01:37'),
(2, 'test space 1', 6, '8L2UXV3N', '2024-11-03 08:26:08');

-- --------------------------------------------------------

--
-- Table structure for table `space_members`
--

CREATE TABLE `space_members` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `space_id` int(11) NOT NULL,
  `joined_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `space_members`
--

INSERT INTO `space_members` (`id`, `user_id`, `space_id`, `joined_at`) VALUES
(1, 8, 1, '2024-11-03 07:01:37'),
(3, 6, 2, '2024-11-03 08:26:08'),
(4, 8, 2, '2024-11-03 11:45:35');

-- --------------------------------------------------------

--
-- Table structure for table `space_tweets`
--

CREATE TABLE `space_tweets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `space_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `space_tweets`
--

INSERT INTO `space_tweets` (`id`, `user_id`, `space_id`, `content`, `created_at`) VALUES
(1, 8, 1, 'hi\r\n', '2024-11-03 07:02:38'),
(2, 8, 1, 'hello\r\n', '2024-11-03 07:05:38'),
(3, 6, 1, 'hi ramees\r\n', '2024-11-03 07:07:14'),
(4, 6, 1, 'hi', '2024-11-03 07:12:50'),
(5, 6, 1, 'hi there', '2024-11-03 07:13:27'),
(6, 6, 2, 'hello', '2024-11-03 08:26:11'),
(7, 8, 2, 'hi there', '2024-11-03 11:45:52'),
(8, 8, 2, 'what is happening', '2024-11-03 11:46:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `profile_picture`, `bio`, `created_at`, `updated_at`, `status`) VALUES
(6, 'Irene', 'J Kooran', 'irene', 'irene@gmail.com', '$2y$10$1z346OHrI8UQqkPyMNWS4e1SkrhvKJDpTtxCJ6Odk1t.CkF0dD6CC', '/images/icons/user-avatar.png', 'Hello guyss', '2024-10-18 09:32:40', '2024-11-03 07:14:46', 'hellooo'),
(8, 'Ramees', 'Mohammed M M', 'ramees', 'rameesmohd2004@gmail.com', '$2y$10$YUoHmD.7bEGe/vqYJoJk1O199bzV1zziBycJooDKvIw.uw8W6QGYy', '/images/pfps/profile_8.png', 'C,C++, Rust Enthusiast, Systems Programmer', '2024-10-22 20:15:34', '2024-11-03 10:14:35', 'hello there');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blocker_id` (`blocker_id`,`blocked_id`),
  ADD KEY `blocked_id` (`blocked_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_comments_post_id` (`post_id`);

--
-- Indexes for table `conversation_deletions`
--
ALTER TABLE `conversation_deletions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`other_user_id`),
  ADD KEY `other_user_id` (`other_user_id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`follower_id`,`followed_id`),
  ADD KEY `idx_follows_follower_id` (`follower_id`),
  ADD KEY `idx_follows_followed_id` (`followed_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`post_id`),
  ADD KEY `idx_likes_post_id` (`post_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_posts_user_id` (`user_id`);

--
-- Indexes for table `spaces`
--
ALTER TABLE `spaces`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `space_members`
--
ALTER TABLE `space_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`space_id`),
  ADD KEY `space_id` (`space_id`);

--
-- Indexes for table `space_tweets`
--
ALTER TABLE `space_tweets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `space_id` (`space_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `firstname` (`firstname`,`lastname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `conversation_deletions`
--
ALTER TABLE `conversation_deletions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `spaces`
--
ALTER TABLE `spaces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `space_members`
--
ALTER TABLE `space_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `space_tweets`
--
ALTER TABLE `space_tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blocks`
--
ALTER TABLE `blocks`
  ADD CONSTRAINT `blocks_ibfk_1` FOREIGN KEY (`blocker_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blocks_ibfk_2` FOREIGN KEY (`blocked_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `conversation_deletions`
--
ALTER TABLE `conversation_deletions`
  ADD CONSTRAINT `conversation_deletions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `conversation_deletions_ibfk_2` FOREIGN KEY (`other_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`followed_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `spaces`
--
ALTER TABLE `spaces`
  ADD CONSTRAINT `spaces_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `space_members`
--
ALTER TABLE `space_members`
  ADD CONSTRAINT `space_members_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `space_members_ibfk_2` FOREIGN KEY (`space_id`) REFERENCES `spaces` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `space_tweets`
--
ALTER TABLE `space_tweets`
  ADD CONSTRAINT `space_tweets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `space_tweets_ibfk_2` FOREIGN KEY (`space_id`) REFERENCES `spaces` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

```````

`/home/ramees/progs/php/sora/src/Config/init.php`:

```````php
<?php

define("ROOT", __DIR__."/../../");
define("APPROOT", __DIR__."/../../public/");

?>

```````

`/home/ramees/progs/php/sora/src/Core/Router.php`:

```````php
<?php
namespace Sora\Core;

class Router {
    protected $routes = [];

    /**
     * Route GET requests
     *
     * @param string $path Path to route for
     * @param array|string $callback Array with the classname and method
     * to call or a string containing the function name
     */
    public function get($path, $callback) {
        $path = $this->prepareRoute($path);
        $this->routes['GET'][$path] = $callback;
    }

    /**
     * Route POST requests
     *
     * @param string $path Path to route for
     * @param array|string $callback Array with the classname and method
     * to call or a string containing the function name
     */
    public function post($path, $callback) {
        $path = $this->prepareRoute($path);
        $this->routes['POST'][$path] = $callback;
    }

    /**
     * Prepare route pattern by converting :any and :num to regex
     *
     * @param string $path Original route path
     * @return string Prepared route pattern
     */
    protected function prepareRoute($path) {
        $path = str_replace(
            array(':any', ':num'),
            array('([^/]+)', '([0-9]+)'),
            $path
        );
        return '#^' . $path . '/?$#';
    }

    /**
     * Match URI against route pattern
     *
     * @param string $pattern Route pattern
     * @param string $uri Request URI
     * @return bool|array False if no match, array of matches if found
     */
    protected function matchRoute($pattern, $uri) {
        $matches = array();
        if (preg_match($pattern, $uri, $matches)) {
            array_shift($matches); 
            return $matches;
        }
        return false;
    }

    /**
     * Dispatch to the routes from the URI
     */
    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        if (substr($uri, -1) === '/' && strlen($uri) > 1) {
            $uri = substr($uri, 0, -1);
        }

        // Check each route pattern for the current method
        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $pattern => $callback) {
                $matches = $this->matchRoute($pattern, $uri);
                         
                if ($matches !== false) {
                    if (is_callable($callback)) {
                        call_user_func_array($callback, $matches);
                        return;
                    } else if (is_array($callback)) {
                        $controller = new $callback[0]();
                        $method = $callback[1];
                        
                        if (method_exists($controller, $method)) {
                            call_user_func_array([$controller, $method], $matches);
                            return;
                        } else {
                            http_response_code(500);
                            echo "Error: Method '$method' not found in controller '$callback[0]'.";
                            return;
                        }
                    }
                }
            }
        }

        // No matching route found
        http_response_code(404);
        echo "404 Not Found\n";
        echo $_SERVER['REQUEST_URI'];
    }
}
```````

`/home/ramees/progs/php/sora/src/Core/Application.php`:

```````php
<?php

namespace Sora\Core;

class Application {
  public $router;


  public function __construct(Router $router){
    $this->router = $router;
  }

  public function run(){
    $this->router->dispatch();
  }
}
?>

```````

`/home/ramees/progs/php/sora/src/Controllers/HomeController.php`:

```````php
<?php 
namespace Sora\Controllers;
use \Sora\Helpers\Helper;

class HomeController{
  

  
  public function home(){

    if($_SESSION["username"] == "admin") {
      header("Location: /admin");
      return;
    }

    Helper::validate_user();
    
    require "../src/Views/home.html";
    
    
  }

  public function login(){

    if($_SERVER['REQUEST_METHOD'] == "POST"){
      $this->home();
      
    }
    else{
      require_once __DIR__."/../Views/login.html";
    }
  }

  public function register() {
    if($_SERVER['REQUEST_METHOD'] == "POST"){

    }
    else{
      require_once __DIR__."/../Views/signup.html";
    }
  }
}

```````

`/home/ramees/progs/php/sora/src/Controllers/AdminController.php`:

```````php
<?php
namespace Sora\Controllers;
use Sora\Models\AdminModel;
use Sora\Models\UserModel;
use Sora\Config\Database;

class AdminController{
    private $adminModel;
    private $userModel;

    public function __construct(){
        $db = Database::get_connection();
        $this->adminModel = new AdminModel($db);
        $this->userModel = new UserModel($db);
    }

    public function admin(){
        if(!$_SESSION["is_admin"] == true){
            http_response_code(401);
            echo "Only admin can access this resource";
            return;

        }
        $this->generate_user_list();
    }


    private function generate_user_list(){
        
        $user_list = $this->userModel->generateUserList();
        include __DIR__."/../Views/admin_panel.php";
    }

    public function delete_user(){
        $input  = file_get_contents('php://input');
        $data = jsone_decode($input, true);
        if (isset($data["user_id"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
            if($this->userModel->deleteUser($data["user_id"])){
                echo json_encode([
                    'status' => 'Success',
                    'message' => 'User deleted successfully'
                ]);
                return;
            
            }
            else{
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Unable to delete user'
                ]);
                return;
            }

        }
        else{
            echo json_encode([
                'status' => 'error',
                'message' => 'invalid request'
            ]);
            return;
        }
    }
}
?>
```````

`/home/ramees/progs/php/sora/src/Controllers/PostController.php`:

```````php
<?php
namespace Sora\Controllers;

use \Sora\Models\PostModel;
use \Sora\Config\Database;
use \Sora\Helpers\Helper;


class PostController {
    private $postModel;
    
    public function __construct(){
        $db = Database::get_connection();
        $this->postModel = new PostModel($db);

    }

    public function create(){
        Helper::validate_user();

        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            $user_id = $_SESSION['user_id'];
            $content = $_POST['content'];
            
            if($_SESSION['csrf_token'] !== $_POST['csrf_token']){
                unset($_SESSION['csrf_token']);
                http_response_code(400);
                exit;
            }
            else{
                unset($_SESSION['csrf_token']);
                if($this->postModel->create_post($user_id, $content)){
                   header("Location: /");
                   exit;
                } else{
                    $error[] = "Error creating post";
                }
            }
        }
        else{
            $errors[] = "invalid request method";
        }
    }

    public function delete_post() {
        Helper::validate_user();
    
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
    
        if (isset($data['post_id'])) {
            $post_id = $data['post_id'];
            $user_id = $_SESSION['user_id'];
    
            if ($this->postModel->delete_post($post_id, $user_id)) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Post deleted successfully'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to delete post'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'post_id not found in request'
            ]);
        }
    }

    public  function render_tweet($tweet){
        $is_liked = $this->postModel->check_user_likes($tweet["id"]);
        $like_class = $is_liked == 1 ? "liked" : "";
        $id = $tweet["id"];
        $username = $tweet["username"];
        $content = $tweet['content'];
        $created_at = Helper::time_ago($tweet['created_at']);
        $upvotes = $tweet['upvotes'] ?? 0;
        $comments = $tweet['comment_count'] ?? 0;
        $dp_available = $tweet['profile_picture'] ?? false;
        $comments_html = self::render_comments($id);
        if($dp_available){
            $pfp_avatar = <<<HTML
             <img src="{$tweet['profile_picture']}" alt="" class="w-10 h-10 rounded-full mr-3">
            HTML;
        }

        else{
            $pfp_avatar = <<<HTML
            <img src="images/icons/user-avatar.png" alt="" class="w-10 h-10 rounded-full mr-3">
            HTML;
        }
        $delete_button = '';
    if ($tweet['user_id'] == $_SESSION['user_id']) {
        $delete_button = <<<HTML
        <button class="delete-tweet flex items-center space-x-1 hover:text-red-500 transition duration-300" data-post-id="$id">
            <i class="fas fa-trash"></i>
            <span>Delete</span>
        </button>
        HTML;
    }
        $html = <<<HTML
    <div class="bg-gray-300 p-4 rounded-lg shadow opacity-95 text-[1.16em] shadow-sm hover:shadow-md transition duration-300">
        <div class="flex items-center mb-2">
            $pfp_avatar
            <div>
                <a href="/profile/{$username}" class="font-bold text-slate-900 block">@{$username}</a>
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-clock mr-1"></i>
                    <span>{$created_at}</span>
                </div>
            </div>
        </div>
        <p class="mb-3 text-slate-900">{$content}</p>
        <div class="flex items-center space-x-4 text-gray-500">
            
            <button class="upvotes flex items-center space-x-1 hover:text-blue-500 transition duration-300 $like_class " data-post-id="$id" data-liked-id="$is_liked">
                <i class="fas fa-arrow-up"></i>
                <span id="upvotes">{$upvotes}</span>
            </button>
            <button class="flex items-center space-x-1 hover:text-green-500 transition duration-300 comment-toggle" data-post-id="$id">
            
                <i class="fas fa-comment"></i>
                <span>{$comments} comments</span>
            </button>
            $delete_button
        </div>
        <div class="comments-section mt-4 hidden" id="comments-section-{$id}">
                <h4 class="text-lg font-semibold mb-2">Comments</h4>
                <div class="space-y-2 mb-4" id="comments-{$id}">
                    {$comments_html}
                </div>
                <form action="/add_comment" method="post" class="flex" data-username="{$_SESSION['username']}">
                    <input type="hidden" name="post_id" value="{$id}">
                    <input type="text" name="content" class="flex-grow p-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Add a comment...">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 transition-colors duration-200">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>

            
        
    </div>
    HTML;
    return $html;

    }

    public function render_tweets($user_id=NULL, $self=false){
        if($user_id == NULL){

         $data = $this->postModel->get_tweets($_SESSION['user_id'], $self);
        }
        else{
            $data = $this->postModel->get_tweets($user_id, $self);
           
        }
        

        foreach($data as $tweet){
            $html = $this->render_tweet($tweet);
            echo $html;
        }
    
    }
    
    private static function render_comments($post_id) {
        $db = Database::get_connection();
        $postModel = new PostModel($db);
        $comments = $postModel->get_comments($post_id);

        $comments_html = '';
        foreach ($comments as $comment) {
            $delete_button = '';

            if ($comment['user_id'] == $_SESSION['user_id']) {
                $delete_button = <<<HTML
                <button class="delete-comment text-red-500 justify-self-end self-end hover:text-red-700" data-comment-id="{$comment['id']}">
                    <i class="fas fa-trash-alt"></i>
                </button>
                HTML;
            }
            $comment_time = Helper::time_ago($comment['created_at']);
            $comments_html .= <<<HTML
            <div class="bg-gray-100 p-3  w-full rounded-md flex flex-col">

                <p class="font-semibold text-sm">{$comment['username']}</p>
                
                <p class="text-gray-700">{$comment['content']}</p>
                <p class="text-xs text-gray-500 mt-1">{$comment_time}</p>
                {$delete_button}
                
            </div>
            HTML;
        }

        return $comments_html;
    }
    


    public function add_likes()
{
    // Fetch the raw POST body and decode the JSON
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Check if post_id exists in the decoded JSON
    if (isset($data['post_id'])) {
        $postId = $data['post_id'];

        // Assuming you have a method to increment the like count in your model
        $result = $this->postModel->add_likes($postId);

        if ($result) {
            // Return a success response
            echo json_encode([
                'status' => 'success',
                'message' => 'Like added successfully',
                'post_id' => $postId
            ]);
        } else {
            // Handle database failure
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to add like. Please try again later.',
                'post_id' => $postId
            ]);
        }
    } else {
        // Return an error response if post_id is not found
        echo json_encode([
            'status' => 'error',
            'message' => 'post_id not found in request'
        ]);
    }
}

public function remove_likes(){
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Check if post_id exists in the decoded JSON
    if (isset($data['post_id'])) {
        $postId = $data['post_id'];

        // Assuming you have a method to increment the like count in your model
        $result = $this->postModel->remove_likes($postId);

        if ($result) {
            // Return a success response
            echo json_encode([
                'status' => 'success',
                'message' => 'Like removed successfully',
                'post_id' => $postId
            ]);
        } else {
            // Handle database failure
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to remove like. Please try again later.',
                'post_id' => $postId
            ]);
        }
    } else {
        // Return an error response if post_id is not found
        echo json_encode([
            'status' => 'error',
            'message' => 'post_id not found in request'
        ]);
    }
}


public function add_comment() {
    Helper::validate_user();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $user_id = $_SESSION['user_id'];
        $post_id = $_POST['post_id'];
        $content = $_POST['content'];

        if ($this->postModel->add_comment($user_id, $post_id, $content)) {
            // Comment added successfully
            // header("Location: /?post_id=" . $post_id);
            exit;
        } else {
            $error[] = "Error adding comment";
            http_response_code(500);
        }
    }
}
public function delete_comment() {
    Helper::validate_user();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $comment_id = $_POST['comment_id'];
        $user_id = $_SESSION['user_id'];

        if ($this->postModel->delete_comment($comment_id, $user_id)) {
            // Comment deleted successfully
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error deleting comment']);
        }
        exit;
    }
}

public function get_comments($post_id) {
    return $this->postModel->get_comments($post_id);
}

   
}

?>
```````

`/home/ramees/progs/php/sora/src/Controllers/MessageController.php`:

```````php
<?php
namespace Sora\Controllers;

use Sora\Models\MessageModel;
use Sora\Config\Database;
use Sora\Helpers\Helper;
use Sora\Models\UserModel;

class MessageController {
    private $messageModel;
    private $userModel;

    public function __construct() {
        $db = Database::get_connection();
        $this->messageModel = new MessageModel($db);
        $this->userModel = new UserModel($db);
    }

    public function listConversations() {
        Helper::validate_user();
        $user_id = $_SESSION['user_id'];
        $conversations = $this->messageModel->getConversations($user_id);

        // Fetch user details for conversations with no messages
        foreach ($conversations as &$conversation) {
            if (empty($conversation['username'])) {
                $user = $this->userModel->getUserById($conversation['other_user_id']);
                $conversation['username'] = $user['username'];
                $conversation['profile_picture'] = $user['profile_picture'];
            }
        }

        require __DIR__."/../Views/conversations_list.php";
    }

    public function viewConversation($other_user_id) {
        Helper::validate_user();
        $user_id = $_SESSION['user_id'];
        $is_blocked=false;
        
        if ($this->messageModel->isBlocked( $user_id, $other_user_id)) {
            $is_blocked = true;
            
        }
        $other_username  = $this->userModel->getUserById($other_user_id)["username"];

        $messages = $this->messageModel->getMessages($user_id, $other_user_id);
        $this->messageModel->markMessagesAsRead($user_id, $other_user_id);
        require __DIR__."/../Views/conversation.php";
    }

    public function sendMessage() {
        Helper::validate_user();
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $sender_id = $_SESSION['user_id'];
            $receiver_id = $_POST['receiver_id'];
            $content = $_POST['content'];

            if($sender_id == $receiver_id) {
                echo json_encode(['success' => false, 'message' => 'You cannot send messages to yourself.']);
                http_response_code(400);
                exit;
            }

            if($this->messageModel->isBlocked($receiver_id, $sender_id)){
                echo json_encode(['success' => false, 'message' => 'You cannot send messages to this user.']);
                return;
            }

            if ($this->messageModel->isBlocked($sender_id, $receiver_id)) {
                echo json_encode(['success' => false, 'message' => 'You cannot send messages to this user.']);
                return;
            }

            if ($this->messageModel->sendMessage($sender_id, $receiver_id, $content)) {
                $receiver = $this->userModel->getUserById($receiver_id);
                echo json_encode([
                    'success' => true,
                    'message' => 'Message sent successfully',
                    'receiver' => [
                        'id' => $receiver['id'],
                        'username' => $receiver['username'],
                        'profile_picture' => $receiver['profile_picture']
                    ]
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to send message']);
            }
        }
    }

    public function deleteConversation() {
        Helper::validate_user();
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user_id = $_SESSION['user_id'];
            $other_user_id = $_POST['other_user_id'];

            if ($this->messageModel->deleteConversation($user_id, $other_user_id)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to delete conversation']);
            }
        }
    }

    public function blockUser() {
        Helper::validate_user();
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $blocker_id = $_SESSION['user_id'];
            $blocked_id = $_POST['blocked_id'];

            if ($this->messageModel->blockUser($blocker_id, $blocked_id)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to block user']);
            }
        }
    }

    public function unblockUser() {
        Helper::validate_user();
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = json_decode(file_get_contents("php://input"), true);
            $user_id = $_SESSION['user_id'];
            $blocked_user_id = $data['user_id'];

            if ($this->messageModel->unblockUser($user_id, $blocked_user_id)) {
                echo json_encode(['success' => true, 'message' => 'User unblocked successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to unblock user']);
            }
        }
    }

    public function isBlocked($user_id, $other_user_id) {
        return $this->messageModel->isBlocked($user_id, $other_user_id);
    }

    public function getUnreadMessageCount() {
        if (isset($_SESSION['user_id'])) {
            return $this->messageModel->getUnreadMessageCount($_SESSION['user_id']);
        }
        return 0;
    }
    
}
```````

`/home/ramees/progs/php/sora/src/Controllers/UserController.php`:

```````php
<?php

namespace Sora\Controllers;
use Sora\Config\Database;
use Sora\Models\UserModel;
// require_once __DIR__ . "/../../vendor/autoload.php";
// session_start();

/** Controller class for User Model
 *
 */
class UserController {

  /**@var Sora\Models\User $userModel user model object
   */
  private $userModel;
  public $postController;
  
  /**Constructor for User Controller
   */

  public function __construct() {
  /** @var mysqli $db object returned from Sora\Config\Database::get_connection()
   */
  try{
  $db = Database::get_connection();
  }
  catch(Exception $e){
    echo "error getting a database connection";
    exit;
  }

  $this->userModel = new UserModel($db);
  $this->postController = new PostController();

    
  }

  public function logout() {
    $_SESSION = array();
    session_destroy();
    header('Location: /login');
    exit;
  }

  public function is_logged_in(): bool{
    return isset($_SESSION['user_id']);
  }


  public function register(): array {
    $response =  $this->userModel->register($_POST);
    if($response['success'] === true) {
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['user_id'] = $response['user']['id'];
      $_SESSION['user_status'] = $response['user']['status'];
      header('Location: /');
      exit;
    }
    else{
      $_SESSION['error'] = $response['error'];
    
      header('Location: /register');
      exit;
    }
  }

  public function login() {
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];
    $response = $this->userModel->authenticate($username, $password);

    if (!$response['success']){
      $_SESSION['login_error'] = ["Username or password is incorrect!!"];
      header("Location: /login");
      exit;
    }
    session_regenerate_id(true);
    $_SESSION['username'] = $response['user']['username'];
    $_SESSION['user_id'] = $response['user']['id'];
    $_SESSION['user_status'] = $response['user']['status'];

    if($_SESSION["username"] == "admin"){
      $_SESSION["is_admin"] = true;
       header('Location: /admin');
       exit;
    }

    header('Location: /');
    exit;
    }
    else{
      include __DIR__."/../Views/login.html";
    }
  
  }

  public function profile($username=NULL) {
    if($username == NULL){
      if($_SERVER['REQUEST_METHOD'] == "GET"){
        $username = $_SESSION['username'];
        $user = $this->get_user_details($username);
        unset($data);
        $data["followers"] = $this->userModel->get_user_followers($user["username"]);
        $data["following"] = $this->userModel->get_user_following($user["username"]);
        $data["posts"] = $this->userModel->get_user_posts($user["username"]);
        include __DIR__ ."/../Views/profile.html";
      
      }
    }
    else{
      if($username == $_SESSION["username"]){
        $username = $_SESSION['username'];
        $user = $this->get_user_details($username);
        unset($data);
        $data["followers"] = $this->userModel->get_user_followers($user["username"]);
        $data["following"] = $this->userModel->get_user_following($user["username"]);
        $data["posts"] = $this->userModel->get_user_posts($user["username"]);
        header("Location: /profile");
        exit;
      }
      $user = $this->get_user_details($username);
      if (empty($user)){
        http_response_code(404);
        echo "404 Not Found\n";
        exit;
      }
      $this->render_profile($user);
    }
  } 


  public function deleteProfile() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /login');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $userId = $_SESSION['user_id'];
        $result = $this->userModel->deleteUser($userId);

        if ($result) {
            session_destroy();
            header('Location: /');
            exit;
        } else {
            $_SESSION['error'] = "Failed to delete profile. Please try again.";
            header('Location: /profile');
            exit;
        }
    } else {
        include __DIR__."/../Views/delete_profile.php";
    }
}

  protected function render_profile($user) {
    
    echo <<<BODY
    <body style="background: url('/images/sora-bg4.png')" >
    BODY;
    
    $data = [];
    $data["user"] = $user;

    $data["posts"] = $this->userModel->get_user_posts($user["username"]);
    $data["likes"] = $this->userModel->get_user_likes($user["username"]);
    $data["comments"] = $this->userModel->get_user_comments($user["username"]);
    $data["followers"] = $this->userModel->get_user_followers($user["username"]);
    $data["following"] = $this->userModel->get_user_following($user["username"]);
    

    require __DIR__ ."/../Views/user_profile.html";
}

public function render_user_tweets($data){
  $posts = $data["posts"];
  $user_id = $data["user"]["id"];
  $this->postController->render_tweets($user_id);
}

  public function get_user_details($username) {
    $user = $this->userModel->get_user_details($username);
    return $user;


  }
  



  public function edit_user_details(){
    if($_SERVER['REQUEST_METHOD'] == "POST"){


      $username = $_SESSION['username'];
      $password = $_POST['old_password'];
      $response = $this->userModel->authenticate($username, $password);
      if($response['success'] != true){
        $_SESSION['update_error'] = "Invalid Credentials";
        header("Location: /profile");
        exit;

      }
      else{
        $data = [
        "username" => $_POST['username'],
        "password" => password_hash($_POST['new_password'], PASSWORD_DEFAULT),
        "firstname" => $_POST['firstname'] ?? "",
        "lastname" => $_POST['lastname'] ?? "",
        "bio" =>     $_POST['bio'],
        // "profile_picture" => $_FILES['profile_picture'] ?? "",
        ];

        if($_POST['new_password'] == ""){
          unset($data["password"]);
        }
        
        
      }
      if ($this->userModel->update_user_details($username, $data)) {
        // Success message (optional)
        $_SESSION['update_success'] = "Profile updated successfully!"; 
        $_SESSION['username'] = $data["username"];
      } else {
        // Handle the case where no changes were made (optional)
        $_SESSION['update_info'] = "No changes were made to your profile."; 
      }
      header("Location: /profile");
    }
  
    else{
      header("Location: /profile");
    }
  }
  


public function get_followed_users() {
  $user_id = $_SESSION['user_id'];
  $followed_users = $this->userModel->get_followed_users($user_id);
  echo json_encode($followed_users);
}

public function get_followers_users(){
  $user_id = $_SESSION['user_id'];
  $followers_users = $this->userModel->get_followers_users($user_id);
  $formatted_result = array_map(function($user){
    $isFollowing = $this->userModel->isFollowing($_SESSION["user_id"], $user["id"]);
    $user['isFollowing'] = $isFollowing;
    return $user;
  }, $followers_users);
  echo json_encode($formatted_result);
}

public function search_users() {
  $query = $_GET['query'] ?? '';
  $results = $this->userModel->search_users($query);
  
  $formatted_results = array_map(function($user) {

    $isFollowing = $this->userModel->isFollowing($_SESSION["user_id"], $user["id"]);
    $user["isFollowing"] = $isFollowing;
    return [
        'id' => $user['id'],
        'username' => $user['username'],
        'profile_picture' => $user['profile_picture'] ?? '/images/icons/user-avatar.png',
        'isFollowing'    => $user["isFollowing"] 
    ];
}, $results);

echo json_encode($formatted_results);
}


public function follow() {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $input = json_decode(file_get_contents('php://input'), true);
      $followerId = $_SESSION['user_id'];
      $followedId = $input['user_id'];
      
      if ($this->userModel->follow($followerId, $followedId)) {
          echo json_encode(['success' => true]);
          exit;
      }
  }
  echo json_encode(['success' => false]);
}

public function unfollow() {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $input = json_decode(file_get_contents('php://input'), true);
      $followerId = $_SESSION['user_id'];
      $followedId = $input['user_id'];
      
      if ($this->userModel->unfollow($followerId, $followedId)) {
          echo json_encode(['success' => true]);
          exit;
      }
  }
  echo json_encode(['success' => false]);
}
  

public function updateStatus() {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $input = json_decode(file_get_contents('php://input'), true);
      $userId = $_SESSION['user_id'];
      $status = $input['status'];
      
      // If status is empty, set it to NULL in the database
      $status = empty($status) ? null : $status;
      // $_SESSION['status'] = empty($status) ? "" : $status;
      
      if ($this->userModel->updateStatus($userId, $status)) {
        
          $_SESSION['user_status'] = $status;
          echo json_encode(['success' => true]);
          exit;
      }
  }
  echo json_encode(['success' => false]);
}

public function getUserStatus() {
  $userId = $_SESSION['user_id'];
  $status = $this->userModel->getUserStatus($userId);
  echo json_encode(['status' => $status]);
}

public function searchUsersForConversation() {
  \Sora\Helpers\Helper::validate_user();
  
  $searchTerm = $_GET['term'] ?? '';
  $users = $this->userModel->searchUsersForConversation($searchTerm);
  
  header('Content-Type: application/json');
  echo json_encode($users);
}
}




```````

`/home/ramees/progs/php/sora/src/Controllers/SpaceController.php`:

```````php
<?php
namespace Sora\Controllers;

use Sora\Models\SpaceModel;
use Sora\Config\Database;
use Sora\Helpers\Helper;

class SpaceController {
    private $spaceModel;

    public function __construct() {
        $db = Database::get_connection();
        $this->spaceModel = new SpaceModel($db);
    }

    public function listSpaces() {
        Helper::validate_user();
        $user_id = $_SESSION['user_id'];
        $userSpaces = $this->spaceModel->getUserSpaces($user_id);
        require __DIR__."/../Views/spaces_list.html";
    }

    public function createSpace() {
        Helper::validate_user();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $name = $_POST['name'];
            $admin_id = $_SESSION['user_id'];

            $space_id = $this->spaceModel->createSpace($name, $admin_id);
            if ($space_id) {
                header("Location: /spaces/$space_id");
                exit;
            } else {
                $_SESSION['error'] = "Error creating space";
                header("Location: /spaces/create");
                exit;
            }
        }

        require __DIR__."/../Views/create_space.html";
    }

    public function viewSpace($space_id) {
        Helper::validate_user();
        $user_id = $_SESSION['user_id'];

        $space = $this->spaceModel->getSpace($space_id);
        if (!$space) {
            header("Location: /spaces");
            exit;
        }

        if (!$this->spaceModel->isSpaceMember($user_id, $space_id)) {
            $_SESSION['error'] = "You are not a member of this space";
            header("Location: /spaces");
            exit;
        }

        $tweets = $this->spaceModel->getSpaceTweets($space_id);
        $isAdmin = $this->spaceModel->isSpaceAdmin($user_id, $space_id);
        require __DIR__."/../Views/view_space.html";
    }

    public function joinSpace() {
        Helper::validate_user();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $space_code = $_POST['space_code'];
            $user_id = $_SESSION['user_id'];

            $space = $this->spaceModel->searchSpaceByCode($space_code);
            if ($space) {
                if ($this->spaceModel->joinSpace($user_id, $space['id'])) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to join space']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid space code']);
            }
        }
    }

    public function leaveSpace() {
        Helper::validate_user();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $space_id = $_POST['space_id'];
            $user_id = $_SESSION['user_id'];

            if ($this->spaceModel->leaveSpace($user_id, $space_id)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to leave space']);
            }
        }
    }

    public function createSpaceTweet() {
        Helper::validate_user();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $space_id = $_POST['space_id'];
            $content = $_POST['content'];
            $user_id = $_SESSION['user_id'];

            if (!$this->spaceModel->isSpaceMember($user_id, $space_id)) {
                echo json_encode(['success' => false, 'message' => 'You are not a member of this space']);
                return;
            }

            if ($this->spaceModel->createSpaceTweet($user_id, $space_id, $content)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to create tweet']);
            }
        }
    }

    public function deleteSpaceTweet() {
        Helper::validate_user();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $tweet_id = $_POST['tweet_id'];
            $space_id = $_POST['space_id'];
            $user_id = $_SESSION['user_id'];

            if ($this->spaceModel->deleteSpaceTweet($tweet_id, $user_id, $space_id)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to delete tweet']);
            }
        }
    }

    public function deleteSpace() {
        Helper::validate_user();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $space_id = $_POST['space_id'];
            $user_id = $_SESSION['user_id'];

            if ($this->spaceModel->isSpaceAdmin($user_id, $space_id)) {
                if ($this->spaceModel->deleteSpace($space_id, $user_id)) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to delete space']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'You are not the admin of this space']);
            }
        }
    }
}
```````

`/home/ramees/progs/php/sora/src/Models/UserModel.php`:

```````php
<?php                                         
namespace Sora\Models;
// require_once __DIR__."../../vendor/autoload.php"; 
/** User class for handling user-related operations                                       
 */

class UserModel {  

		/** @var mysqli $db Database connection object */                                                  
	  private $db;    

		/**                                                                                     
		* Constructor for User Class                                                                                                                                                 
		* @param mysqli $db The database connection object 
		*/                                                                                     
		public function __construct(\mysqli $db ) {                                                        
		$this->db = $db;                                                                        
		} 

		/**                                                                                     
		* Register a new user                                                                                                                                                     
		* @param string[] $data An associative array containing user registration data.           
		*                     Expected keys: 'firstName', 'LastName',        
		*                                     'username', 'email',           
		*                                     'password', 'confirmPassword'.                                                                                                                   
		* @return (bool|string[]) An associative array with keys:                                        
		*             'success' (bool) - Whether the registration was successful.              
		*             'error' (string[])  - Any error messages if registration failed.            
		*/                                                                                     
	
	public function register(array $data): array {              
      $validatedResult = $this->validate_user_registration($data);
      if (!$validatedResult['isValid']) {
				return [
					'success' => 'false',
					'error'   => $validatedResult['error'],
					'user' => null
				];
			}
			$username  = $data['username'];
			$email = $data['email'];
			$firstName = $data['firstname'];
			$lastName = $data['lastname'];
			$password = $data['password'];
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);

            if($data['username'] == 'admin') {
				$stmt = $this->db->prepare("SELECT id FROM admin WHERE username = ? or email = ?");
			}
			else{ 
			$stmt = $this->db->prepare("SELECT id FROM users WHERE username = ? or email = ?");
			}
			$stmt->bind_param("ss", $username, $email);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){
				return [
					'success' => false,
					'error' => ["USER ALREADY EXISTS"],
					'user' => null,
				];
			}

			$stmt = $this->db->prepare("insert into users(firstname, lastname, username, email, password) 
				                          values(?,?,?,?,?)");
			$stmt->bind_param("sssss", $firstName, $lastName, $username, $email, $hashed_password);
			if($stmt->execute()){
				$query = $this->db->prepare("select id,status from users where username = ?");
				$query->bind_param("s", $username);
				$query->execute();
				$result = $query->get_result();
				$user = $result->fetch_assoc();
				return [
					'success' => true,
					'error'   => null,
					'user' => $user,
				];
			}
			else {
				return [
					'success' => false,
					'error'   => ["cannot register user try again later."],
					'user' => null
				];
			}

		}                                                                                       

		/**                                                                                     
		* Authenticate a user                                                                  
		* @param string $username The username of the user                                     
		* @param string $password The 	password of the user                                    
		* @return string[] An array of user data if login is successful or null if it fails.
		* Expected keys: 'success' (bool),
		*                 'message' (string) - Login status message. 
		*                 'user'  (array) - user details.
		*/                                                                                     
	public function authenticate(string $username, string $password): ?array { 

	   if($username == "admin"){
		$stmt = $this->db->prepare("SELECT id, username, password FROM admin where username = ? or email = ?" );
	   }
	   else{
       $stmt = $this->db->prepare("SELECT id, username, status, password FROM users where username = ? or email = ?" );
	   }
       $stmt->bind_param("ss", $username,$username);     
 			 $stmt->execute();
 			 $result = $stmt->get_result();

 			 if ($result->num_rows === 0) {
				 return [
					 'success' => false,
					 'message' => 'INVALID_DETAILS_ERROR',
				 ];
			 } 

			 $user = $result->fetch_assoc();

			 if(password_verify($password, $user['password'])) {

				 return [
					 'success' => true,
					 'message' => 'LOGIN_SUCCESSFUL',
					 'user' => $user,
				 ];
				 
			 }
			 else {
				 return [
					 'success' => false,
					 'message' => 'INVALID_PASSWORD_ERROR',
				 ];
			 }
		                                                               
		}


    


		/**                                                                                     
		* Find a user by email address                                                         
		* @param string $email email address to search for                                     
		* return string[]|null An array of user data if found, or null if not found.              
		*/                                                                                     
	public function find_user_by_email(string $email): array|null {                                               
	  $stmt = $this->db->prepare("select * from users where email=? limit 1"); 
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();
      if($result->num_rows() === 0) {
				return null;
			}
			else {
				$user = $result->fetch_assoc();
				return $user;
			}
		}                                                                                       
	
		/**                                                                                     
		* validate user registration data.                                                     
		* @param string[] $data An associative array containing user registration data.           
		*                    Expected keys: 'firstName', 'LastName',         
		*                                    'username', 'email' ,            
		*                                     'password', 'confirmPassword'.                             
		* @return (bool|string[])[] An associative array with keys:                                        
		*               'isValid' (bool) - Whether the data is valid.                          
		*                'error' (?array) - Any validation error messages.                      
		*/                                                                                     
		private function validate_user_registration(array $data): array {
			$errors = [];
		
			// Validate username
			if (empty($data['username'])) {
				$errors[] = "Username is required";
			} elseif (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $data['username'])) {
				$errors[] = "Username must be 3-20 characters long and can only contain letters, numbers, and underscores";
			}
		
			// Validate email
			if (empty($data['email'])) {
				$errors[] = "Email is required";
			} elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
				$errors[] = "Invalid email format";
			}
		
			// Validate first name
			if (empty($data['firstname'])) {
				$errors[] = "First name is required";
			} elseif (!preg_match('/^[a-zA-Z]{2,30}$/', $data['firstname'])) {
				$errors[] = "First name must be 2-30 characters long and can only contain letters";
			}
		
			// Validate last name (reduced validation)
			if (empty($data['lastname'])) {
				$errors[] = "Last name is required";
			}
		
			// Validate password (changed to be greater than 8 characters)
			if (empty($data['password'])) {
				$errors[] = "Password is required";
			} elseif (strlen($data['password']) <= 8) {
				$errors[] = "Password must be greater than 8 characters long";
			}
		
			// Validate password confirmation
			if ($data['password'] !== $data['retype_password']) {
				$errors[] = "Passwords do not match";
			}
		
			return [
				'isValid' => empty($errors),
				'error' => $errors
			];
		}


		public function deleteUser($userId) {
			$stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
			$stmt->bind_param("i", $userId);
			return $stmt->execute();
		}

public function get_user_details($username): array{
	$stmt = $this->db->prepare("SELECT * from users where username = ? limit 1");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0){
	$rows = $result->fetch_assoc();
	return $rows;
	}
	else{
		return Array();
	}
}

public function get_user_posts($username){
	$stmt = $this->db->prepare("SELECT p.*
	FROM posts p
	JOIN users u ON p.user_id = u.id
	WHERE u.username = ?;");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0){
		return $result->fetch_all(MYSQLI_ASSOC);
	}
	else{
		return Array();
	}
}

public function get_user_likes($username){
	$stmt = $this->db->prepare("SELECT p.*
	FROM posts p
	JOIN likes l on p.id = l.post_id
	JOIN users u on l.user_id = u.id
	WHERE u.username = ?");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0){
		return $result->fetch_all(MYSQLI_ASSOC);
	}
	else{
		return Array();
	}

}

public function get_user_comments($username){
	$stmt = $this->db->prepare("SELECT p.*
	FROM posts p
	JOIN comments c on c.post_id = p.id
	JOIN users u on c.user_id = u.id
	WHERE u.username = ?");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0){
		return $result->fetch_all(MYSQLI_ASSOC);
	}
	else{
		return Array();
	}
}

public function get_user_followers($username){
	$stmt = $this->db->prepare("SELECT u.* 
	FROM users u
	JOIN follows f on u.id = f.follower_id
	WHERE f.followed_id = (SELECT  id from users where username = ?)");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0){
		return $result->fetch_all(MYSQLI_ASSOC);
	}
	else{
		return Array();
	}
}

public function get_user_following($username){
	$stmt = $this->db->prepare("SELECT u.* 
	FROM users u
	JOIN follows f on u.id = f.followed_id
	WHERE f.follower_id = (SELECT  id from users where username = ?)");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0){
		return $result->fetch_all(MYSQLI_ASSOC);
	}
	else{
		return Array();
	}
}


public function isFollowing($followerId, $followedId) {
    $stmt = $this->db->prepare("SELECT * FROM follows WHERE follower_id = ? AND followed_id = ?");
    $stmt->bind_param("ii", $followerId, $followedId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0 ;
}


public function follow($followerId, $followedId) {
    $stmt = $this->db->prepare("INSERT INTO follows (follower_id, followed_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $followerId, $followedId);
    return $stmt->execute();
}

public function unfollow($followerId, $followedId) {
    $stmt = $this->db->prepare("DELETE FROM follows WHERE follower_id = ? AND followed_id = ?");
    $stmt->bind_param("ii", $followerId, $followedId);
    return $stmt->execute();
}

public function getUsernameById($userId) {
    $stmt = $this->db->prepare("SELECT username FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    return $user ? $user['username'] : null;
}


private function handle_profile_picture($files, $action) {
	$userId = $_SESSION['user_id'];
	
	// Get current profile picture
	$stmt = $this->db->prepare("SELECT profile_picture FROM users WHERE id = ?");
	$stmt->execute([$userId]);
	$user = $stmt->fetch();
	$current_picture = $user['profile_picture'] ?? null;

	
			if (isset($files['profile_picture']) && $files['profile_picture']['error'] === UPLOAD_ERR_OK) {
				// Delete old file if exists
				if ($current_picture && file_exists($current_picture)) {
					unlink($current_picture);
				}
				
				// Handle new upload
				$file = $files['profile_picture'];
				$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
				$filename = 'profile_' . $userId .'.' . $ext;
				$upload_path = 'images/pfps/' . $filename;
				
				if (!move_uploaded_file($file['tmp_name'], $upload_path)) {
					throw new \Exception("Failed to upload profile picture");
				}
				
				return $upload_path;
			}
			
		
	
	return null;
}

public function update_user_details($username, $data){
	$update_fields = array();
	if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["name"] != ""  ){

	$uploadfile = $this->handle_profile_picture($_FILES, 'update');
	move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $uploadfile);
	$data["profile_picture"] = "/".$uploadfile;
	

	}

	if($_POST["profile_picture_state"] === "delete"){
		$data["profile_picture"] = "/images/icons/user-avatar.png";
	}
	
	

		$original_fields = $this->get_user_details($username);
		// if($data["profile_picture"] == "./images/pfps/"){
		// 	$data["profile_picture"] = NULL;
		// }
		if(!isset($_FILES["profile_picture"]) && file_exists($original_fields["profile_picture"])){
			unlink($current_picture);
		}
		if($original_fields){
			foreach($data as $field => $value){
				if ($original_fields[$field] !== $value){
					$update_fields[$field] = $value;
				}
			}
			return $this->update($username, $update_fields);
		}
		else{
			return false;
		}
}

function update($username, $data){
	
	if (!empty($data)){
		$sql = "UPDATE users set ";
		foreach($data as $key => $value){
			$sql .= "$key = '$value', ";

		}
		$sql = rtrim($sql, ", ");
		$sql .= " WHERE username=?";
		

		$stmt = $this->db->prepare($sql);
		
		$stmt->bind_param("s", $username);
		
		
		return $stmt->execute();
	}
	else{
		return false;
	}
	
}



public function get_followed_users($user_id) {
    $stmt = $this->db->prepare("
        SELECT u.id, u.username, u.profile_picture, u.status
        FROM users u
        JOIN follows f ON u.id = f.followed_id
        WHERE f.follower_id = ?
    ");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

public function get_followers_users($user_id){
	$stmt = $this->db->prepare("
        SELECT u.id, u.username, u.profile_picture, u.status
        FROM users u
        JOIN follows f ON u.id = f.follower_id
        WHERE f.followed_id = ? 
    ");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);

}

public function search_users($query) {
    $query = "%$query%";
    $stmt = $this->db->prepare("
        SELECT id, username, profile_picture, status
        FROM users
        WHERE username LIKE ? AND username != ?
        LIMIT 10
    ");
    $stmt->bind_param("ss", $query, $_SESSION["username"]);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

public function updateStatus($userId, $status) {
	$stmt = $this->db->prepare("UPDATE users SET status = ? WHERE id = ?");
	$stmt->bind_param("si", $status, $userId);
	return $stmt->execute();
}


public function getUserStatus($userId) {
	$stmt = $this->db->prepare("SELECT status FROM users WHERE id = ?");
	$stmt->bind_param("i", $userId);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	return $row ? $row['status'] : null;
}

public function getUserById($userId) {
	$stmt = $this->db->prepare("SELECT id, username, profile_picture, status FROM users WHERE id = ? LIMIT 1");
	$stmt->bind_param("i", $userId);
	$stmt->execute();
	$result = $stmt->get_result();
	
	if ($result->num_rows > 0) {
		return $result->fetch_assoc();
	}
	
	return null;
}

public function searchUsersForConversation($searchTerm) {
	$searchTerm = "%$searchTerm%";
	$stmt = $this->db->prepare("SELECT id, username FROM users WHERE username LIKE ? LIMIT 10");
	$stmt->bind_param("s", $searchTerm);
	$stmt->execute();
	return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

public function generateUserList(){
	$stmt = $this->db->prepare("SELECT * FROM users");
	$stmt->execute();
	
	return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

}                   

function test_input(string $data): string{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;

}

                                                                                      
?>

```````

`/home/ramees/progs/php/sora/src/Models/SpaceModel.php`:

```````php
<?php
namespace Sora\Models;

class SpaceModel {
    private \mysqli $db;

    public function __construct(\mysqli $db) {
        $this->db = $db;
    }

    public function createSpace($name, $admin_id) {
        $code = $this->generateUniqueCode();
        $stmt = $this->db->prepare("INSERT INTO spaces (name, admin_id, code) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $name, $admin_id, $code);
        if ($stmt->execute()) {
            $space_id = $stmt->insert_id;
            $this->joinSpace($admin_id, $space_id);
            return $space_id;
        }
        return false;
    }

    private function generateUniqueCode() {
        do {
            $code = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 8);
            $stmt = $this->db->prepare("SELECT id FROM spaces WHERE code = ?");
            $stmt->bind_param("s", $code);
            $stmt->execute();
            $result = $stmt->get_result();
        } while ($result->num_rows > 0);
        return $code;
    }

    public function getSpace($space_id) {
        $stmt = $this->db->prepare("SELECT * FROM spaces WHERE id = ?");
        $stmt->bind_param("i", $space_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function searchSpaceByCode($code) {
        $stmt = $this->db->prepare("SELECT * FROM spaces WHERE code = ?");
        $stmt->bind_param("s", $code);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getUserSpaces($user_id) {
        $stmt = $this->db->prepare("
            SELECT s.* 
            FROM spaces s
            JOIN space_members sm ON s.id = sm.space_id
            WHERE sm.user_id = ?
        ");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function joinSpace($user_id, $space_id) {
        $stmt = $this->db->prepare("INSERT IGNORE INTO space_members (user_id, space_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $space_id);
        return $stmt->execute();
    }

    public function leaveSpace($user_id, $space_id) {
        $stmt = $this->db->prepare("DELETE FROM space_members WHERE user_id = ? AND space_id = ?");
        $stmt->bind_param("ii", $user_id, $space_id);
        return $stmt->execute();
    }

    public function isSpaceMember($user_id, $space_id) {
        $stmt = $this->db->prepare("SELECT * FROM space_members WHERE user_id = ? AND space_id = ?");
        $stmt->bind_param("ii", $user_id, $space_id);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public function isSpaceAdmin($user_id, $space_id) {
        $stmt = $this->db->prepare("SELECT * FROM spaces WHERE id = ? AND admin_id = ?");
        $stmt->bind_param("ii", $space_id, $user_id);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public function createSpaceTweet($user_id, $space_id, $content) {
        $stmt = $this->db->prepare("INSERT INTO space_tweets (user_id, space_id, content) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $user_id, $space_id, $content);
        return $stmt->execute();
    }

    public function getSpaceTweets($space_id) {
        $stmt = $this->db->prepare("
            SELECT st.*, u.username, u.profile_picture
            FROM space_tweets st
            JOIN users u ON st.user_id = u.id
            WHERE st.space_id = ?
            ORDER BY st.created_at DESC
        ");
        $stmt->bind_param("i", $space_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteSpaceTweet($tweet_id, $user_id, $space_id) {
        $stmt = $this->db->prepare("DELETE FROM space_tweets WHERE id = ? AND (user_id = ? OR EXISTS (SELECT 1 FROM spaces WHERE id = ? AND admin_id = ?))");
        $stmt->bind_param("iiii", $tweet_id, $user_id, $space_id, $user_id);
        return $stmt->execute();
    }

    public function deleteSpace($space_id, $admin_id) {
        // First, delete all tweets in the space
        $stmt = $this->db->prepare("DELETE FROM space_tweets WHERE space_id = ?");
        $stmt->bind_param("i", $space_id);
        $stmt->execute();

        // Then, delete all space members
        $stmt = $this->db->prepare("DELETE FROM space_members WHERE space_id = ?");
        $stmt->bind_param("i", $space_id);
        $stmt->execute();

        // Finally, delete the space itself
        $stmt = $this->db->prepare("DELETE FROM spaces WHERE id = ? AND admin_id = ?");
        $stmt->bind_param("ii", $space_id, $admin_id);
        return $stmt->execute();
    }
}
```````

`/home/ramees/progs/php/sora/src/Models/MessageModel.php`:

```````php
<?php
namespace Sora\Models;

class MessageModel {
    private \mysqli $db;

    public function __construct(\mysqli $db) {
        $this->db = $db;
    }

    public function sendMessage($sender_id, $receiver_id, $content) {
        
        $stmt = $this->db->prepare("INSERT INTO messages (sender_id, receiver_id, content) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $sender_id, $receiver_id, $content);
        return $stmt->execute();
    }

    public function getConversations($user_id) {
        $stmt = $this->db->prepare("
            SELECT 
                CASE 
                    WHEN m.sender_id = ? THEN m.receiver_id 
                    ELSE m.sender_id 
                END AS other_user_id,
                u.username,
                u.profile_picture,
                m.content AS last_message,
                m.created_at AS last_message_time,
                COUNT(CASE WHEN m.is_read = 0 AND m.receiver_id = ? THEN 1 END) AS unread_count
            FROM messages m
            JOIN users u ON (CASE WHEN m.sender_id = ? THEN m.receiver_id ELSE m.sender_id END) = u.id
            LEFT JOIN conversation_deletions cd ON (cd.user_id = ? AND cd.other_user_id = u.id)
            WHERE (m.sender_id = ? OR m.receiver_id = ?) AND (cd.deleted_at IS NULL OR m.created_at > cd.deleted_at)
            
            GROUP BY other_user_id
            ORDER BY last_message_time DESC
        ");
        $stmt->bind_param("iiiiii", $user_id, $user_id, $user_id, $user_id, $user_id, $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getMessages($user_id, $other_user_id) {
        $stmt = $this->db->prepare("
            SELECT m.*, u.username, u.profile_picture
            FROM messages m
            JOIN users u ON m.sender_id = u.id
            LEFT JOIN conversation_deletions cd ON (cd.user_id = ? AND cd.other_user_id = ?)
            WHERE ((m.sender_id = ? AND m.receiver_id = ?) OR (m.sender_id = ? AND m.receiver_id = ?))
                AND (cd.deleted_at IS NULL OR m.created_at > cd.deleted_at)
            ORDER BY m.created_at ASC
        ");
        $stmt->bind_param("iiiiii", $user_id, $other_user_id, $user_id, $other_user_id, $other_user_id, $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function markMessagesAsRead($user_id, $other_user_id) {
        $stmt = $this->db->prepare("UPDATE messages SET is_read = TRUE WHERE sender_id = ? AND receiver_id = ? AND is_read = FALSE");
        $stmt->bind_param("ii", $other_user_id, $user_id);
        return $stmt->execute();
    }

    public function deleteConversation($user_id, $other_user_id) {
        $stmt = $this->db->prepare("INSERT INTO conversation_deletions (user_id, other_user_id) VALUES (?, ?) ON DUPLICATE KEY UPDATE deleted_at = CURRENT_TIMESTAMP");
        $stmt->bind_param("ii", $user_id, $other_user_id);
        return $stmt->execute();
    }

    public function blockUser($blocker_id, $blocked_id) {
        $stmt = $this->db->prepare("INSERT IGNORE INTO blocks (blocker_id, blocked_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $blocker_id, $blocked_id);
        return $stmt->execute();
    }

    public function unblockUser($blocker_id, $blocked_id) {
        $stmt = $this->db->prepare("DELETE FROM blocks WHERE blocker_id = ? AND blocked_id = ?");
        $stmt->bind_param("ii", $blocker_id, $blocked_id);
        return $stmt->execute();
    }

    public function isBlocked($user_id, $other_user_id) {
        $stmt = $this->db->prepare("SELECT * FROM blocks WHERE (blocker_id = ? AND blocked_id = ?) ");
        $stmt->bind_param("ii", $user_id, $other_user_id);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public function getUnreadMessageCount($user_id) {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as unread_count
            FROM messages m
            LEFT JOIN conversation_deletions cd ON (cd.user_id = ? AND cd.other_user_id = m.sender_id)
            WHERE m.receiver_id = ? AND m.is_read = FALSE
            AND (cd.deleted_at IS NULL OR m.created_at > cd.deleted_at)
        ");
        $stmt->bind_param("ii", $user_id, $user_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['unread_count'];
    }
}
```````

`/home/ramees/progs/php/sora/src/Models/AdminModel.php`:

```````php
<?php
namespace Sora\Models;

use Sora\Models\UserModel;
class AdminModel{
    private \mysqli $db;
  

    public function __construct(\mysqli $db){

        $this->db = $db;
        

    }

    

    

}

?>
```````

`/home/ramees/progs/php/sora/src/Models/PostModel.php`:

```````php
<?php
namespace Sora\Models;

class PostModel{
    private \mysqli $db;
    public function __construct(\mysqli $db){
        $this->db = $db;

    }

    public function create_post($user_id, $content): bool{

        
        $stmt =  $this->db->prepare("INSERT INTO posts (user_id, content) VALUES (?, ?)");

        $stmt->bind_param("is", $user_id, $content);
        return $stmt->execute();

    }
    public function delete_post($post_id, $user_id) {
        $stmt = $this->db->prepare("DELETE FROM posts WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $post_id, $user_id);
        return $stmt->execute();
    }

    public function view_posts(): array{
        $stmt = $this->db->prepare("Select * from posts");
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $data = $result->fetch_all(MYSQLI_ASSOC);
            return $data;

        }
        else {
            return [
                'error' => 'NO_RESULT'  
            ];
        }
    }
    // self variable to check if the user wants only his/her posts

    public function get_tweets($user_id, $self=false) {
        if($user_id == $_SESSION["user_id"] && $self==false){
        $stmt = $this->db->prepare("SELECT 
                p.id, 
                p.content, 
                p.created_at,
                u.username,
                u.id as user_id, 
                u.profile_picture,
                COUNT(l.post_id) AS upvotes,
                COUNT(DISTINCT c.id) AS comment_count
            FROM 
                posts p
            JOIN 
                users u ON p.user_id = u.id 
            LEFT JOIN 
                likes l ON p.id = l.post_id
            LEFT JOIN
                follows f ON p.user_id = f.followed_id AND f.follower_id = ? 
            LEFT JOIN
                 comments c on p.id = c.post_id
            WHERE 
                p.user_id = ? OR f.follower_id = ?
            GROUP BY
                p.id
            ORDER BY 
                p.created_at DESC;");
              $stmt->bind_param("iii", $user_id, $user_id, $user_id);
        }
        else if($user_id == $_SESSION["user_id"] && $self==true){
            $stmt = $this->db->prepare("SELECT 
            p.id, 
            p.content, 
            p.created_at,
            u.username, 
            u.id as user_id,
            u.profile_picture,
            COUNT(l.post_id) AS upvotes,
            COUNT(DISTINCT c.id) AS comment_count
        FROM 
            posts p
        JOIN 
            users u ON p.user_id = u.id 
        LEFT JOIN 
            likes l ON p.id = l.post_id
        LEFT JOIN 
            comments c on p.id = c.post_id
         
        WHERE 
            p.user_id = ? 
        GROUP BY
            p.id
        ORDER BY 
            p.created_at DESC;");
            
        $stmt->bind_param("i", $_SESSION["user_id"]);

        }
        else{
            $stmt = $this->db->prepare("SELECT 
            p.id, 
            p.content, 
            p.created_at,
            u.username, 
            u.id as user_id,
            u.profile_picture,
            COUNT(l.post_id) AS upvotes,
            COUNT(DISTINCT c.id) AS comment_count
            
        FROM 
            posts p
        JOIN 
            users u ON p.user_id = u.id 
        LEFT JOIN 
            likes l ON p.id = l.post_id
        LEFT JOIN comments c on p.id = c.post_id
         
        WHERE 
            p.user_id = ? 
        GROUP BY
            p.id
        ORDER BY 
            p.created_at DESC;");
        $stmt->bind_param("i", $user_id);
        }
        
    
       
    
        $stmt->execute();
    
        $result = $stmt->get_result();
        
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function add_likes($post_id){
        
        $user_id = $_SESSION['user_id'];
       

            $stmt = $this->db->prepare("insert ignore into likes(user_id, post_id) values(?,?)");
            $stmt->bind_param("ss",$user_id, $post_id );
            $result = $stmt->execute();
            return $result;

    }

    public function remove_likes($post_id) {
        $user_id = $_SESSION['user_id'];

        $stmt = $this->db->prepare("delete from likes where user_id=? and post_id=?");
        $stmt->bind_param("ss", $user_id, $post_id);
        $result = $stmt->execute();
        return $result;
    }
    
    public function check_user_likes($post_id){
        if(!isset($_SESSION["user_id"])){
            return false;
        }
        else {

            $user_id = $_SESSION["user_id"];
            $stmt = $this->db->prepare("SELECT * FROM likes WHERE post_id = ? AND user_id = ? LIMIT 1");
            if (!$stmt) {
              error_log("Error preparing statement: " . $this->db->error);
             return false;
            }

    // Bind parameters with error handling
        if (!$stmt->bind_param("ss", $post_id, $user_id)) {
            error_log("Error binding parameters: " . $stmt->error);
           $stmt->close();
           return false;
        }

    // Execute with error handling
        if (!$stmt->execute()) {
            error_log("Error executing statement: " . $stmt->error);
            $stmt->close();
            return false;
        }

    // Get result
        $result = $stmt->get_result();
        if (!$result) {
            error_log("Error getting result: " . $stmt->error);
            $stmt->close();
            return false;
        }

    // Get row count and clean up
        $has_liked = $result->num_rows;
        $result->close();
        $stmt->close();

        return $has_liked;
        }
        
    }


    public function add_comment($user_id, $post_id, $content) {

        $stmt = $this->db->prepare("INSERT INTO comments(user_id, post_id, content) VALUES(?,?,?)");
        $stmt->bind_param("iis", $user_id, $post_id, $content);
        return $stmt->execute();
        

        
    }

    public function delete_comment($comment_id, $user_id) {
        $stmt = $this->db->prepare("DELETE FROM comments WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $comment_id, $user_id);
        return $stmt->execute();
    }

    public function get_comments($post_id) {
        $stmt = $this->db->prepare("SELECT c.*, u.username FROM comments c JOIN users u ON c.user_id = u.id WHERE c.post_id = ? ORDER BY c.created_at DESC");
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
}
```````

`/home/ramees/progs/php/sora/src/Views/view_space.html`:

```````html
<!DOCTYPE html>
<html lang="en">
<?php include_once __DIR__."/html_head.html" ?>
<body class="bg-gray-100">
<?php include_once __DIR__ ."/navbar.html"?>

<main class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold"><?= htmlspecialchars($space['name']) ?></h1>
        <?php if (!$isAdmin): ?>
            <button id="leave-space-btn" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition-colors">Leave Space</button>
        <?php endif; ?>
    </div>
    
    <div class="mb-8">
        <h2 class="text-2xl font-bold mb-4">Space Tweets</h2>
        <form id="space-tweet-form" class="mb-4">
            <div class="flex">
                <textarea name="content" id="tweet-content" class="flex-grow p-2 border rounded-l" placeholder="What's happening in this space?" rows="1"></textarea>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r hover:bg-blue-600 transition-colors">Post Tweet</button>
            </div>
            <input type="hidden" name="space_id" value="<?= $space['id'] ?>">
        </form>
        <div id="space-tweets">
            <?php foreach ($tweets as $tweet): ?>
                <div class="bg-white p-4 rounded shadow mb-4" id="tweet-<?= $tweet['id'] ?>">
                    <div class="flex items-center mb-2">
                        <img src="<?= htmlspecialchars($tweet['profile_picture']) ?>" alt="Profile" class="w-10 h-10 rounded-full mr-2">
                        <span class="font-bold"><?= htmlspecialchars($tweet['username']) ?></span>
                    </div>
                    <p><?= htmlspecialchars($tweet['content']) ?></p>
                    <span class="text-sm text-gray-500"><?= date('M d, Y H:i', strtotime($tweet['created_at'])) ?></span>
                    <?php if ($tweet['user_id'] == $_SESSION['user_id'] || $isAdmin): ?>
                        <button class="delete-tweet-btn ml-2 text-red-500 hover:text-red-700" data-tweet-id="<?= $tweet['id'] ?>">Delete</button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if ($isAdmin): ?>
        <div class="mt-8">
            <button id="delete-space-btn" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Delete Space</button>
        </div>
    <?php endif; ?>
</main>

<script>
    const tweetForm = document.getElementById('space-tweet-form');
    const tweetContent = document.getElementById('tweet-content');

    function submitTweet(e) {
        e.preventDefault();
        const formData = new FormData(tweetForm);

        fetch('/spaces/tweet', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                location.reload();
            } else {
                alert('Failed to post tweet: ' + result.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    }

    tweetForm.addEventListener('submit', submitTweet);

    tweetContent.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            submitTweet(e);
        }
    });

    tweetContent.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });

    document.querySelectorAll('.delete-tweet-btn').forEach(button => {
        button.addEventListener('click', async (e) => {
            const tweetId = e.target.dataset.tweetId;
            if (confirm('Are you sure you want to delete this tweet?')) {
                try {
                    const response = await fetch('/spaces/tweet/delete', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `tweet_id=${tweetId}&space_id=<?= $space['id'] ?>`
                    });

                    if (response.ok) {
                        const result = await response.json();
                        if (result.success) {
                            document.getElementById(`tweet-${tweetId}`).remove();
                        } else {
                            alert('Failed to delete tweet: ' + result.message);
                        }
                    } else {
                        alert('Failed to delete tweet. Please try again.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                }
            }
        });
    });
    </script>
    <?php if (!$isAdmin): ?>
    <script>
    document.getElementById('leave-space-btn').addEventListener('click', async (e) => {
        if (confirm('Are you sure you want to leave this space?')) {
            try {
                const response = await fetch('/spaces/leave', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `space_id=<?= $space['id'] ?>`
                });

                if (response.ok) {
                    const result = await response.json();
                    if (result.success) {
                        alert('You have left the space successfully');
                        window.location.href = '/spaces';
                    } else {
                        alert('Failed to leave space: ' + result.message);
                    }
                } else {
                    alert('Failed to leave space. Please try again.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            }
        }
    });
    </script>
    <?php endif; ?>

    <?php if ($isAdmin): ?>
    <script>
    document.getElementById('delete-space-btn').addEventListener('click', async (e) => {
        if (confirm('Are you sure you want to delete this space? This action cannot be undone.')) {
            try {
                const response = await fetch('/spaces/delete', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `space_id=<?= $space['id'] ?>`
                });

                if (response.ok) {
                    const result = await response.json();
                    if (result.success) {
                        alert('Space deleted successfully');
                        window.location.href = '/spaces';
                    } else {
                        alert('Failed to delete space: ' + result.message);
                    }
                } else {
                    alert('Failed to delete space. Please try again.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            }
        }
    });
</script>
    <?php endif; ?>
</script>
</body>
</html>
```````

`/home/ramees/progs/php/sora/src/Views/create_space.html`:

```````html
<!DOCTYPE html>
<html lang="en">
<?php include_once __DIR__."/html_head.html" ?>
<body class="bg-gray-100">
    <?php include_once __DIR__ ."/navbar.html"?>
    
    <main class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Create a New Space</h1>
        <form action="/spaces/create" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="space-name">
                    Space Name
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="space-name" type="text" name="name" placeholder="Enter space name" required>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Create Space
                </button>
            </div>
        </form>
    </main>
</body>
</html>
```````

`/home/ramees/progs/php/sora/src/Views/navbar.html`:

```````html
<header class="bg-gradient-to-r flex from-sora-primary to-sora-secondary text-white py-4 px-6 shadow-lg w-full">
    <nav class="md:mx-0 mx-auto flex-grow flex justify-between items-center w-full">
        <span class="text-2xl sm:text-3xl md:text-4xl font-bold"><a href="/"> SORA</a></span>
         
        <div class="sm:flex hidden md:flex items-center md:space-x-8 md:mr-12"> 
            <a href="/profile" class="text-white text-lg hover:text-sora-bg transition-colors duration-300">
                <i class="fas fa-user mr-2"></i><?=$_SESSION['username']??'Profile'?>
            </a>
            <a href="/spaces" class="text-white text-lg hover:text-sora-bg transition-colors duration-300">
                <i class="fas fa-globe mr-2"></i>Spaces
            </a>
            <a href="/messages" class="text-white text-lg hover:text-sora-bg transition-colors duration-300 relative">
                <i class="fas fa-envelope mr-2"></i>Messages
                <?php if (isset($GLOBALS['unread_message_count']) && $GLOBALS['unread_message_count'] > 0): ?>
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                        <?= $GLOBALS['unread_message_count'] ?>
                    </span>
                <?php endif; ?>
            </a>
            <a href="/logout" class="text-white text-lg hover:text-sora-bg transition-colors duration-300">
                <i class="fas fa-sign-out-alt mr-2"></i>Logout
            </a>
        </div>
        
        <button class="md:hidden text-2xl"
        aria-label="Menu" 
    aria-expanded="false" 
    class="md:hidden p-2 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
    >
            <i class="fas fa-bars"></i>
        </button>
        <script src="/js/mobile-nav.js"></script>
    </nav>
</header>
```````

`/home/ramees/progs/php/sora/src/Views/login.html`:

```````html
<!DOCTYPE html>
<html class="h-full sm:overflow-y-auto md:overflow-hidden" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup/Login | SORA</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body class="h-full bg-gray-100 text-sora-text"> 
    <header class="bg-gradient-to-r from-sora-primary to-sora-secondary text-white py-4 px-6 shadow-lg"> 
        <nav class="text-2xl sm:text-3xl md:text-4xl font-bold">SORA</nav>
    </header>
    <main class="h-full text-sora-text"> 

        <div
            class="flex flex-col sm:flex-row gap-7 sm:gap-15 md:gap-[7em] justify-center items-center p-4 sm:p-8 md:p-12 min-h-[calc(100vh-4rem)]">
            <div
                class="login-card  p-6 flex items-center justify-center rounded-md shadow-md w-full sm:w-[90%] md:w-[80%] lg:w-[40%] xl:w-[30%] max-w-md">
                <div class="login w-full text-lg sm:text-xl">
                    <form class="flex flex-col w-full justify-center gap-4" action="/login" method="POST">
                        <h3 class="w-full font-bold text-2xl text-gray-900 mb-4 text-center">Login</h3>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="username">Username</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" name="username" id="username" required>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="password">Password</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="password" name="password" id="password" required>
                        </div>
                        <div class="error text-red-600 w-full text-center text-lg font-bold mt-2 hidden">
                            <?php 
                            if(isset($_SESSION['login_error'])){
                            echo implode("<br>", $_SESSION['login_error']); 
                            $_SESSION['login_error'] = null;
                            unset($_SESSION['error']);
                            }
                             ?>
                        </div>
                        <button
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit" name="submit">Login</button>
                    </form>
                </div>
            </div>

            <div class="signup-card  p-6 flex items-center justify-center rounded-md w-full sm:w-[90%] md:w-[80%] lg:w-[40%] xl:w-[30%] max-w-md  shadow-md">
                <div class="signup w-full text-lg sm:text-xl">
                    <form class="flex flex-col w-full justify-center gap-4" action="/register" method="POST">
                        <h3 class="w-full font-bold text-2xl text-gray-900 mb-4 text-center">Signup</h3>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="signup-email">Email</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="email" name="email" id="signup-email" required>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="signup-first-name">First Name</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" name="firstname" id="signup-first-name" required>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="signup-last-name">Last Name</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" name="lastname" id="signup-last-name" required>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="signup-username">Username</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" name="username" id="signup-username" required>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="signup-password">Password</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="password" name="password" id="signup-password" required>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="signup-retype-password">Retype
                                Password</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="password" name="retype_password" id="signup-retype-password" required>
                        </div>
                        <button
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit" name="submit">Signup</button>
                        <div class="error text-red-600 w-full text-center text-lg font-bold mt-2 hidden">
                            <?php 
                            if(isset($_SESSION['error'])){
                            echo implode("<br>", $_SESSION['error']); 
                            $_SESSION['error'] = null;
                            unset($_SESSION['error']);
                            }
                             ?>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </main>

    <script>
        let login_card = document.querySelector(".login-card");
        let signup_card = document.querySelector(".signup-card");

        let styles_array = ["bg-gray-200", "shadow-md"];

        login_card.addEventListener("mouseenter", () => {
            login_card.classList.add(...styles_array);
            signup_card.classList.remove(...styles_array);
        });

        signup_card.addEventListener("mouseenter", () => {
            signup_card.classList.add(...styles_array);
            login_card.classList.remove(...styles_array);
        });

        let error = document.querySelector(".error");
        if (error.textContent.trim() !== "") {
            error.classList.remove("hidden");
            document.querySelector("html").classList.add("md:overflow-y-auto");
        }
    </script>
</body>

</html>
```````

`/home/ramees/progs/php/sora/src/Views/layout.php`:

```````php
<?php
use Sora\Controllers\MessageController;

$messageController = new MessageController();
$unread_message_count = $messageController->getUnreadMessageCount();
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once __DIR__."/html_head.html" ?>
<body class="bg-gray-100">
<?php include_once __DIR__ ."/navbar.html"?>

<main class="container mx-auto px-4 py-8">
    <?php echo $content; ?>
    
</main>

</body>
</html>
```````

`/home/ramees/progs/php/sora/src/Views/delete_profile.php`:

```````php
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
```````

`/home/ramees/progs/php/sora/src/Views/conversation.php`:

```````php
<!DOCTYPE html>
<html lang="en">
<?php include_once __DIR__."/html_head.html" ?>
<body class="bg-gray-100">
<?php include_once __DIR__ ."/navbar.html"?>

<main class="container mx-auto px-4 py-8">
    <div class="bg-white shadow rounded-lg">
        <div class="flex justify-between items-center p-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold" id="conversation-title">
                <?= htmlspecialchars($other_username) ?>
            </h1>
            <div>
                <button id="new-conversation-btn" class="bg-green-500 text-white px-4 py-2 rounded mr-2 hover:bg-green-600 transition-colors">New Conversation</button>
                <?php if (isset($other_user_id)): ?>
                    <?php if (!$is_blocked): ?>
                    <button id="block-btn" class="bg-red-500 text-white px-4 py-2 rounded mr-2 hover:bg-red-600 transition-colors">Block</button>
                    <?php else: ?>
                        <button id="block-btn" class="bg-red-500 text-white hidden px-4 py-2 rounded mr-2 hover:bg-red-600 transition-colors">Block</button>
                        <button id="unblock-user" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded ml-2">
                       Unblock
                     </button>
                    <?php endif; ?> 
                    <button id="delete-conversation-btn" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition-colors">Delete Conversation</button>
                <?php endif; ?>
            </div>
        </div>
        
        <div id="user-search" class="p-4 border-b border-gray-200 hidden">
            <input type="text" id="user-search-input" class="w-full p-2 border rounded" placeholder="Search for a user...">
            <div id="user-search-results" class="mt-2"></div>
        </div>

        <div id="messages-container" class="h-96 overflow-y-auto p-4">
    <?php if (isset($messages) && !empty($messages)): ?>
        <?php 
        $other_user = $this->userModel->getUserById($other_user_id);
        $other_username = $other_user ? $other_user['username'] : 'Unknown User';
        ?>
        <h2 class="text-xl font-semibold mb-4">Conversation with <?= htmlspecialchars($other_username) ?></h2>
        <?php if ($is_blocked ): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">User is blocked.</strong>
                <!-- <button id="unblock-user" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded ml-2">
                    Unblock
                </button> -->
            </div>
        <?php endif; ?>
        <?php foreach ($messages as $message): ?>
            <div class="mb-4 <?= $message['sender_id'] == $_SESSION['user_id'] ? 'text-right' : 'text-left' ?>">
                <div class="inline-block max-w-xs <?= $message['sender_id'] == $_SESSION['user_id'] ? 'bg-blue-500 text-white' : 'bg-gray-300' ?> rounded-lg px-4 py-2">
                    <p><?= htmlspecialchars($message['content']) ?></p>
                    <span class="text-xs <?= $message['sender_id'] == $_SESSION['user_id'] ? 'text-blue-200' : 'text-gray-500' ?>"><?= date('M d, Y H:i', strtotime($message['created_at'])) ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center text-gray-500">No messages yet. Start a conversation!</p>
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
    const conversationTitle = document.getElementById('conversation-title');

    <?php if (isset($other_user_id)): ?>
    const blockBtn = document.getElementById('block-btn');
    const deleteConversationBtn = document.getElementById('delete-conversation-btn');
    <?php endif; ?>

    messageForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(messageForm);

        try {
            const response = await  fetch('/messages/send', {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                const result = await response.json();
                if (result.success) {
                    messageInput.value = '';
                    // Add the new message to the messages container
                    const newMessage = document.createElement('div');
                    newMessage.className = 'mb-4 text-right';
                    newMessage.innerHTML = `
                        <div class="inline-block max-w-xs bg-blue-500 text-white rounded-lg px-4 py-2">
                            <p>${formData.get('content')}</p>
                            <span class="text-xs text-blue-200">${new Date().toLocaleString()}</span>
                        </div>
                    `;
                    messagesContainer.appendChild(newMessage);
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;

                    // Update the conversation title if it's a new conversation
                    if (conversationTitle.textContent === 'New Conversation') {
                        conversationTitle.textContent = result.receiver.username;
                    }
                } else {
                    alert('Failed to send message: ' + result.message);
                }
            } else {
                alert('Failed to send message. Please try again.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('You can not send messages at the moment');
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
                    <div class="user-result p-2 hover:bg-gray-100 cursor-pointer" data-user-id="${user.id}" data-username="${user.username}">
                        ${user.username}
                    </div>
                `).join('');

                document.querySelectorAll('.user-result').forEach(result => {
                    result.addEventListener('click', () => {
                        const userId = result.dataset.userId;
                        const username = result.dataset.username;
                        receiverId.value = userId;
                        userSearch.classList.add('hidden');
                        messagesContainer.innerHTML = '<p class="text-center text-gray-500">Start a new conversation by sending a message.</p>';
                        conversationTitle.textContent = username;
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


<script>
document.addEventListener('DOMContentLoaded', function() {
    
    const unblockButton = document.getElementById('unblock-user');
    if (unblockButton) {
        unblockButton.addEventListener('click', async function() {
            try {
                const response = await fetch('/messages/unblock', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ user_id: <?= $other_user_id ?> }),
                });
                const result = await response.json();
                if (result.success) {
                    location.reload();
                } else {
                    alert('Failed to unblock user: ' + result.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred while trying to unblock the user.');
            }
        });
    }
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
```````

`/home/ramees/progs/php/sora/src/Views/profile.html`:

```````html
<!DOCTYPE html>
<html lang="en" class=" sm:overflow-y-auto md:overflow-auto">
<?php include_once __DIR__."/html_head.html" ?>

<body style="background: url('images/sora-bg4.png'); background-repeat: repeat-x; background-size:contain"
    class="bg-no-repeat bg-center">
    <?php include_once __DIR__ ."/navbar.html"?>

    <?php
    use Sora\Controllers\UserController;
    $userController = new UserController();
    $user = $userController->get_user_details($_SESSION['username']);
    ?>

    <!-- Profile View (Default) -->
    <main class="min-h-screen py-12 px-4 sm:px-6 lg:px-8  ">
        <div class="max-w-3xl mx-auto">
            <!-- Profile Card (Visible when not editing) -->
            <div id="profile-view" class="bg-white w-fit rounded-xl shadow-lg p-6 sm:p-8 mb-6">
                <div
                    class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-6 mb-6 w-max">
                    <div class="relative group ">
                        <div class="h-24 w-24 rounded-full overflow-hidden bg-gray-100">
                            <?php if(isset($user['profile_picture']) && !empty($user['profile_picture'])): ?>
                            <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile"
                                class="h-full w-full object-cover">
                            <?php else: ?>
                            <svg class="h-full w-full text-gray-400 p-6" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="flex-1 w-fit">
                        <h2 class="text-2xl font-bold text-gray-900 w-fit">
                            <?php echo htmlspecialchars($user['firstname'] . ' ' . $user['lastname']); ?>
                        </h2>
                        <p class="text-gray-500 mb-2">
                            <?php echo htmlspecialchars($user['email']); ?>
                        </p>
                        <p class="text-gray-700">
                            <?php echo htmlspecialchars($user['bio'] ?? 'No bio added yet'); ?>
                        </p>
                    </div>

                    <button onclick="toggleEdit()"
                        class="inline-flex items-center px-4 py-2 border border-violet-600 rounded-md shadow-sm text-sm font-medium text-violet-600 bg-white hover:bg-violet-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-violet-500">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        Edit Profile
                    </button>
                    <a href="/delete_profile" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Delete Profile
                    </a>
                </div>
                <div class="border-t border-b border-gray-200 mt-4 py-3">
                    <div class="flex justify-around items-center gap-3">
                        <div class="text-center">
                            <span class="block text-2xl font-semibold text-gray-900">
                                <?php echo count($data['posts']); ?>
                            </span>
                            <span class="text-sm text-gray-500">Posts</span>
                        </div>
                        <div class="text-center">
                            <span class="block text-2xl font-semibold text-gray-900">
                                <?php echo count($data['followers']); ?>
                            </span>
                            <span class="text-sm text-gray-500">Followers</span>
                        </div>
                        <div class="text-center">
                            <span class="block text-2xl font-semibold text-gray-900">
                                <?php echo count($data['following']); ?>
                            </span>
                            <span class="text-sm text-gray-500">Following</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Form (Hidden by default) -->
            <div id="edit-form" class="hidden bg-white rounded-xl shadow-lg p-6 sm:p-8">
                <form action="/edit_profile" method="POST" enctype="multipart/form-data">
                    <!-- Profile Picture Upload -->
                    <div class="mb-8">
                        <div class="flex items-center space-x-6">
                            <div class="relative group">
                                <div class="h-24 w-24 rounded-full overflow-hidden bg-gray-100">
                                    <?php if(isset($user['profile_picture']) && !empty($user['profile_picture'])): ?>
                                    <img id="preview-image"
                                        src="<?php echo htmlspecialchars('../'.$user['profile_picture']); ?>"
                                        alt="Profile" class="h-full w-full object-cover">
                                    <?php else: ?>
                                    <img id="preview-image" src="#" alt="Profile"
                                        class="h-full w-full object-cover hidden">
                                    <svg id="default-image" class="h-full w-full text-gray-400 p-6" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <?php endif; ?>
                                </div>
                                <!-- Upload button -->
                                <label
                                    class="absolute bottom-0 right-0 bg-violet-600 rounded-full p-2 cursor-pointer hover:bg-violet-700 transition-colors">
                                    <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <input type="file" name="profile_picture" id="profile-picture-input"
                                        accept="image/*" class="hidden" onchange="previewImage(this)">
                                    <input type="text" name="profile_picture_state" id="profile-picture-state"
                                        class="hidden" value="update">
                                </label>
                                <!-- Delete button -->
                                <button type="button" id="delete-image-btn" onclick="deleteProfilePicture()"
                                    class="absolute -top-2 -right-2 bg-red-500 rounded-full p-1 cursor-pointer hover:bg-red-600 transition-colors">
                                    <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                                <!-- Hidden input to track deletion -->
                                <input type="hidden" name="delete_profile_picture" id="delete-profile-picture"
                                    value="0">
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-700">Profile photo</h3>
                                <p class="text-xs text-gray-500">JPG, PNG, GIF up to 10MB</p>
                            </div>
                        </div>
                    </div>


                    <!-- Bio Section -->
                    <div class="relative mb-8">
                        <textarea name="bio" rows="4"
                            class="peer w-full px-4 py-3 border border-gray-200 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent outline-none transition-all resize-none"
                            placeholder="Write something about yourself..."><?php echo htmlspecialchars($user['bio'] ?? ''); ?></textarea>
                        <label class="absolute left-2 -top-2.5 bg-white px-2 text-sm text-gray-600">
                            Bio
                        </label>
                    </div>

                    <!-- Form Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                        <div class="relative">
                            <input type="text" name="username"
                                class="peer w-full h-12 px-4 border border-gray-200 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent outline-none transition-all"
                                value="<?php echo htmlspecialchars($user['username']); ?>" />
                            <label class="absolute left-2 -top-2.5 bg-white px-2 text-sm text-gray-600">
                                Username
                            </label>
                        </div>

                        <div class="relative">
                            <input type="text" name="firstname"
                                class="peer w-full h-12 px-4 border border-gray-200 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent outline-none transition-all"
                                value="<?php echo htmlspecialchars($user['firstname'] ?? ''); ?>" />
                            <label class="absolute left-2 -top-2.5 bg-white px-2 text-sm text-gray-600">
                                First name
                            </label>
                        </div>

                        <div class="relative">
                            <input type="text" name="lastname"
                                class="peer w-full h-12 px-4 border border-gray-200 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent outline-none transition-all"
                                value="<?php echo htmlspecialchars($user['lastname'] ?? ''); ?>" />
                            <label class="absolute left-2 -top-2.5 bg-white px-2 text-sm text-gray-600">
                                Last name
                            </label>
                        </div>

                        <div class="relative">
                            <input type="email" name="email"
                                class="peer w-full h-12 px-4 border border-gray-200 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent outline-none transition-all"
                                value="<?php echo htmlspecialchars($user['email']); ?>" />
                            <label class="absolute left-2 -top-2.5 bg-white px-2 text-sm text-gray-600">
                                Email
                            </label>
                        </div>

                        <div class="relative">
                            <input type="password" name="old_password"
                                class="peer w-full h-12 px-4 border border-gray-200 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent outline-none transition-all"
                                placeholder="Enter your current password" />
                            <label class="absolute left-2 -top-2.5 bg-white px-2 text-sm text-gray-600">
                                Current Password
                            </label>
                        </div>

                        <div class="relative">
                            <input type="password" name="new_password"
                                class="peer w-full h-12 px-4 border border-gray-200 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent outline-none transition-all"
                                placeholder="Leave blank to keep current password" />
                            <label class="absolute left-2 -top-2.5 bg-white px-2 text-sm text-gray-600">
                                New Password
                            </label>
                        </div>


                    </div>

                    <!-- Buttons -->
                    <div
                        class="flex flex-col-reverse sm:flex-row sm:justify-end space-y-4 space-y-reverse sm:space-y-0 sm:space-x-4">
                        <button type="button" onclick="toggleEdit()"
                            class="w-full sm:w-auto px-6 py-3 text-sm font-medium text-violet-600 bg-white border border-violet-600 rounded-lg hover:bg-violet-50 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 transition-all">
                            Cancel
                        </button>
                        <button type="submit"
                            class="w-full sm:w-auto px-6 py-3 text-sm font-medium text-white bg-violet-600 rounded-lg hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 transition-all">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>

            <!-- <div class="border-b border-gray-200 bg-gray-100 pt-3 px-4 rounded-md mb-6 hover:shadow-md">
                <nav class="-mb-px flex space-x-8">
                    <a href="#" class="border-b-2 border-blue-500 pb-4 px-1 text-sm font-medium text-blue-600">
                        Posts
                    </a>
                    <a href="#"
                        class="border-b-2 border-transparent pb-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        Comments
                    </a>
                    
                </nav>
            </div> -->

            <div class="flex flex-col space-y-4 overflow-y-auto" id="tweets-pane">
                <?php
            $this->postController->render_tweets( $_SESSION["user_id"], $self=true);

            ?>
            </div>
        </div>
    </main>
    <style>
        /* Upvote button styles */
        .upvotes {
            transition: color 0.2s ease-in-out;
        }

        .upvotes.liked {
            color: #3b82f6;
            /* Tailwind blue-500 */
        }

        .upvotes.liked svg {
            stroke: #3b82f6;
            /* Tailwind blue-500 */
        }

        .upvotes:hover {
            color: #60a5fa;
            /* Tailwind blue-400 for hover */
        }

        .upvotes:hover svg {
            stroke: #60a5fa;
            /* Tailwind blue-400 for hover */
        }

        .upvotes svg {
            transition: stroke 0.2s ease-in-out;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Add click event listener to all upvote buttons
            document.querySelectorAll('.upvotes').forEach(button => {
                button.addEventListener('click', handleLike);
            });

            async function handleLike(event) {
                const button = event.currentTarget;
                const postId = button.dataset.postId;
                const isLiked = button.dataset.likedId === "1";
                const upvoteSpan = button.querySelector('#upvotes');
                const currentUpvotes = parseInt(upvoteSpan.textContent);

                try {
                    const endpoint = isLiked ? '/remove_likes' : '/add_likes';
                    const response = await fetch(endpoint, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ post_id: postId })
                    });

                    const data = await response.json();

                    if (data.status === 'success') {
                        // Toggle the liked state
                        button.dataset.likedId = isLiked ? "0" : "1";
                        button.classList.toggle('liked');

                        // Update the upvote count
                        upvoteSpan.textContent = isLiked ?
                            (currentUpvotes - 1) :
                            (currentUpvotes + 1);
                    } else {
                        console.error('Error:', data.message);
                        // alert('Failed to update like. Please try again.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    // alert('Failed to update like. Please try again.');
                }
            }
        });
    </script>

    <script>
        function toggleEdit() {
            const profileView = document.getElementById('profile-view');
            const editForm = document.getElementById('edit-form');

            if (profileView.classList.contains('hidden')) {
                profileView.classList.remove('hidden');
                editForm.classList.add('hidden');
            } else {
                profileView.classList.add('hidden');
                editForm.classList.remove('hidden');
            }
        }

        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('preview-image');
                    const fileInput = document.getElementById('profile-picture-input');
                    const defaultImage = document.getElementById('default-image');
                    const deleteButton = document.getElementById('delete-image-btn');
                    const profileState = document.querySelector("#profile-picture-state");

                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    deleteButton.style.display = 'block';
                    document.getElementById('delete-profile-picture').value = "0";

                    if (defaultImage) {
                        defaultImage.classList.add('hidden');
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function deleteProfilePicture() {
            const preview = document.getElementById('preview-image');
            const defaultImage = document.getElementById('default-image');
            const fileInput = document.getElementById('profile-picture-input');
            const deleteButton = document.getElementById('delete-image-btn');
            const deleteFlag = document.getElementById('delete-profile-picture');
            const profileState = document.querySelector("#profile-picture-state");


            // Reset the file input
            fileInput.value = '';
            profileState.value = "delete";

            // Show default image
            preview.classList.add('hidden');
            preview.src = '#';
            if (defaultImage) {
                defaultImage.classList.remove('hidden');
            }

            // Set delete flag to true
            deleteFlag.value = "1";

            // Hide delete button if there's no default profile picture
            if (!preview.src || preview.src === window.location.href) {
                deleteButton.style.display = 'none';
            }
        }

        // Initialize delete button visibility
        document.addEventListener('DOMContentLoaded', function () {
            const preview = document.getElementById('preview-image');
            const deleteButton = document.getElementById('delete-image-btn');

            if (!preview.src || preview.src === window.location.href || preview.classList.contains('hidden')) {
                deleteButton.style.display = 'none';
            }
        });

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Comment toggle functionality
            const commentToggles = document.querySelectorAll('.comment-toggle');
            commentToggles.forEach(toggle => {
                toggle.addEventListener('click', () => {
                    const postId = toggle.getAttribute('data-post-id');
                    const commentsSection = document.getElementById(`comments-section-${postId}`);
                    commentsSection.classList.toggle('hidden');
                });
            });
        
            // Comment submission
            const commentForms = document.querySelectorAll('form[action="/add_comment"]');
            commentForms.forEach(form => {
                form.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    const formData = new FormData(form);
                    const response = await fetch('/add_comment', {
                        method: 'POST',
                        body: formData
                    });
                    const username = form.dataset.username;
        
                    if (response.ok) {
                        const postId = formData.get('post_id');
                        const content = formData.get('content');
                        const commentsContainer = document.getElementById(`comments-${postId}`);
                        const newComment = document.createElement('div');
                        newComment.className = 'bg-gray-100 p-3 rounded-md';
                        newComment.innerHTML = 
                        '<p class="font-semibold text-sm">' + username + '</p>' +
                        '<p class="text-gray-700">' + content + '</p>' +
                        '<p class="text-xs text-gray-500 mt-1">Just now</p>';
                        commentsContainer.prepend(newComment);
                        form.reset();
        
                        // Update comment count
                        const commentToggle = document.querySelector(`.comment-toggle[data-post-id="${postId}"]`);
                        const countSpan = commentToggle.querySelector('span');
                        const currentCount = parseInt(countSpan.textContent.match(/\d+/)[0]);
                        countSpan.textContent = `${currentCount + 1} comments`;
                    }
                });
            });
        });
        </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            document.querySelectorAll('.delete-tweet').forEach(button => {
                button.addEventListener('click', async (e) => {
                    const postId = button.getAttribute('data-post-id');
                    if (confirm('Are you sure you want to delete this tweet?')) {
                        try {
                            const response = await fetch('/delete_post', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({ post_id: postId })
                            });

                            const data = await response.json();

                            if (data.status === 'success') {
                                // Remove the tweet from the DOM
                                const tweetElement = button.closest('.bg-gray-300');
                                tweetElement.remove();
                            } else {
                                alert('Failed to delete tweet: ' + data.message);
                            }
                        } catch (error) {
                            console.error('Error:', error);
                            alert('Failed to delete tweet. Please try again.');
                        }
                    }
                });
            });
        });

    </script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Existing event listeners
        
            // Add event listener for delete comment buttons
            document.body.addEventListener('click', async function(e) {
                if (e.target.closest('.delete-comment')) {
                    e.preventDefault();
                    const button = e.target.closest('.delete-comment');
                    if (confirm('Are you sure you want to delete this comment?')) {
                        const commentId = button.getAttribute('data-comment-id');
                        const response = await fetch('/delete_comment', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `comment_id=${commentId}`
                        });
        
                        const result = await response.json();
        
                        if (result.status === 'success') {
                            // Remove the comment from the DOM
                            const commentElement = button.closest('.bg-gray-100');
                            const commentsContainer = commentElement.closest('.space-y-2');
                            commentElement.remove();
        
                            // Update comment count
                            const postId = commentsContainer.id.split('-')[1];
                            const commentToggle = document.querySelector(`.comment-toggle[data-post-id="${postId}"]`);
                            const countSpan = commentToggle.querySelector('span');
                            const currentCount = parseInt(countSpan.textContent.match(/\d+/)[0]);
                            countSpan.textContent = `${currentCount - 1} comments`;
                        } else {
                            alert('Failed to delete comment. Please try again.');
                        }
                    }
                }
            });
        });
        </script>

        
</body>

</html>
```````

`/home/ramees/progs/php/sora/src/Views/conversations_list.php`:

```````php
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
```````

`/home/ramees/progs/php/sora/src/Views/signup.html`:

```````html
<!DOCTYPE html>
<html class="h-full sm:overflow-y-auto md:overflow-hidden" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup/Login | SORA</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body class="h-full bg-gray-100 text-sora-text"> 
    <header class="bg-gradient-to-r from-sora-primary to-sora-secondary text-white py-4 px-6 shadow-lg"> 
        <nav class="text-2xl sm:text-3xl md:text-4xl font-bold">SORA</nav>
    </header>
    <main class="h-full text-sora-text"> 

        <div
            class="flex flex-col sm:flex-row gap-7 sm:gap-15 md:gap-[7em] justify-center items-center p-4 sm:p-8 md:p-12 min-h-[calc(100vh-4rem)]">

            <div class="signup-card  p-6 flex items-center justify-center rounded-md w-full sm:w-[90%] md:w-[80%] lg:w-[40%] xl:w-[30%] max-w-md  shadow-md">
                <div class="signup w-full text-lg sm:text-xl">
                    <form class="flex flex-col w-full justify-center gap-4" action="/register" method="POST">
                        <h3 class="w-full font-bold text-2xl text-gray-900 mb-4 text-center">Signup</h3>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="signup-email">Email</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="email" name="email" id="signup-email" required>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="signup-first-name">First Name</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" name="firstname" id="signup-first-name" required>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="signup-last-name">Last Name</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" name="lastname" id="signup-last-name" required>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="signup-username">Username</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" name="username" id="signup-username" required>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="signup-password">Password</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="password" name="password" id="signup-password" required>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="signup-retype-password">Retype
                                Password</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="password" name="retype_password" id="signup-retype-password" required>
                        </div>
                        <button
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit" name="submit">Signup</button>
                        <div class="error text-red-600 w-full text-center text-lg font-bold mt-2 hidden">
                            <?php 
                            if(isset($_SESSION['error'])){
                            echo implode("<br>", $_SESSION['error']); 
                            $_SESSION['error'] = null;
                            unset($_SESSION['error']);
                            }
                             ?>
                        </div>
                    </form>
                </div>
            </div>
            <div
                class="login-card  p-6 flex items-center justify-center rounded-md shadow-md w-full sm:w-[90%] md:w-[80%] lg:w-[40%] xl:w-[30%] max-w-md">
                <div class="login w-full text-lg sm:text-xl">
                    <form class="flex flex-col w-full justify-center gap-4" action="/login" method="POST">
                        <h3 class="w-full font-bold text-2xl text-gray-900 mb-4 text-center">Login</h3>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="username">Username</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" name="username" id="username" required>
                        </div>
                        <div class="form-group">
                            <label class="block text-gray-700 font-bold mb-2" for="password">Password</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="password" name="password" id="password" required>
                        </div>
                        <div class="error text-red-600 w-full text-center text-lg font-bold mt-2 hidden">
                            <?php 
                            if(isset($_SESSION['login_error'])){
                            echo implode("<br>", $_SESSION['login_error']); 
                            $_SESSION['login_error'] = null;
                            unset($_SESSION['error']);
                            }
                             ?>
                        </div>
                        <button
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit" name="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        let login_card = document.querySelector(".login-card");
        let signup_card = document.querySelector(".signup-card");

        let styles_array = ["bg-gray-200", "shadow-md"];

        login_card.addEventListener("mouseenter", () => {
            login_card.classList.add(...styles_array);
            signup_card.classList.remove(...styles_array);
        });

        signup_card.addEventListener("mouseenter", () => {
            signup_card.classList.add(...styles_array);
            login_card.classList.remove(...styles_array);
        });

        let error = document.querySelector(".error");
        if (error.textContent.trim() !== "") {
            error.classList.remove("hidden");
            document.querySelector("html").classList.add("md:overflow-y-auto");
        }
    </script>
</body>

</html>
```````

`/home/ramees/progs/php/sora/src/Views/spaces_list.html`:

```````html
<!DOCTYPE html>
<html lang="en">
<?php include_once __DIR__."/html_head.html" ?>
<body class="bg-gray-100">
    <?php include_once __DIR__ ."/navbar.html"?>
    
    <main class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Spaces</h1>
        
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Create a New Space</h2>
            <a href="/spaces/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create Space
            </a>
        </div>

        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Join a Space</h2>
            <form id="join-space-form" class="mb-4">
                <input type="text" name="space_code" placeholder="Enter space code" class="p-2 border rounded mr-2">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Join Space
                </button>
            </form>
        </div>

        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Your Spaces</h2>
            <div id="user-spaces" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php foreach ($userSpaces as $space): ?>
                    <div class="bg-white p-4 rounded shadow">
                        <h3 class="text-xl font-bold mb-2"><?= htmlspecialchars($space['name']) ?></h3>
                        <p class="text-gray-600 mb-2">Code: <?= htmlspecialchars($space['code']) ?></p>
                        <a href="/spaces/<?= $space['id'] ?>" class="text-blue-500 hover:underline">View Space</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('join-space-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);

            try {
                const response = await fetch('/spaces/join', {
                    method: 'POST',
                    body: formData
                });

                if (response.ok) {
                    const result = await response.json();
                    if (result.success) {
                        alert('Successfully joined the space!');
                        location.reload();
                    } else {
                        alert('Failed to join space: ' + result.message);
                    }
                } else {
                    alert('Failed to join space. Please try again.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            }
        });
    </script>
</body>
</html>
```````

`/home/ramees/progs/php/sora/src/Views/home.html`:

```````html
<!DOCTYPE html>
<html class="h-full" lang="en">
<!-- <?php $_SERVER["title"] = "SORA | HOME" ?> -->

<?php include_once __DIR__."/html_head.html"?>
<body class="h-full text-gray-900 flex flex-col w-full" style="background: url('/images/sora-bg4.png')">
       
<?php include_once __DIR__."/navbar.html" ?>
    
        <main class="flex-grow flex overflow-hidden">
            <aside class="w-72 bg-gray-100 opacity-95 shadow-lg overflow-y-auto hidden md:block">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-6 text-sora-primary">Peeps</h2>
                    <div class="space-y-4">
                        <div class="bg-gray-300 rounded-lg p-4 transition overflow-auto duration-300 hover:shadow-md">
                            <h3 class="text-lg font-semibold mb-3 text-sora-secondary">Following</h3>
                            <ul class="space-y-3" id="followed-users-list">
                                <!-- Followed users will be populated here -->
                            </ul>
                        </div>
                        <div class="bg-gray-300 rounded-lg p-4 overflow-auto transition duration-300 hover:shadow-md">
                            <h3 class="text-lg font-semibold mb-3 text-sora-secondary">Followers</h3>
                            <ul class="space-y-3" id="followers-users-list">
                                <!-- Followers  will be populated here -->
                            </ul>
                        </div>
                        <div class="bg-gray-300 rounded-lg p-4 transition duration-300 overflow-auto hover:shadow-md">
                            <h3 class="text-lg font-semibold mb-3 text-sora-secondary">Search Users</h3>
                            <input type="text" id="user-search" class="w-full p-2 rounded-md" placeholder="Search users...">
                            <ul class="space-y-3 mt-3" id="search-results">
                                <!-- Search results will be populated here -->
                            </ul>
                        </div>
                        <div class="bg-gray-300 rounded-lg p-4 transition duration-300 hover:shadow-md">
                            <h3 class="text-lg font-semibold mb-3 text-sora-secondary">Your Status</h3>
                            <p id="current-status" class="mb-2 text-gray-700 <?php echo empty($_SESSION['user_status']) ? 'text-gray-500' : ''; ?>">
                                <?php echo htmlspecialchars($_SESSION['user_status'] ?? 'No status set'); ?>
                            </p>
                            <form id="status-form" class="mt-2">
                                <input type="text" id="status-input" class="w-full p-2 rounded-md mb-2" placeholder="Update your status...">
                                <div class="flex justify-between gap-3  ">
                                <button type="submit" id="update-status-btn" class="bg-sora-primary text-white px-4 py-2 rounded-md hover:bg-sora-secondary transition-colors duration-300 text-sm">
                                    Update Status
                                </button>
                                <button id="remove-status-btn" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors duration-300 text-sm <?php echo empty($_SESSION['user_status']) ? 'hidden' : ''; ?>">
                                    Remove Status
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </aside> 

        <div class="flex-grow flex flex-col w-24 overflow-hidden">
            <section class="flex-grow p-4 overflow-y-auto">
                <h1 class="text-2xl font-bold mb-4 text-sora-primary bg-gray-300 w-fit p-2 rounded-md shadow-md">Tweets</h1>
                <div class="space-y-4">
                    <?php
                    use Sora\Controllers\PostController;
                    
                    $postController = new PostController();
                    $postController->render_tweets();
                    ?>
                </div>
            </section>
            <footer class="bg-gradient-to-r from-sora-primary to-sora-secondary p-4 shadow-lg m-2 rounded-lg">
                <div class="max-w-4xl mx-auto">
                    <form action="/create" method="post" class="flex flex-col sm:flex-row sm:items-end md:items-center gap-3" id="post-tweet">
                        <div class="relative flex-grow">
                            <textarea name="content" id="tweet" rows="3" class="w-full sm:w-max p-3 pr-12 rounded-lg resize-none bg-white bg-opacity-90 focus:ring-2 focus:ring-sora-bg focus:outline-none placeholder-gray-500" placeholder="What's on your mind?"></textarea>
                            <!-- <div class="absolute bottom-3 right-3 flex space-x-2">
                            </div> -->
                        </div>
                        <?php 
                        use Sora\Helpers\Helper;
                        $_SESSION['csrf_token'] = Helper::generate_token()
                        ?>
                        <input type="hidden" name="csrf_token" value=<?=$_SESSION['csrf_token'] ?>>
                        <button name="post-btn" class="bg-sora-bg text-sora-primary py-2 px-6 rounded-full hover:bg-white hover:text-sora-secondary transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-sora-bg">
                            <i class="fas fa-paper-plane mr-2"></i>Post
                        </button>
                    </form>
                </div>
            </footer>
        </div>
        </main> 

        <style>
            /* Upvote button styles */
            .upvotes {
                transition: color 0.2s ease-in-out;
            }

            .upvotes.liked {
                color: #3b82f6; /* Tailwind blue-500 */
            }

            .upvotes.liked svg {
                stroke: #3b82f6; /* Tailwind blue-500 */
            }

            .upvotes:hover {
                color: #60a5fa; /* Tailwind blue-400 for hover */
            }

            .upvotes:hover svg {
                stroke: #60a5fa; /* Tailwind blue-400 for hover */
            }

            .upvotes svg {
                transition: stroke 0.2s ease-in-out;
            }
        </style>
        <script src="/js/status.js"></script>
        <script src="/js/follow.js"></script>
    </body>
    

        <script>
            document.addEventListener('DOMContentLoaded', function() {
    const tweetTextarea = document.getElementById('tweet');
    const tweetForm = tweetTextarea.closest('form');

    tweetTextarea.addEventListener('keydown', async function(e) {
        // Check if Enter was pressed without Shift (Shift+Enter allows multiline)
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault(); // Prevent default newline
            
            // Get the form data
            const formData = new FormData(tweetForm);
            
            // Only submit if there's content
            const content = formData.get('content').trim();
            if (content) {
                try {
                    const response = await fetch('/create', {
                        method: 'POST',
                        body: formData
                    });

                    if (response.ok) {
                        // Clear the textarea
                        tweetForm.reset();
                        
                        // Optionally reload the page to show the new tweet
                        // or you could insert the new tweet dynamically
                        window.location.reload();
                    } else {
                        console.error('Failed to post tweet');
                    }
                } catch (error) {
                    console.error('Error posting tweet:', error);
                }
            }
        }
    });
});
        </script>

<script>
   document.addEventListener('DOMContentLoaded', function() {
    // Add click event listener to all upvote buttons
    document.querySelectorAll('.upvotes').forEach(button => {
        button.addEventListener('click', handleLike);
    });

    async function handleLike(event) {
        const button = event.currentTarget;
        const postId = button.dataset.postId;
        const isLiked = button.dataset.likedId === "1";
        const upvoteSpan = button.querySelector('#upvotes');
        const currentUpvotes = parseInt(upvoteSpan.textContent);

        try {
            const endpoint = isLiked ? '/remove_likes' : '/add_likes';
            const response = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ post_id: postId })
            });

            const data = await response.json();

            if (data.status === 'success') {
                // Toggle the liked state
                button.dataset.likedId = isLiked ? "0" : "1";
                button.classList.toggle('liked');
                
                // Update the upvote count
                upvoteSpan.textContent = isLiked ? 
                    (currentUpvotes - 1) : 
                    (currentUpvotes + 1);
            } else {
                console.error('Error:', data.message);
                // alert('Failed to update like. Please try again.');
            }
        } catch (error) {
            console.error('Error:', error);
            // alert('Failed to update like. Please try again.');
        }
    }
});
    </script>   

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Comment toggle functionality
        const commentToggles = document.querySelectorAll('.comment-toggle');
        commentToggles.forEach(toggle => {
            toggle.addEventListener('click', () => {
                const postId = toggle.getAttribute('data-post-id');
                const commentsSection = document.getElementById(`comments-section-${postId}`);
                commentsSection.classList.toggle('hidden');
            });
        });
    
        // Comment submission
        const commentForms = document.querySelectorAll('form[action="/add_comment"]');
        commentForms.forEach(form => {
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                const formData = new FormData(form);
                const response = await fetch('/add_comment', {
                    method: 'POST',
                    body: formData
                });
                const username = form.dataset.username;
    
                if (response.ok) {
                    const postId = formData.get('post_id');
                    const content = formData.get('content');
                    const commentsContainer = document.getElementById(`comments-${postId}`);
                    const newComment = document.createElement('div');
                    newComment.className = 'bg-gray-100 p-3 rounded-md';
                    newComment.innerHTML = 
                    '<p class="font-semibold text-sm">' + username + '</p>' +
                    '<p class="text-gray-700">' + content + '</p>' +
                    '<p class="text-xs text-gray-500 mt-1">Just now</p>';
                    commentsContainer.prepend(newComment);
                    form.reset();
    
                    // Update comment count
                    const commentToggle = document.querySelector(`.comment-toggle[data-post-id="${postId}"]`);
                    const countSpan = commentToggle.querySelector('span');
                    const currentCount = parseInt(countSpan.textContent.match(/\d+/)[0]);
                    countSpan.textContent = `${currentCount + 1} comments`;
                    window.location.reload();
                }
            });
        });
    });
    </script>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Existing event listeners
    
        // Add event listener for delete comment buttons
        document.body.addEventListener('click', async function(e) {
            if (e.target.closest('.delete-comment')) {
                e.preventDefault();
                const button = e.target.closest('.delete-comment');
                if (confirm('Are you sure you want to delete this comment?')) {
                    const commentId = button.getAttribute('data-comment-id');
                    const response = await fetch('/delete_comment', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `comment_id=${commentId}`
                    });
    
                    const result = await response.json();
    
                    if (result.status === 'success') {
                        // Remove the comment from the DOM
                        const commentElement = button.closest('.bg-gray-100');
                        const commentsContainer = commentElement.closest('.space-y-2');
                        commentElement.remove();
    
                        // Update comment count
                        const postId = commentsContainer.id.split('-')[1];
                        const commentToggle = document.querySelector(`.comment-toggle[data-post-id="${postId}"]`);
                        const countSpan = commentToggle.querySelector('span');
                        const currentCount = parseInt(countSpan.textContent.match(/\d+/)[0]);
                        countSpan.textContent = `${currentCount - 1} comments`;
                    } else {
                        alert('Failed to delete comment. Please try again.');
                    }
                }
            }
        });
    });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        document.querySelectorAll('.delete-tweet').forEach(button => {
            button.addEventListener('click', async (e) => {
                const postId = button.getAttribute('data-post-id');
                if (confirm('Are you sure you want to delete this tweet?')) {
                    try {
                        const response = await fetch('/delete_post', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({ post_id: postId })
                        });

                        const data = await response.json();

                        if (data.status === 'success') {
                            // Remove the tweet from the DOM
                            const tweetElement = button.closest('.bg-gray-300');
                            tweetElement.remove();
                        } else {
                            alert('Failed to delete tweet: ' + data.message);
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Failed to delete tweet. Please try again.');
                    }
                }
            });
        });
    });

</script>

    </main>
</body>
</html>
```````

`/home/ramees/progs/php/sora/src/Views/admin_panel.php`:

```````php
<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Admin | SORA </title>
</head>
<body class="bg-sora-secondary flex justify-center items-center h-full">
    <div class=" text-8xl font-bold text-gray-200 " id="message">
        

    </div>
    
</body>

<script>
    document.addEventListener('DOMContentLoaded', ()=>{
        const message = document.querySelector("#message");
        let text = message.textContent;
        let addon = "Hello Admin :)!"
        let speed = 200;
        let cursor_visible = true

    

        for (let i=0; i< addon.length; i++){
            setTimeout(()=>{
                text += addon.charAt(i);
                
                message.textContent = text + (cursor_visible ? "|" : "");
            }, i*speed);
        }
        
        setInterval(() => {
            cursor_visible = !cursor_visible; 
            message.textContent = text + (cursor_visible ? "|" : "");  
        }, 400)
        
    
        
            
       
    })
</script>
</html>

```````

`/home/ramees/progs/php/sora/src/Views/html_head.html`:

```````html
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_SERVER["title"]??"SORA" ?></title>
    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
</head>
```````

`/home/ramees/progs/php/sora/src/Views/user_profile.html`:

```````html
<?php
require __DIR__ . "/../Views/html_head.html";
require __DIR__ . "/../Views/navbar.html";


?>


<main class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Profile Header -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="flex items-start justify-between mb-6">
                <div class="flex items-center space-x-6">
                    <div class="w-24 h-24 rounded-full bg-gray-200 overflow-hidden">
                        <img src="<?=$user['profile_picture']?>" alt="<?= $user['username']?>'s avatar"
                            class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">
                            <?=$user["username"]?>
                        </h1>
                        <!-- <p class="text-gray-500">Student at University</p>
                        <p class="text-gray-600 mt-1">
                            <i class="fas fa-map-marker-alt"></i> Kerala, India
                        </p> -->
                    </div>
                </div>
                
                <div class="space-x-3">
                    <?php if ($user['id'] !== $_SESSION['user_id']|| 1 ): ?>
                        <button id="followButton" 
                                data-user-id="<?= $user['id'] ?>" 
                                data-following="<?= $this->userModel->isFollowing($_SESSION['user_id'], $user['id']) ? 'true' : 'false' ?>"
                                class="inline-flex bg-blue-500 items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors duration-200">
                            <span id="followButtonText">
                                <?= $this->userModel->isFollowing($_SESSION['user_id'], $user['id']) ? 'Unfollow' : 'Follow' ?>
                            
                            </span>
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <p class="text-gray-700 mb-6">
                <?= $user["bio"]?>
            </p>

            <div class="flex space-x-8">
                <div class="text-center">
                    <div class="text-xl font-bold text-gray-900">
                        <?=  count($data["posts"])?>
                    </div>
                    <div class="text-gray-500">Posts</div>
                </div>
                <div class="text-center">
                    <div class="text-xl font-bold text-gray-900">
                        <?=  count($data["followers"])?>
                    </div>
                    <div class="text-gray-500">Followers</div>
                </div>
                <div class="text-center">
                    <div class="text-xl font-bold text-gray-900">
                        <?=  count($data["following"])?>
                    </div>
                    <div class="text-gray-500">Following</div>
                </div>
            </div>
        </div>

        <!-- Tab Navigation -->
        <!-- <div class="border-b border-gray-200 bg-gray-100 pt-3 px-4 rounded-md mb-6 hover:shadow-md">
            <nav class="-mb-px flex space-x-8">
                <a href="#" class="border-b-2 border-blue-500 pb-4 px-1 text-sm font-medium text-blue-600">
                    Posts
                </a>
                <a href="#"
                    class="border-b-2 border-transparent pb-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    Comments
                </a>
                
            </nav>
        </div> -->

        <!-- Posts Grid -->
        <div class="grid grid-cols-1 gap-6">
           

            <?php $this->render_user_tweets($data); ?>

        </div>
    </div>
    <style>
        /* Upvote button styles */
        .upvotes {
            transition: color 0.2s ease-in-out;
        }

        .upvotes.liked {
            color: #3b82f6;
            /* Tailwind blue-500 */
        }

        .upvotes.liked svg {
            stroke: #3b82f6;
            /* Tailwind blue-500 */
        }

        .upvotes:hover {
            color: #60a5fa;
            /* Tailwind blue-400 for hover */
        }

        .upvotes:hover svg {
            stroke: #60a5fa;
            /* Tailwind blue-400 for hover */
        }

        .upvotes svg {
            transition: stroke 0.2s ease-in-out;
        }
    </style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const followButton = document.getElementById('followButton');
        if (followButton) {
            followButton.addEventListener('click', async function() {
                const userId = this.dataset.userId;
                const isFollowing = this.dataset.following === 'true';
                const action = isFollowing ? 'unfollow' : 'follow';
    
                try {
                    const response = await fetch(`/${action}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ user_id: userId })
                    });
    
                    if (response.ok) {
                        const result = await response.json();
                        if (result.success) {
                            // Toggle button state
                            this.dataset.following = isFollowing ? 'false' : 'true';
                            document.getElementById('followButtonText').textContent = isFollowing ? 'Follow' : 'Unfollow';
                            
                            // Update follower count
                            const followerCountElement = document.querySelector('.follower-count');
                            if (followerCountElement) {
                                let count = parseInt(followerCountElement.textContent);
                                followerCountElement.textContent = isFollowing ? count - 1 : count + 1;
                            }
    
                            // Toggle button color
                            this.classList.toggle('bg-blue-600');
                            this.classList.toggle('hover:bg-blue-700');
                            this.classList.toggle('bg-gray-600');
                            this.classList.toggle('hover:bg-gray-700');
                        }
                    } else {
                        console.error('Failed to update follow status');
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            });
        }
    });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Add click event listener to all upvote buttons
            document.querySelectorAll('.upvotes').forEach(button => {
                button.addEventListener('click', handleLike);
            });

            async function handleLike(event) {
                const button = event.currentTarget;
                const postId = button.dataset.postId;
                const isLiked = button.dataset.likedId === "1";
                const upvoteSpan = button.querySelector('#upvotes');
                const currentUpvotes = parseInt(upvoteSpan.textContent);

                try {
                    const endpoint = isLiked ? '/remove_likes' : '/add_likes';
                    const response = await fetch(endpoint, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ post_id: postId })
                    });

                    const data = await response.json();

                    if (data.status === 'success') {
                        // Toggle the liked state
                        button.dataset.likedId = isLiked ? "0" : "1";
                        button.classList.toggle('liked');

                        // Update the upvote count
                        upvoteSpan.textContent = isLiked ?
                            (currentUpvotes - 1) :
                            (currentUpvotes + 1);
                    } else {
                        console.error('Error:', data.message);
                        // alert('Failed to update like. Please try again.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    // alert('Failed to update like. Please try again.');
                }
            }
        });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Comment toggle functionality
        const commentToggles = document.querySelectorAll('.comment-toggle');
        commentToggles.forEach(toggle => {
            toggle.addEventListener('click', () => {
                const postId = toggle.getAttribute('data-post-id');
                const commentsSection = document.getElementById(`comments-section-${postId}`);
                commentsSection.classList.toggle('hidden');
            });
        });
    
        // Comment submission
        const commentForms = document.querySelectorAll('form[action="/add_comment"]');
        commentForms.forEach(form => {
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                const formData = new FormData(form);
                const response = await fetch('/add_comment', {
                    method: 'POST',
                    body: formData
                });
                const username = form.dataset.username;
    
                if (response.ok) {
                    const postId = formData.get('post_id');
                    const content = formData.get('content');
                    const commentsContainer = document.getElementById(`comments-${postId}`);
                    const newComment = document.createElement('div');
                    newComment.className = 'bg-gray-100 p-3 rounded-md';
                    newComment.innerHTML = 
                    '<p class="font-semibold text-sm">' + username + '</p>' +
                    '<p class="text-gray-700">' + content + '</p>' +
                    '<p class="text-xs text-gray-500 mt-1">Just now</p>';
                    commentsContainer.prepend(newComment);
                    form.reset();
    
                    // Update comment count
                    const commentToggle = document.querySelector(`.comment-toggle[data-post-id="${postId}"]`);
                    const countSpan = commentToggle.querySelector('span');
                    const currentCount = parseInt(countSpan.textContent.match(/\d+/)[0]);
                    countSpan.textContent = `${currentCount + 1} comments`;
                }
            });
        });
    });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Existing event listeners
    
        // Add event listener for delete comment buttons
        document.body.addEventListener('click', async function(e) {
            if (e.target.closest('.delete-comment')) {
                e.preventDefault();
                const button = e.target.closest('.delete-comment');
                if (confirm('Are you sure you want to delete this comment?')) {
                    const commentId = button.getAttribute('data-comment-id');
                    const response = await fetch('/delete_comment', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `comment_id=${commentId}`
                    });
    
                    const result = await response.json();
    
                    if (result.status === 'success') {
                        // Remove the comment from the DOM
                        const commentElement = button.closest('.bg-gray-100');
                        const commentsContainer = commentElement.closest('.space-y-2');
                        commentElement.remove();
    
                        // Update comment count
                        const postId = commentsContainer.id.split('-')[1];
                        const commentToggle = document.querySelector(`.comment-toggle[data-post-id="${postId}"]`);
                        const countSpan = commentToggle.querySelector('span');
                        const currentCount = parseInt(countSpan.textContent.match(/\d+/)[0]);
                        countSpan.textContent = `${currentCount - 1} comments`;
                    } else {
                        alert('Failed to delete comment. Please try again.');
                    }
                }
            }
        });
    });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            document.querySelectorAll('.delete-tweet').forEach(button => {
                button.addEventListener('click', async (e) => {
                    const postId = button.getAttribute('data-post-id');
                    if (confirm('Are you sure you want to delete this tweet?')) {
                        try {
                            const response = await fetch('/delete_post', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({ post_id: postId })
                            });

                            const data = await response.json();

                            if (data.status === 'success') {
                                // Remove the tweet from the DOM
                                const tweetElement = button.closest('.bg-gray-300');
                                tweetElement.remove();
                            } else {
                                alert('Failed to delete tweet: ' + data.message);
                            }
                        } catch (error) {
                            console.error('Error:', error);
                            alert('Failed to delete tweet. Please try again.');
                        }
                    }
                });
            });
        });

    </script>
</main>

</body>
```````

`/home/ramees/progs/php/sora/README.md`:

```````md
# സൊറ 
Micro blogging Social media platform for cs department U.C College

```````