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